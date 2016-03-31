/*
 * PROGETTO Simple Map for Wordpress by GISTONIC-MILANO
 * file: base_singolo_map.js
 *
 * file che compongono il progetto:
 * - base_singolo_map.js (https://github.com/pjhooker/pjh_geocms/blob/master/gistonic-milano/base_singolo_map.js)
 * - base_singolo_style.js (https://github.com/pjhooker/pjh_geocms/blob/master/gistonic-milano/base_singolo_style.js)
 *
 * Spiegazione: http://gistonic-milano.1hi.it/pubblicare-mappa-un-layer/
 *
 * In questo file ci sono le impostazioni per la mappa
 *
 */

	// TILE LAYER

		// Definizione del TileLayer da caricare come sfondo
		var project_tile ='http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png';

		// Definizione degli attribuit / licenza del Tile Layer
		var attribution_tile = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>';

	// LAYER vettoriali

		// featureGroup aggiuntivi
		pointhighlight  = new L.featureGroup();

		//  LAYER 01
		$.getJSON("http://gistonic-milano.1hi.it/supply/geojson/pl_bernareggio.geojson", function(data) {

			function_icon = 'pl_strade';
			name = 'l1_1';
			markers_t[name] = new L.featureGroup();
			var def_icon = new Array();
			def_icon["temp"] = eval(function_icon);

			var geojson = L.geoJson(
				data,
				{
					onEachFeature: def_icon["temp"]
				}
			);

			geojson.addTo(map);

		});

		//  LAYER 02
		$.getJSON("http://gistonic-milano.1hi.it/supply/geojson/pt_bernareggio.geojson", function(data) {

			// LAYER 02 A

				// le opzioni per definire il marker sono limitate
				// se come in questo caso si vuole creare un cerchio
				// con un'icona al centro, la soluzione più comoda
				// è quella di duplicare il layer e associare un icona

				function_icon = 'pt_strade_back';
				name = 'l1_2b';
				markers_t[name] = new L.featureGroup();
				var def_icon = new Array();
				def_icon["temp"] = eval(function_icon);

				var geojson1 = L.geoJson(
					data,
					{
						pointToLayer: def_icon["temp"] //eval(name)
					}
				);

				geojson1.addTo(map);

			// LAYER 02 B

				function_icon = 'pt_strade';
				name = 'l1_2';
				markers_t[name] = new L.featureGroup();
				var def_icon = new Array();
				def_icon["temp"] = eval(function_icon);

				var geojson = L.geoJson(
					data,
					{
						pointToLayer: def_icon["temp"] //eval(name)
					}
				);

				geojson.addTo(map);

		});

		//  LAYER 03
		$.getJSON("http://gistonic-milano.1hi.it/supply/geojson/pg_bernareggio.geojson", function(data) {

			function_icon = 'pg_strade';
			name = 'l1_3';
			markers_t[name] = new L.featureGroup();
			var def_icon = new Array();
			def_icon["temp"] = eval(function_icon);

			var geojson = L.geoJson(
				data,
				{
					onEachFeature: def_icon["temp"]
				}
			);

			geojson.addTo(map);

		});
