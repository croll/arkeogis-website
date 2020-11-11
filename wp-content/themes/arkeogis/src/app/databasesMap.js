import "../node_modules/mapbox-gl/dist/mapbox-gl.css";
import * as Papa from "papaparse";
import mapboxgl from "mapbox-gl";
import area from "@turf/area";
import intersect from "@turf/intersect";
import * as turf from "@turf/helpers";
import gsap from "gsap";

mapboxgl.accessToken =
  "pk.eyJ1IjoiY2hyaXNiZXZlIiwiYSI6ImNrZ3FxZmc2aDA3amgyeHF3eW45YWNvYWcifQ.9NQUkCisnXuiWYAOBmJMvw";

const NUMBER_OF_CELS = 17;
const DB_TYPES = {
  Recherche: [110, 145, 247],
  Inventaire: [155, 255, 0],
  Ouvrage: [253, 109, 101],
};

let minArea = 100,
  maxArea = 0;

const fetchDatas = (lang) => {
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
};

const orderData = (data) => {
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
    if (d.length !== NUMBER_OF_CELS) {
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
      type: d[10],
      stateOfKnowledge: d[11],
      covering: d[12],
      scale: d[14],
      lang: d[15],
      description: d[16],
      isIndeterminate: d[6] === "indéterminé" && d[7] === "indéterminé",
      r: DB_TYPES[d[10]][0],
      g: DB_TYPES[d[10]][1],
      b: DB_TYPES[d[10]][2],
    };

    // Parse geojson geometry
    let geometry;
    if (d[13] !== "") {
      try {
        geometry = JSON.parse(d[13]);
        properties.area = parseInt(area(geometry));
        minArea = Math.min(minArea, properties.area);
        // if (properties.area < 90000) {
        maxArea = Math.max(maxArea, properties.area);
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
    cd.a = gsap.utils.mapRange(minArea, maxArea, 0.8, 0.3, cd.area);
  }

  return sorted;
};

const toGeojson = (computedDatas) => {
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
    featureCollection.features.push({ ...featureStruct, properties, geometry });
  });

  return featureCollection;
};

export default async function databasesMap(selector, lang) {
  let datas = await fetchDatas(lang);

  // Order datas
  datas = orderData(datas);

  const map = new mapboxgl.Map({
    container: document.querySelector(selector),
    center: [7.7521113, 48.5734053],
    zoom: 3,
    pitch: 50,
    bearing: 20,
    style: "mapbox://styles/mapbox/light-v10",
    antialias: true,
  });

  let geoDatas = toGeojson(datas);

  map.on("load", () => {
    map.addSource("bdd", {
      type: "geojson",
      data: geoDatas,
    });

    console.log(toGeojson(datas));

    map.addLayer({
      id: "bdd",
      type: "fill-extrusion",
      source: "bdd",
      paint: {
        "fill-extrusion-base": ["get", "base"],
        "fill-extrusion-height": ["get", "height"],
        // "fill-extrusion-color": ["rgba", 88, 130, 250, ["get", "opacity"]],
        // "fill-extrusion-color": ["rgba", 253, 109, 101, ["get", "opacity"]],
        "fill-extrusion-color": [
          "rgba",
          ["get", "r"],
          ["get", "g"],
          ["get", "b"],
          ["get", "a"],
        ],
        "fill-extrusion-opacity": 0.85,
        "fill-extrusion-vertical-gradient": true,
        // "fill-sort-key": [["get", "nbOfLines"]]
        // "fill-extrusion-color": "#ffaa00",
        // "fill-extrusion-base": 0,
        // "fill-extrusion-opacity": 0.4,
        // "fill-extrusion-height": [
        //   "interpolate", ["linear"], ["zoom"],
        //   0, ["*", 1000, ["get", "nbOfLines"]]
        // ],
      },
      // filter: ["==", "$type", "Point"],
    });

    map.setFilter("bdd", ["==", ["get", "isIndeterminate"], false]);
  });
}
