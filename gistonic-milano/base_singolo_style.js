/*
 * PROGETTO Simple Map for Wordpress by GISTONIC-MILANO
 * file: base_singolo_style.js
 *
 * file che compongono il progetto:
 * - base_singolo_map.js (https://github.com/pjhooker/pjh_geocms/blob/master/gistonic-milano/base_singolo_map.js)
 * - base_singolo_style.js (https://github.com/pjhooker/pjh_geocms/blob/master/gistonic-milano/base_singolo_style.js)
 *
 * Spiegazione: http://gistonic-milano.1hi.it/pubblicare-mappa-un-layer/
 *
 * In questo file ci sono gli stili per la mappa
 *
 */

	//  STYLE layer 01

		// variabile principale
		var pl_strade = function(feature, layer) {
		  // All we're doing for now is loading the default style.
		  // But stay tuned.
			//console.log(feature.properties.image);
			//layer.on('click', function(e) {console.log('Layer clicked!', e);});
			layer.bindPopup(''
				+'<table>'
				+'<tr><th scope="row">Nome</th><td>' + feature.properties.name + '</td></tr>'
				+'<tr><th scope="row">Descrizione</th><td>' + feature.properties.descrizion + '</td></tr>'
				+'<tr><td colspan="2"><img src="' + feature.properties.image + '" style="width:200px; /></td></tr>'
				+'</table>'
			+'');
		  layer.setStyle({
	      color: doStyleLinee('normale'),
	      weight: '7.0',
				dashArray: '0', //'2,10',
				opacity: '1.0',
		  });
		};

		// funzione che ritorna un colore in base ad una variabile
		// in questo caso "color: doStyleLinee('normale')"
		// non associa nessuna variabile e ritorna sempre il colore di "normale"
		function doStyleLinee(d) {
			return 	d === 'normale' ? '#DC143C':
							d === 'Paesistico' ? '#08db0c':
							d === 'Storico-paesistico' ? '#ff7400':
										'#DC143C';
		}


	//  STYLE layer 02

		// STYLE LAYER 02 A

			// STYLE
			function pt_strade(feature,latlng) {
				console.log(feature.properties._storage_o.iconUrl);
				return L.marker(latlng,{
						icon: L.icon({
							iconUrl: getIconGenericXM(feature.properties._storage_o.iconUrl),
							iconSize: [24,24]
						}),
						//clickable:false
				}).on('click', onClick_stazioni_poi);
			}

			// GET ICON
			function getIconGenericXM(d) {

				return	d === "religious-christian-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "Household-Waste-icon.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/waste-basket-24@2x.png' :
								d === "City-Fountain-icon.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/wetland-24@2x.png' :
								d === "library-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "park-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "police-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "hospital-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "fast-food-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "star-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "basketball-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "school-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "parking-24.png" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/' + d :
								d === "null" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/marker-24@2x.png' :
								'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/marker-24@2x.png';
			}

		// STYLE LAYER 02 >B

			// STYLE
			function pt_strade_back(feature,latlng) {
				return L.marker(latlng,{
						icon: L.icon({
							iconUrl: getIconGenericXMcolor(feature.properties._storage_o.color),
							iconSize: [36,36]
						}),
						//clickable:false
				})
			}

			// GET ICON
			function getIconGenericXMcolor(d) {

				return	d === "YellowGreen" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/circle-stroked-24_' + d +'.svg' :
								d === "Green" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/circle-stroked-24_' + d +'.svg' :
								d === "Gold" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/circle-stroked-24_' + d +'.svg' :
								d === "Crimson" ? 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/circle-stroked-24_' + d +'.svg' :
								'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/src/circle-stroked-24_white.svg' ;
			}

		// FUNZIONE SPECIALE ONCLICK LAYER 02 A
		function onClick_stazioni_poi(e) {

			//console.log(e);
			point_highlight = new L.featureGroup();
			//$( "#message" ).html('');
			//$('.alert').removeClass('show');
			//$('.alert').empty();

			pointhighlight.clearLayers();
			map.removeLayer(pointhighlight);

			//console.log('addTree');
			$('#myModal').modal('show');
			$('.modal-body').html(''
			+'<h2>'+e.target.feature.properties.name+'</h2>'
			+''+e.target.feature.properties.descrizion+'<hr>'
			+'<img src="'+e.target.feature.properties.image+'" style="width:300px;">'
			+''
			+'');

			var $input = $('<div class="message" id="message">'
			+'<div class="alert alert-dismissible alert-info">'
			+'<button type="button" class="close" onclick="empty_station()">×</button>'
			+'<strong>&nbsp;Stazione: </strong>&nbsp;'
			+''+e.target.feature.properties.NAME+''
			+'&nbsp;</div>'
			+'</div>');
			$input.appendTo($("#map"));

			// Alla fine crea anche un cerchio trasparente pointhighlight
			// che evidenzia il POI selezionato
			var circle = L.circle([e.target.feature.geometry.coordinates[1], e.target.feature.geometry.coordinates[0]], 200, {
			    color: '#335ae5',
			    fillColor: '#335ae5',
			    fillOpacity: 0.2,
					weight:1
			});
			pointhighlight.addLayer(circle);
			map.addLayer(pointhighlight);

			//console.log(e.target.feature);
		}

	//  STYLE layer 03

	// variabile principale
	var pg_strade = function(feature, layer) {

		//layer.on('click', function(e) {console.log('Layer clicked!', e);});

		// POPUP
		layer.bindPopup(''
			+'<table>'
			+'<tr><th scope="row">Nome</th><td>' + feature.properties.name + '</td></tr>'
			+'<tr><th scope="row">Descrizione</th><td>' + feature.properties.descrizion + '</td></tr>'
			+'<tr><td colspan="2"><img src="' + feature.properties.image + '" style="width:200px; /></td></tr>'
			+'</table>'
		+'');
		// STYLE
    layer.setStyle({
      color: doStylePolygon('normale'),
			fillColor:  doStylePolygon('normale'),
      weight: '7.0',
			dashArray: '0',
			opacity: '1.0',
			fillOpacity: '0.5',
    });

	};

	// funzione che ritorna un colore in base ad una variabile
	// in questo caso "color: doStyleLinee('normale')"
	// non associa nessuna variabile e ritorna sempre il colore di "normale"
  function doStylePolygon(d) {
		return 	d === 'normale' ? '#7DAD6E':
						d === 'Paesistico' ? '#08db0c':
						d === 'Storico-paesistico' ? '#ff7400':
									'#7DAD6E';
  }
