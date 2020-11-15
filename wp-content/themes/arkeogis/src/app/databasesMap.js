import "../node_modules/mapbox-gl/dist/mapbox-gl.css";
import * as Papa from "papaparse";
import mapboxgl from "mapbox-gl";
import area from "@turf/area";
import gsap from "gsap";
import Draggable from "gsap/Draggable";
import bbox from "@turf/bbox";

gsap.registerPlugin(Draggable);

mapboxgl.accessToken =
  "pk.eyJ1IjoiY2hyaXNiZXZlIiwiYSI6ImNrZ3FxZmc2aDA3amgyeHF3eW45YWNvYWcifQ.9NQUkCisnXuiWYAOBmJMvw";

export default class databasesMap {
  constructor() {
    this.DATE_MIN = -6000;
    this.DATE_MAX = 2020;
    this.NUMBER_OF_CELS = 17;
    this.DB_TYPES = {
      search: { rgb: [253, 109, 101], hex: "fd6d65" },
      inventory: { rgb: [164, 109, 190], hex: "a46dbe" },
      work: { rgb: [140, 176, 68], hex: "8cb044" },
    };
    this.activeFilters = ["search", "work", "inventory"];
    this.dateFilter = [this.DATE_MIN, this.DATE_MAX];

    this.translations = {
      sites: {
        fr: "sites",
        en: "sites",
        es: "sitios",
        de: "stätten",
      },
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

      // If line not well formatted, skip ip
      if (d.length !== this.NUMBER_OF_CELS) {
        continue;
      }

      // If start and end period is undetermined, skip it
      if (d[6] === "indéterminé" && d[7] === "indéterminé") {
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
        id: i,
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
        r: this.DB_TYPES[dbType].rgb[0],
        g: this.DB_TYPES[dbType].rgb[1],
        b: this.DB_TYPES[dbType].rgb[2],
        hex: this.DB_TYPES[dbType].hex,
        stripes: `stripes-${dbType}`,
      };

      // Parse geojson geometry
      let geometry;
      if (d[13] !== "") {
        try {
          geometry = JSON.parse(d[13]);
          properties.bbox = bbox(geometry);
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
    // for (let i = 0; i < sorted.length; i++) {
    //   let cd = computedDatas[i][0];
    //   cd.base = 28000 * i;
    //   cd.height = 28500 * i;
    //   cd.a = gsap.utils.mapRange(this.minArea, this.maxArea, 0.8, 0.3, cd.area);
    // }

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

    console.log(featureCollection);

    return featureCollection;
  }

  filterByDate() {
    const dateSlider = document.querySelector(".dateSlider");
    const timelineWidth = dateSlider.getBoundingClientRect().width - 20; //padding
    const dateMin = Math.round(
      gsap.utils.mapRange(
        0,
        timelineWidth,
        this.DATE_MIN,
        this.DATE_MAX,
        this.drag1[0].x
      )
    );
    const dateMax = Math.round(
      gsap.utils.mapRange(
        0,
        timelineWidth,
        this.DATE_MIN,
        this.DATE_MAX,
        timelineWidth + this.drag2[0].x
      )
    );
    // Update filters
    this.dateFilter = [dateMin, dateMax];
    this.applyFilters();

    // Update labels
    const startContainer = dateSlider.querySelector(".start");
    const endContainer = dateSlider.querySelector(".end");
    gsap.to(startContainer, { x: this.drag1[0].x });
    gsap.to(endContainer, { x: this.drag2[0].x });
    if (this.drag1[0].x > 0) {
      const xPercent1 =
        this.drag1[0].x < startContainer.getBoundingClientRect().width
          ? 0
          : -120;
      gsap.set(startContainer.querySelector(".year"), {
        innerHTML: dateMin,
        xPercent: xPercent1,
      });
    } else {
      gsap.set(startContainer.querySelector(".year"), {
        innerHTML: dateMin,
        xPercent: 0,
      });
    }
    if (this.drag2[0].x < 0) {
      const xPercent2 =
        this.drag2[0].x == 0 || timelineWidth < timelineWidth + this.drag2[0].x
          ? 0
          : 120;
      gsap.set(endContainer.querySelector(".year"), {
        innerHTML: dateMax,
        xPercent: xPercent2,
      });
    } else {
      gsap.set(endContainer.querySelector(".year"), {
        innerHTML: dateMax,
        xPercent: 0,
      });
    }
  }

  filterByType(type) {
    const toolbar = document.querySelector(".app .toolbar");
    if (this.activeFilters.includes(type)) {
      this.activeFilters = this.activeFilters.filter((val) => val !== type);
      gsap.to(toolbar.querySelector(`[data-set="${type}"]`), { opacity: 0.5 });
    } else {
      this.activeFilters.push(type);
      gsap.to(toolbar.querySelector(`[data-set="${type}"]`), { opacity: 1 });
    }
    this.applyFilters();
    // Button all
    // gsap.to(toolbar.querySelector(`[data-set="all"]`), { opacity: this.activeFilters.length == 3 ? 0.5 : 1});
  }

  resetFilters() {
    this.activeFilters = ["search", "work", "inventory"];
    gsap.to(document.querySelectorAll(`.app .button`), { opacity: 1 });
    this.applyFilters();
  }

  applyFilters() {
    const filters = [
      "all",
      ["match", ["get", "type"], this.activeFilters, true, false],
      [
        "any",
        [">=", ["get", "startDate"], this.dateFilter[0]],
        ["==", ["get", "startDate"], "indéterminé"],
      ],
      [
        "any",
        ["<=", ["get", "endDate"], this.dateFilter[1]],
        ["==", ["get", "endDate"], "indéterminé"],
      ],
    ];
    this.map.setFilter("bdd-lines", filters);
    this.map.setFilter("bdd-polygons", filters);
    this.map.setFilter("bdd-for-mouse", filters);
    // Reset representation
    this.resetPolygonLayerFill();
  }

  initFilters() {
    const toolbar = document.querySelector(".app .toolbar");
    // Buttons colored
    toolbar.addEventListener("click", (e) => {
      const type = e.target.getAttribute("data-set");
      if (type === null) {
        return;
      }
      if (type === "all") {
        this.resetFilters();
      } else {
        this.filterByType(type);
      }
    });
    // Button "all"
  }

  initKnobs() {
    const dateSlider = document.querySelector(".dateSlider");
    const knob1 = dateSlider.querySelector(".knob1");
    const knob2 = dateSlider.querySelector(".knob2");
    this.drag1 = Draggable.create(knob1, {
      type: "x",
      bounds: document.querySelector(".dateSlider"),
      onDragEnd: () => {
        this.filterByDate();
      },
    });
    this.drag2 = Draggable.create(knob2, {
      type: "x",
      bounds: document.querySelector(".dateSlider"),
      onDragEnd: () => {
        this.filterByDate();
      },
    });
  }

  async init(selector, lang) {
    this.initKnobs();
    this.initFilters();

    // Init draggable
    let datas = await this.fetchDatas(lang);

    // Order datas
    datas = this.orderData(datas, lang);

    this.map = new mapboxgl.Map({
      container: document.querySelector(selector),
      center: [7.7521113, 48.5734053],
      zoom: 3,
      // pitch: 50,
      // bearing: 20,
      style: "mapbox://styles/mapbox/dark-v10",
      // style: "mapbox://styles/arkeofi/ckh55i3iv056d19p7id6sod6b",
      antialias: true,
      attributionControl: false,
    });

    // this.map.showTileBoundaries = true;

    // Attribution
    this.map.addControl(new mapboxgl.AttributionControl(), "top-right");
    this.map.addControl(
      new mapboxgl.NavigationControl({ showCompass: false }),
      "top-right"
    );
    this.map.addControl(new mapboxgl.FullscreenControl());

    let geoDatas = this.toGeojson(datas);

    this.map.on("load", () => {
      // Add source
      this.map.addSource("bdd", {
        type: "geojson",
        data: geoDatas,
        generateId: true,
      });

      let i = 0;
      for (let type in this.DB_TYPES) {
        // Create stripes
        const img = new Image(14, 14);
        // On image load
        img.onload = () => {
          // Create image
          this.map.addImage(`stripes-${type}`, img);
          // Init map
          if (i === 2) {
            // Polygon layer
            this.map.addLayer({
              id: "bdd-polygons",
              type: "fill",
              source: "bdd",
              paint: {
                "fill-color": "transparent",
                "fill-opacity": 0.5,
              },
            });

            // Lines layer
            this.map.addLayer(
              {
                id: "bdd-lines",
                type: "line",
                source: "bdd",
                paint: {
                  "line-width": 2,
                  "line-color": [
                    "rgb",
                    ["get", "r"],
                    ["get", "g"],
                    ["get", "b"],
                    // ["get", "a"],
                  ],
                },
              },
              "bdd-polygons"
            );

            // Lines layer
            this.map.addLayer({
              id: "bdd-for-mouse",
              type: "fill",
              source: "bdd",
              paint: {
                "fill-color": "transparent",
                "fill-opacity": 0,
              },
            });

            // Popup
            this.popup = new mapboxgl.Popup({
              anchor: "top-right",
              closeButton: false,
              closeOnClick: false,
              className: "arkeoPopup",
              offset: [145, -11],
            });

            // Mouse move
            this.map.on("mousemove", (e) => {
              // Get hovered feature under cursor
              const features = this.map.queryRenderedFeatures(e.point, {
                layers: ["bdd-for-mouse"],
              });
              const hoveredFeature = features[0];

              if (features.length) {
                // Store feature identifier
                this.hoveredStateId = hoveredFeature.properties.id;
                const bb = JSON.parse(hoveredFeature.properties.bbox);
                const popupText = `<div class="name">${hoveredFeature.properties.name}</div><div class="date">${hoveredFeature.properties.startDate} / ${hoveredFeature.properties.endDate}</div><div class="sites">${hoveredFeature.properties.nbOfSites} ${this.translations.sites[lang]}</div>`;
                this.popup
                  .setLngLat([bb[2], bb[3]])
                  .setHTML(popupText)
                  .addTo(this.map);

                this.map.setFeatureState(
                  { source: "bdd", id: this.hoveredStateId },
                  { hover: true }
                );
                // Change polygon layer fill
                this.map.setPaintProperty(
                  "bdd-polygons",
                  "fill-pattern",
                  features[0].properties.stripes
                );
                // Only display hovered polygon
                this.map.setFilter("bdd-polygons", [
                  "==",
                  "id",
                  this.hoveredStateId,
                ]);
                // Display period on time slider
                this.displayPeriod(
                  hoveredFeature.properties.startDate,
                  hoveredFeature.properties.endDate
                );
                // Set mouse pointer icon
                this.map.getCanvas().style.cursor = features.length
                  ? "pointer"
                  : "";
              } else {
                this.resetPolygonLayerFill();
              }
            });

            // this.map.on("mouseleave", "bdd-for-mouse", (e) => {
            //   this.map.setPaintProperty(
            //     "bdd-polygons",
            //     "fill-color",
            //     "transparent"
            //   );
            // });
          }
          i++;
        };
        img.src = `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Crect width='10' height='10' fill-opacity='0' /%3E%3Cpath d='M-1,1 l2,-2 M0,10 l10,-10 M9,11 l2,-2' stroke='%23${this.DB_TYPES[type].hex}' stroke-width='1'/%3E%3C/svg%3E`;
      }

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
    });
  }
  resetPolygonLayerFill() {
    this.map.setPaintProperty("bdd-polygons", "fill-pattern", "");
  }

  displayPeriod(startDate, endDate) {
    const dateSlider = document.querySelector(".dateSlider");
    const timelineWidth = dateSlider.getBoundingClientRect().width - 20; //padding
    const startDatePos = Math.round(
      gsap.utils.mapRange(
        this.DATE_MIN,
        this.DATE_MAX,
        0,
        timelineWidth,
        startDate
      )
    );
    const endDatePos = Math.round(
      gsap.utils.mapRange(
        this.DATE_MIN,
        this.DATE_MAX,
        0,
        timelineWidth,
        endDate
      )
    );
  }
}
