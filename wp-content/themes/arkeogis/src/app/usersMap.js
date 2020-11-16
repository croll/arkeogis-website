import * as Papa from "papaparse";
import mapboxgl from "mapbox-gl";

mapboxgl.accessToken =
  "pk.eyJ1IjoiY2hyaXNiZXZlIiwiYSI6ImNrZ3FxZmc2aDA3amgyeHF3eW45YWNvYWcifQ.9NQUkCisnXuiWYAOBmJMvw";

export default class usersMaps {
  constructor(selector, lang) {
    this.NUMBER_OF_CELS = 6;
  }

  fetchDatas() {
    return new Promise((resolve, reject) => {
      Papa.parse(`/wp-content/themes/arkeogis/datas/users.csv`, {
        download: true,
        error: (error) => {
          console.error(`Error fetching users csv file: ${error}`, error);
        },
        complete: function (result) {
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

  async initMap() {
    const datas = await fetchDatas();

    const map = new mapboxgl.Map({
      container: document.querySelector(selector),
      center: [7.7521113, 48.5734053],
      zoom: 1.5,
      style: "mapbox://styles/mapbox/light-v10",
      antialias: true,
    });

    this.map.on("load", () => {
      this.map.addSource("users", {
        type: "geojson",
        data: datas,
      });

      this.map.addLayer({
        id: "users",
        type: "circle",
        source: "users",
        paint: {
          "circle-radius": 8,
          "circle-color": "#007cbf",
        },
      });

      var popup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false,
      });

      this.map.on("mouseenter", "users", function (e) {
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
        popup.setLngLat(coordinates).setHTML(`<b>${name}</b>`).addTo(this.map);
      });

      this.map.on("mouseleave", "users", function () {
        this.map.getCanvas().style.cursor = "";
        popup.remove();
      });
    });

    // console.log({
    //   type: "geojson",
    //   data: datas,
    // });
  }
}
