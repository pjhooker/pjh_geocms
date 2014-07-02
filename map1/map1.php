<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Tutorial WP geo post | MAPPA 1 - tutorial</title>
    <link rel='stylesheet' href='http://openlayers.org/dev/theme/default/style.css' type='text/css'>
    <script src='http://openlayers.org/dev/OpenLayers.js'></script>
</head>

<body onload='init()'  style='text-align:center;'>

<style type="text/css">
    #map {
        width: 100%;
        height: 100%;
        border: 1px solid #00BFFF;
        background-color: #fff;
    }
</style>

<script type="text/javascript">
            
    var map;
    var lon = 9.180763,
        lat = 45.477369, 
        zoom = 10,
        epsg4326 = new OpenLayers.Projection('EPSG:4326'),
        epsg900913 = new OpenLayers.Projection('EPSG:900913');
    var layer, markers;
    var currentPopup;

// function INIT -START
function init(){
    
    var option = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326")
            };
            
        map = new OpenLayers.Map('map', option);

        /* MAPPA OPENNSTREETMAP standard
         * olmapnik = new OpenLayers.Layer.OSM("OpenStreetMap Mapnik", "http://tile.openstreetmap.org/${z}/${x}/${y}.png", {layers: 'basic'} );
         */
         
        // MAPPA OPENNSTREETMAP OpenCycleMap
        olmapnik = new OpenLayers.Layer.OSM("OpenCycleMap",
            ["http://a.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png",
            "http://b.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png",
            "http://c.tile.opencyclemap.org/cycle/${z}/${x}/${y}.png"]
        );

        // Variabili per disegnare i POI -START
        var context = {
            getColor: function(feature) {
                return feature.attributes['Colour'];
            },
            getImageURL: function(feature) {
                return feature.attributes['ImageURL'];
            },
            getLabel: function(feature) {
                return feature.attributes['Label'];
            }
        };

        var template = {
            externalGraphic: "${getImageURL}",
            pointRadius: 50,
            strokeWidth: 50,
            strokeColor: "${getColor}"
        };
        
        var style = new OpenLayers.Style(template, { context: context });
        // Variabili per disegnare i POI -END
        
        // Carica le geometrie da un file JSON -START
        var layer = new OpenLayers.Layer.Vector("GeoJSON", {
            projection: epsg4326,
            /* ALTERNATIVA
             * strategies: [new OpenLayers.Strategy.Fixed()],
             */
            strategies: [new OpenLayers.Strategy.BBOX({resFactor: 1.1})],
            protocol: new OpenLayers.Protocol.HTTP({
                // FILE JSON
                url: "map1.json",
                format: new OpenLayers.Format.GeoJSON()
            })
        });
        
        layer.styleMap = new OpenLayers.StyleMap(style);
        // Carica le geometrie da un file JSON -END
       
        // Quali layer aggiungere
        map.addLayers([olmapnik, layer]);
        
        // Definizione del centro e dello zoom della mappa (definite all'inizio dello script
        map.setCenter(new OpenLayers.LonLat(lon, lat).transform(epsg4326, epsg900913), zoom);


        // Interaction; not needed for initial display
        selectControl = new OpenLayers.Control.SelectFeature(layer);
        map.addControl(selectControl);
        selectControl.activate();
        layer.events.on({
            'featureselected': onFeatureSelect,
            'featureunselected': onFeatureUnselect
        });
}
// function INIT -END

// Needed only for interaction, not for the display -START

// FUNCTION A1 -START
function onPopupClose(evt) {
    // 'this' is the popup.
    var feature = this.feature;
    if (feature.layer) {
        // The feature is not destroyed
        selectControl.unselect(feature);
    } else {
        // After "moveend" or "refresh" events on POIs layer all 
        // features have been destroyed by the Strategy.BBOX
        this.destroy();
    }
}
// FUNCTION A1 -END

// FUNCTION A2 -START
function onFeatureSelect(evt) {
    feature = evt.feature;
    popup = new OpenLayers.Popup.FramedCloud("featurePopup",
        feature.geometry.getBounds().getCenterLonLat(),
        new OpenLayers.Size(100,100),
        // Cosa appare nel popup -START
        "<a href='"+feature.attributes.url_post+"'>" +
            "<b>"+feature.attributes.titolo + "</b>" +
        "</a>" +
        "<br>" + 
        "<img src='" + feature.attributes.picture + "' style='width:350px;height:auto;'>"
        ,
        // Cosa appare nel popup -END
        null, true, onPopupClose
    );
    feature.popup = popup;
    popup.feature = feature;
    map.addPopup(popup, true);
}
// FUNCTION A2 -END

// FUNCTION A3 -START
function onFeatureUnselect(evt) {
    feature = evt.feature;
    if (feature.popup) {
        popup.feature = null;
        map.removePopup(feature.popup);
        feature.popup.destroy();
        feature.popup = null;
    }
}
// FUNCTION A3 -END

// Needed only for interaction, not for the display -END

</script>
        <table width='100%'>
            <tr>
                <a href='http://youtu.be/tSQIahCTkWw'>
                    <h1>HOW TO CMS GEO</h1>
                </a>
                <b>come trasformare Wordpress in un CMS geospaziale</b>
            </tr>
            <tr>
                <td align='center'>
                    <div id='map' style='width:800px;height:800px;'></div>
                </td>
            </tr>
        </table>
    </body>
</html>
