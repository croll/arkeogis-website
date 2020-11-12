import "../node_modules/mapbox-gl/dist/mapbox-gl.css";
import * as Papa from "papaparse";
import mapboxgl from "mapbox-gl";
import area from "@turf/area";
import gsap from "gsap";

mapboxgl.accessToken =
  "pk.eyJ1IjoiY2hyaXNiZXZlIiwiYSI6ImNrZ3FxZmc2aDA3amgyeHF3eW45YWNvYWcifQ.9NQUkCisnXuiWYAOBmJMvw";

export default class databasesMap {
  constructor() {
    this.NUMBER_OF_CELS = 17;
    this.DB_TYPES = {
      search: { rgb: [110, 145, 247], hex: "f59203" },
      inventory: { rgb: [155, 255, 0], hex: "a46dbe" },
      work: { rgb: [253, 109, 101], hex: "8cb044" },
    };

    this.translations = {
      search: {
        fr: "Recherche",
      },
      inventory: {
        fr: "Inventaire",
      },
      work: {
        fr: "Ouvrage",
      },
    };

    this.minArea = 100;
    this.maxArea = 0;
  }

  fetchDatas(lang) {
    return new Promise((resolve, reject) => {
      Papa.parse(`/wp-content/themes/arkeogis/datas/databases-${lang}.csv`, {
        download: true,
        error: (error) => {
          console.error(`Error fetching databases csv file: ${error}`, error);
        },
        complete: function (result) {
          if (result.data.length < 1) {
            reject(`No data fetched`);
            return;
          }
          // resolve(csvToGeoJson(orderData(result.data)));
          resolve(result.data);
        },
      });
    });
  }

  findTranslation(word, lang) {
    for (let trad in this.translations) {
      if (this.translations[trad][lang] === word) {
        return trad;
      }
    }
  }

  orderData(data, lang) {
    let computedDatas = [];

    const compare = (a, b) => {
      if (a[0].area < b[0].area) {
        return -1;
      }
      if (a[0].area > b[0].area) {
        return 1;
      }
      return 0;
    };

    const map = (value, x1, y1, x2, y2) =>
      ((value - x1) * (y2 - x2)) / (y1 - x1) + x2;

    for (let i = 1; i < data.length; i++) {
      // Skip line with wrong number of arguments
      var d = data[i];
      if (d.length !== this.NUMBER_OF_CELS) {
        continue;
      }

      /* File structure
    0: "Nom"
    1: "Auteurs"
    2: "Sujets, Mots-clés"
    3: "Mis à jour"
    4: "Création"
    5: "Licence"
    6: "Début"
    7: "Fin"
    8: "Lignes"
    9: "Sites"
    10: "Type"
    11: "Etat"
    12: "Couverture"
    13: "Couverture Geom"
    14: "Échelle"
    15: "Langue"
    16: "Description"
  */

      const dbType = this.findTranslation(d[10], lang);

      // Set properties for each line
      let properties = {
        name: d[0],
        authors: d[1],
        subject: d[2],
        updateDate: d[3],
        creationDate: d[4],
        license: d[5],
        startDate: parseInt(d[6]),
        endDate: parseInt(d[7]),
        nbOfLines: parseInt(d[8]),
        nbOfSites: parseInt(d[9]),
        type: dbType,
        typeTranslated: d[10],
        stateOfKnowledge: d[11],
        covering: d[12],
        scale: d[14],
        lang: d[15],
        description: d[16],
        isIndeterminate: d[6] === "indéterminé" && d[7] === "indéterminé",
        r: this.DB_TYPES[dbType].rgb[0],
        g: this.DB_TYPES[dbType].rgb[1],
        b: this.DB_TYPES[dbType].rgb[2],
        stripes: `stripes-${dbType}`,
      };

      // Parse geojson geometry
      let geometry;
      if (d[13] !== "") {
        try {
          geometry = JSON.parse(d[13]);
          properties.area = parseInt(area(geometry));
          this.minArea = Math.min(this.minArea, properties.area);
          // if (properties.area < 90000) {
          this.maxArea = Math.max(this.maxArea, properties.area);
          // }
        } catch (e) {
          console.error(e);
        }
      }
      computedDatas.push([properties, geometry]);
    }

    // Sort datas by area size
    let sorted = computedDatas.sort(compare).reverse();

    // Set "base" and "height" properties
    for (let i = 0; i < sorted.length; i++) {
      let cd = computedDatas[i][0];
      cd.base = 28000 * i;
      cd.height = 28500 * i;
      cd.a = gsap.utils.mapRange(this.minArea, this.maxArea, 0.8, 0.3, cd.area);
    }

    return sorted;
  }

  toGeojson(computedDatas) {
    let featureCollection = {
      type: "FeatureCollection",
      features: [],
    };

    const featureStruct = {
      type: "Feature",
      properties: [],
      geometry: undefined,
    };

    computedDatas.forEach(([properties, geometry]) => {
      featureCollection.features.push({
        ...featureStruct,
        properties,
        geometry,
      });
    });

    return featureCollection;
  }

  async init(selector, lang) {
    let datas = await this.fetchDatas(lang);

    // Order datas
    datas = this.orderData(datas, lang);

    const map = new mapboxgl.Map({
      container: document.querySelector(selector),
      center: [7.7521113, 48.5734053],
      zoom: 3,
      // pitch: 50,
      // bearing: 20,
      style: "mapbox://styles/mapbox/dark-v10",
      // style: "mapbox://styles/arkeofi/ckh55i3iv056d19p7id6sod6b",
      antialias: true,
    });

    let geoDatas = this.toGeojson(datas);

    map.on("load", () => {
      map.addSource("bdd", {
        type: "geojson",
        data: geoDatas,
        generateId: true,
      });

      let i = 0;
      for (let type in this.DB_TYPES) {
        const img = new Image(14, 14);
        img.onload = () => {
          map.addImage(`stripes-${type}`, img);
          if (i === 2) {
            map.addLayer({
              id: "bdd-polygons",
              type: "fill",
              source: "bdd",
              paint: {
                "fill-color": "transparent",
              },
            });
            map.addLayer({
              id: "bdd-lines",
              type: "line",
              source: "bdd",
              paint: {
                "line-width": 2,
                "line-color": [
                  "rgba",
                  ["get", "r"],
                  ["get", "g"],
                  ["get", "b"],
                  ["get", "a"],
                ],
              },
            });

            map.on("mouseover", "bdd-lines", (e) => {
              var features = map.queryRenderedFeatures(e.point, {
                layers: ["bdd-lines"],
              });

              console.log("ICI");

              console.log(features);
              if (features.length) {
                setTimeout(() => {
                  this.hoveredStateId = features[0].properties.name;
                  map.setFeatureState(
                    { source: "bdd", id: this.hoveredStateId },
                    { hover: true }
                  );
                  map.setPaintProperty(
                    "bdd-polygons",
                    "fill-pattern",
                    features[0].properties.stripes
                  );
                  map.setFilter("bdd-polygons", [
                    "==",
                    "name",
                    this.hoveredStateId,
                  ]);
                }, 100);
              }
            });
          }
          i++;
        };
        img.src = `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Crect width='10' height='10' fill-opacity='0' /%3E%3Cpath d='M-1,1 l2,-2 M0,10 l10,-10 M9,11 l2,-2' stroke='%23${this.DB_TYPES[type].hex}' stroke-width='1'/%3E%3C/svg%3E`;
      }

      // map.on("mouseleave", "bdd-polygons", (e) => {
      //   if (this.hoveredStateId) {
      //     map.setFeatureState(
      //       { source: "bdd", id: this.hoveredStateId },
      //       { hover: false }
      //     );
      //     map.setPaintProperty(this.hoveredLayerId, "fill-pattern", null);
      //   }
      //   this.hoveredStateId = null;
      //   this.hoveredLayerId = null;
      // });

      /*
        map.addLayer({
          id: "bdd",
          type: "fill",
          source: "bdd",
          paint: {
            "fill-outline-color": [
              "rgba",
              ["get", "r"],
              ["get", "g"],
              ["get", "b"],
              ["get", "a"],
            ],
            "fill-pattern": "stripes",
          },
          // filter: ["==", "$type", "Point"],
        });
        */

      /*
      map.addLayer({
        id: "bdd",
        type: "fill-extrusion",
        source: "bdd",
        paint: {
          "fill-extrusion-base": ["get", "base"],
          "fill-extrusion-height": ["get", "height"],
          "fill-extrusion-color": [
            "rgba",
            ["get", "r"],
            ["get", "g"],
            ["get", "b"],
            ["get", "a"],
          ],
          "fill-extrusion-opacity": 0.85,
          "fill-extrusion-vertical-gradient": true,
        },
        // filter: ["==", "$type", "Point"],
      });
      */

      // map.setFilter("bdd-lines", ["==", ["get", "isIndeterminate"], false]);
    });
  }
}
