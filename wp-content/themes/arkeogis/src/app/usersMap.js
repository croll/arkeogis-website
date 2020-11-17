import * as Papa from "papaparse";
import mapboxgl from "mapbox-gl";
import MapboxglSpiderifier from "mapboxgl-spiderifier";
import "../node_modules/mapboxgl-spiderifier/index.css";

mapboxgl.accessToken =
  "pk.eyJ1IjoiYXJrZW9maSIsImEiOiJja2dvcTFranUwNG5yMnlvaG45bzFsNmtwIn0.NJRCLNOJTIFpUH-pq6ew3g";

export default class usersMap {
  constructor() {
    this.NUMBER_OF_CELS = 6;
    this.SPIDERFY_FROM_ZOOM = 5;
  }

  fetchDatas() {
    return new Promise((resolve, reject) => {
      Papa.parse(`/wp-content/themes/arkeogis/datas/users.csv`, {
        download: true,
        error: (error) => {
          console.error(`Error fetching users csv file: ${error}`, error);
        },
        complete: (result) => {
          if (result.data.length < 1) {
            reject(`No data fetched`);
            return;
          }
          resolve(this.csvToGeoJson(result.data));
        },
      });
    });
  }

  csvToGeoJson(data) {
    /* File structure
    0: "Nom"
    1: "Pays"
    2: "Type"
    3: "Lattitude"
    4: "Longitude"
  */

    let featureCollection = {
      type: "FeatureCollection",
      features: [],
    };

    const featureStruct = {
      type: "Feature",
      properties: [],
      geometry: undefined,
    };
    // Skip first line
    for (let i = 1; i < data.length; i++) {
      // Skip line with wrong number of arguments
      var d = data[i];
      if (d.length !== this.NUMBER_OF_CELS) {
        continue;
      }
      // Set properties for each line
      let properties = {
        name: d[0],
        city: d[1],
        country: d[2],
        type: d[3],
      };
      // Parse geojson geometry
      let geometry;
      if (d[4] !== "" && d[5] !== "") {
        try {
          geometry = {
            type: "Point",
            coordinates: [parseFloat(d[5]), parseFloat(d[4])],
          };
        } catch (e) {
          console.error(e);
        }
      }
      // Assign feature to collection
      featureCollection.features.push({
        ...featureStruct,
        properties,
        geometry,
      });
    }

    return featureCollection;
  }

  initializeSpiderLeg(spiderLeg) {
    const pinElem = spiderLeg.elements.pin;
    const feature = spiderLeg.feature;
    let popup;

    pinElem.className = pinElem.className + " arkeogisMarker";

    pinElem.addEventListener("mouseenter", (e) => {
      popup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false,
        className: "arkeoPopup",
        offset: MapboxglSpiderifier.popupOffsetForSpiderLeg(spiderLeg),
      });

      popup.setHTML(`<div class="name">${feature.name}</div>`).addTo(this.map);

      spiderLeg.mapboxMarker.setPopup(popup);
    });

    pinElem.addEventListener("mouseleave", () => {
      if (popup) {
        popup.remove();
      }
    });
  }

  async init(selector) {
    const datas = await this.fetchDatas();

    this.map = new mapboxgl.Map({
      container: document.querySelector(selector),
      center: [7.7521113, 48.5734053],
      zoom: 1.5,
      // style: "mapbox://styles/mapbox/dark-v10",
      style: "mapbox://styles/arkeofi/ckh55i3iv056d19p7id6sod6b",
      antialias: true,
    });

    this.map.on("load", () => {
      const img = new Image(24, 24);
      // On image load
      img.onload = () => {
        // Create image
        this.map.addImage(`arkeogis-symbol`, img);

        const spiderifier = new MapboxglSpiderifier(this.map, {
          animate: true,
          animationSpeed: 200,
          customPin: true,
          onClick: function (e, spiderLeg) {
            console.log(spiderLeg);
          },
          initializeLeg: this.initializeSpiderLeg.bind(this),
        });
        this.map.addSource("users", {
          type: "geojson",
          data: datas,
          generateId: true,
          cluster: true,
          clusterMaxZoom: 222,
          clusterRadius: 50,
        });

        this.map.addLayer({
          id: "clusters",
          type: "circle",
          source: "users",
          filter: ["has", "point_count"],
          paint: {
            "circle-color": [
              "step",
              ["get", "point_count"],
              "#f4b511",
              100,
              "#f4b511",
              750,
              "#f4b511",
            ],
            "circle-opacity": 0.5,
            "circle-radius": [
              "step",
              ["get", "point_count"],
              20,
              100,
              30,
              750,
              40,
            ],
          },
        });

        this.map.addLayer({
          id: "cluster-count",
          type: "symbol",
          source: "users",
          filter: ["has", "point_count"],
          layout: {
            "text-field": "{point_count_abbreviated}",
            "text-font": ["Open Sans Regular"],
            "text-size": 12,
          },
        });

        this.map.addLayer({
          id: "pins",
          type: "symbol",
          source: "users",
          layout: {
            "icon-image": "arkeogis-symbol",
          },
          filter: ["all", ["!has", "point_count"]],
        });

        var popup = new mapboxgl.Popup({
          closeButton: false,
          closeOnClick: false,
          className: "arkeoPopup",
        });

        this.map.on("click", "clusters", (e) => {
          var features = this.map.queryRenderedFeatures(e.point, {
            layers: ["clusters"],
          });
          var clusterId = features[0].properties.cluster_id;
          if (this.map.getZoom() > this.SPIDERFY_FROM_ZOOM) {
            this.map
              .getSource("users")
              .getClusterLeaves(
                features[0].properties.cluster_id,
                100,
                0,
                function (err, leafFeatures) {
                  if (err) {
                    return console.error(
                      "error while getting leaves of a cluster",
                      err
                    );
                  }
                  var markers = leafFeatures.map((leafFeature) => {
                    return leafFeature.properties;
                  });
                  spiderifier.spiderfy(
                    features[0].geometry.coordinates,
                    markers
                  );
                }
              );
          } else {
            this.map.easeTo({ center: e.lngLat, zoom: this.map.getZoom() + 2 });
          }

          this.map.on("zoomstart", function () {
            spiderifier.unspiderfy();
          });

          this.map.on("mouseenter", "pins", (e) => {
            // Change the cursor style as a UI indicator.
            this.map.getCanvas().style.cursor = "pointer";

            var coordinates = e.features[0].geometry.coordinates.slice();
            let { name } = e.features[0].properties;

            // Ensure that if the map is zoomed out such that multiple
            // copies of the feature are visible, the popup appears
            // over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
              coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }

            // Populate the popup and set its coordinates
            // based on the feature found.
            popup
              .setLngLat(coordinates)
              .setHTML(`<div class="name">${name}</div>`)
              .addTo(this.map);
          });

          this.map.on("mouseleave", "pins", () => {
            this.map.getCanvas().style.cursor = "";
            popup.remove();
          });
        });
      };
      img.src =
        "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23f4b511' d='M12 0c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z'/%3E%3C/svg%3E";
    });
  }
}
