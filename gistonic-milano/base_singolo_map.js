
			//console.log(markers_t[name]);

			pointhighlight  = new L.featureGroup();

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

			$.getJSON("http://gistonic-milano.1hi.it/supply/geojson/pt_bernareggio.geojson", function(data) {

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
