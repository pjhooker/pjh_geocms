<!-- qgis2leaf -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/own_style.css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/Autolinker.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet-hash.js"></script>
	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>
<!-- /qgis2leaf -->
<?php 
if(isset($_POST['submit']))
    {
    	// richiama il file geojson con delle geometrie presenti
		$inp = file_get_contents('../experiment_host/supply/geojson/test.geojson');
		// decodifica il file geojson
		$tempArray = json_decode($inp, true);

		// preprara l'array strutturato come definito per i file geojson
		$feature = array(
		    'type' => 'Feature',
		    # Pass other attribute columns here
		    'properties' => array(
		        'color_qgis2leaf' => '#fff',
		        'tipo' => $_POST['tipo']
		    ),
		    'geometry' => array(
		        'type' => 'Point',
		        # Pass Longitude and Latitude Columns here
		        //riceve le coordinate "nascoste" dal popup del POI
		        'coordinates' => array($_POST['lng'], $_POST['lat'])
		    )
		);
	    # Add feature arrays to feature collection array
	    array_push($tempArray['features'], $feature);

	    // encode del vecchio file geojson e degli array da aggiungere
		$jsonData = json_encode($tempArray, JSON_NUMERIC_CHECK);
		file_put_contents('../experiment_host/supply/geojson/test.geojson', $jsonData);

    }
?>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
	var map = L.map('map').setView([45.472928, 9.176332], 13)
	L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'examples.map-i875mjb7'
	}).addTo(map);

	// inserisce un punto con messaggio nel popup al centro della mappa
    var popup = L.popup();
        var lat = 45.472928;
        var lng = 9.176332;
    var marker = L.marker([lat,lng]).addTo(map)
        .bindPopup("Fai click sulla mappa per inserire il POI"
        ).openPopup();

	// variabile per definire l'icona in base al tipo di punto        
	function getStatoIcon(dat) {
		return  dat === 'platano'   ? 'http://www.cityplanner.it/supply/icon_web/tree-icon/svg/autumn2.svg' :
		        dat === 'faggio'   ? 'http://www.cityplanner.it/supply/icon_web/tree-icon/svg/tree79.svg' :
		        'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/park-24.svg';           
	}

	// carica il file geojson col metodo jQuery
	$.getJSON("../experiment_host/supply/geojson/test.geojson", function(data) {
		var geojson = L.geoJson(data, {
	  		pointToLayer: function (feature, latlng) {
	  			// crea un punto e definisce l'icona per ogni punto
	    		return L.marker(latlng, {
	      			icon: L.icon({
	        			iconUrl: getStatoIcon(feature.properties.tipo),
	        			iconSize: [24, 28],
	        			iconAnchor: [12, 28],
	        			popupAnchor: [0, -25]
	      			}),
	      			//
	      			title: feature.properties.tipo,
	      			riseOnHover: true
	   			});
			},
			onEachFeature: function (feature, layer) {
				layer.bindPopup(feature.properties.tipo);
			}
		});
		geojson.addTo(map);
	});

	// inseririsce funzione al click sulla mappa
	function onMapClick(e) {
		// rimuove il punto centrale col popup
		map.removeLayer(marker);
		// prende le coordinate dall'evento
		var lat = (e.latlng.lat);
		var lng = (e.latlng.lng);          
		// definisce il popup     
		popup
		.setLatLng(e.latlng)
		// crea un form all'interno del popup
		.setContent("<form method='POST'><input type='hidden' name='lat' value="
			+lat
			+"><input type='hidden' name='lng' value="
			+lng
			+">"
			+"<input type='radio' name='tipo' value='platano' checked>Platano<br>"
			+"<input type='radio' name='tipo' value='faggio'>Faggio<hr>"
			+"<button type='submit' name='submit' style='padding:4px;width:100%;'>+</button></form>")
		.openOn(map);
	}
	map.on('click', onMapClick);

</script>
