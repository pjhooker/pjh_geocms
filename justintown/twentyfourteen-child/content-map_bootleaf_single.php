
<?php
$icon1 = "http://www.cityplanner.it/supply/icon_web/set4_lwt_map_icons/mapicon/administration.png";
$icon2 = "http://www.cityplanner.it/supply/icon_web/set4_lwt_map_icons/mapicon/administration.png";
?>

<?php /*
<section id="page">
    <div class="container">
        <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) { the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php edit_post_link( __( 'Edit', ZEETEXTDOMAIN ), '<small class="edit-link pull-right ">', '</small><div class="clearfix"></div>' ); ?>
                <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php } ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php zee_link_pages(); ?>
                </div>
            </article>
            <?php comments_page(); ?>
            <?php } ?>
        </div><!--/#content-->
    </div>
</section><!--/#page-->
<?php get_footer();
*/
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation"  style='background-color:#386DBD;'>
      <div class="navbar-header" style='background-color:#386DBD;'>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand"><?php $title=get_the_title(); echo $title;?></span>
      </div>
      <div class="navbar-collapse collapse">
      <?php/*
        <form class="navbar-form navbar-right" role="search">
          <div class="form-group has-feedback navbar-right">
              <input id="searchbox" type="text" placeholder="Search" class="form-control">
              <span id="searchicon" class="fa fa-search form-control-feedback"></span>
          </div>
        </form>
         */
          ?>
        <ul class="nav navbar-nav">
          <li>
          <!--<a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="$('#aboutModal').modal('show'); return false;">
          <i class="fa fa-question-circle" style="color: white"></i>&nbsp;&nbsp;About</a>
          -->
          <a href="http://www.cityplanner.it/" style="color: white;">
          <i class="fa fa-question-circle"></i>&nbsp;&nbsp;City Planner</a>
          </li>
          <?php/*
          <li class="dropdown">
            <a id="toolsDrop" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe" style="color: white"></i>&nbsp;&nbsp;Tools <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="map.fitBounds(boroughs.getBounds()); return false;"><i class="fa fa-arrows-alt"></i>&nbsp;&nbsp;Zoom To Full Extent</a></li>
              <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="$('#legendModal').modal('show'); return false;"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Show Legend</a></li>
              <li class="divider hidden-xs"></li>
              <li><a href="#" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="$('#loginModal').modal('show'); return false;"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</a></li>
            </ul>
          </li>
          <li class="dropdown">
              <a class="dropdown-toggle" id="downloadDrop" href="#" role="button" data-toggle="dropdown"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;Download <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="http://www.cityplanner.it/php/bootleaf-master/data/boroughs.geojson" download="boroughs.geojson" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Boroughs</a></li>
                <li><a href="http://www.cityplanner.it/php/bootleaf-master/data/subways.geojson" download="subways.geojson" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Subway Lines</a></li>
                <li><a href="http://www.cityplanner.it/php/bootleaf-master/data/DOITT_THEATER_01_13SEPT2010.geojson" download="theaters.geojson" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Theaters</a></li>
                <li><a href="http://www.cityplanner.it/php/bootleaf-master/data/DOITT_MUSEUM_01_13SEPT2010.geojson" download="museums.geojson" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-download"></i>&nbsp;&nbsp;Museums</a></li>
              </ul>
          </li>
          */
          ?>
          <li><a href="#" style="color: white;" data-toggle="collapse" data-target=".navbar-collapse.in" onclick="sidebar.toggle(); return false;">
          <i class="fa fa-list" style="color: white"></i>&nbsp;&nbsp;POI List</a>
          </li>
        </ul>
      </div><!--/.navbar-collapse -->
    </div>

    <div id="map"></div>
    <div id="sidebar">
      <div class="sidebar-wrapper">
        <div class="panel panel-default" style="margin: 0px; border: none; border-radius: 0px; -webkit-box-shadow: none; box-shadow: none;">
          <div class="panel-heading">
            <h3 class="panel-title" style="display: inline;">Points of Interest<button type="button" class="btn btn-xs btn-default pull-right" onclick="sidebar.hide();"><i class="fa fa-chevron-left"></i></button></h3>
          </div>
          <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="poi-tabs">
              <li class="active"><a href="#theaters" onclick="$('#poi-tabs a[href=\'#theaters\']').tab('show'); return false;"><img src="<?php echo $icon1;?>" height="16px" width="14px">&nbsp;POI</li>
              <!--<li><a href="#museums" onclick="$('#poi-tabs a[href=\'#museums\']').tab('show'); return false;"><img src="<?php echo $icon2;?>" height="16px" width="14px">&nbsp;Garden</a></li>-->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="theaters">
                <p>
                  <div class="row">
                    <div class="col-xs-8 col-md-8">
                      <input type="text" class="form-control search" placeholder="Search" />
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <button type="button" class="btn btn-primary pull-right sort" data-sort="theater-name"><i class="fa fa-sort"></i>&nbsp;&nbsp;Sort</button>
                    </div>
                  </div>
                </p>
                <div class="sidebar-table">
                  <table class="table table-hover" id="theater-table">
                    <thead class="hidden">
                      <tr>
                        <th>Name</th>
                      <tr>
                    </thead>
                    <tbody class="list"></tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="museums">
                <p>
                  <div class="row">
                    <div class="col-xs-8 col-md-8">
                      <input type="text" class="form-control search" placeholder="Search" />
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <button type="button" class="btn btn-primary pull-right sort" data-sort="museum-name"><i class="fa fa-sort"></i>&nbsp;&nbsp;Sort</button>
                    </div>
                  </div>
                </p>
                <div class="sidebar-table">
                  <table class="table table-hover" id="museum-table">
                    <thead class="hidden">
                      <tr>
                        <th>Name</th>
                      <tr>
                    </thead>
                    <tbody class="list"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="loading">
      <div class="loading-indicator">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-info" style="width: 100%"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Welcome to the BootLeaf template!</h4>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs" id="aboutTabs">
              <li class="active"><a href="#about" data-toggle="tab"><i class="fa fa-question-circle"></i>&nbsp;About the project</a></li>
              <li><a href="#contact" data-toggle="tab"><i class="fa fa-envelope"></i>&nbsp;Contact us</a></li>
              <li><a href="#disclaimer" data-toggle="tab"><i class="fa fa-exclamation-circle"></i>&nbsp;Disclaimer</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i>&nbsp;Metadata <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#boroughs-tab" data-toggle="tab">Boroughs</a></li>
                  <li><a href="#subway-lines-tab" data-toggle="tab">Subway Lines</a></li>
                  <li><a href="#theaters-tab" data-toggle="tab">POI</a></li>
                  <!--<li><a href="#museums-tab" data-toggle="tab">Garden</a></li>-->
                </ul>
              </li>
            </ul>
            <div class="tab-content" id="aboutTabsContent" style="padding-top: 10px;">
              <div class="tab-pane fade active in" id="about">
                <p>A simple, responsive template for building web mapping applications with <a href="http://getbootstrap.com/">Bootstrap 3</a>, <a href="http://leafletjs.com/" target="_blank">Leaflet</a>, and <a href="http://twitter.github.io/typeahead.js/" target="_blank">typeahead.js</a>. Open source, MIT licensed, and available on <a href="https://github.com/bmcbride/bootleaf" target="_blank">GitHub</a>.</p>
                <div class="panel panel-primary">
                  <div class="panel-heading">Features</div>
                  <ul class="list-group">
                    <li class="list-group-item">Fullscreen mobile-friendly map template with responsive navbar and modal placeholders</li>
                    <li class="list-group-item">jQuery loading of external GeoJSON files</li>
                    <li class="list-group-item">Logical multiple layer marker clustering via the <a href="https://github.com/Leaflet/Leaflet.markercluster" target="_blank">leaflet marker cluster plugin</a></li>
                    <li class="list-group-item">Elegant client-side multi-layer feature search with autocomplete using <a href="http://twitter.github.io/typeahead.js/" target="_blank">typeahead.js</a></li>
                    <li class="list-group-item">Responsive sidebar feature list with sorting and filtering via the <a href="https://github.com/turbo87/leaflet-sidebar/" target="_blank">leaflet-sidebar plugin</a> and <a href="http://listjs.com/" target="_blank">list.js</a></li>
                    <li class="list-group-item">Marker icons included in grouped layer control via the <a href="https://github.com/ismyrnow/Leaflet.groupedlayercontrol" target="_blank">grouped layer control plugin</a></li>
                  </ul>
                </div>
              </div>
              <div id="disclaimer" class="tab-pane fade text-danger">
                <p>The data provided on this site is for informational and planning purposes only.</p>
                <p>Absolutely no accuracy or completeness guarantee is implied or intended. All information on this map is subject to such variations and corrections as might result from a complete title search and/or accurate field survey.</p>
              </div>
              <div class="tab-pane fade" id="contact">
                <form id="contact-form">
                  <div class="well well-sm">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="first-name">First Name:</label>
                          <input type="text" class="form-control" id="first-name">
                        </div>
                        <div class="form-group">
                          <label for="last-name">Last Name:</label>
                          <input type="text" class="form-control" id="last-email">
                        </div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="text" class="form-control" id="email">
                        </div>
                      </div>
                      <div class="col-md-8">
                        <label for="message">Message:</label>
                        <textarea class="form-control" rows="8" id="message"></textarea>
                      </div>
                      <div class="col-md-12">
                        <p>
                          <button type="submit" class="btn btn-primary pull-right" data-dismiss="modal">Submit</button>
                        </p>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="boroughs-tab">
                <p>Borough data courtesy of <a href="http://www.nyc.gov/html/dcp/html/bytes/meta_dis_nyboroughwi.shtml" target="_blank">New York City Department of City Planning</a></p>
              </div>
              <div class="tab-pane fade" id="subway-lines-tab">
                <p><a href="http://spatialityblog.com/2010/07/08/mta-gis-data-update/#datalinks" target="_blank">MTA Subway data</a> courtesy of the <a href="http://www.urbanresearch.org/about/cur-components/cuny-mapping-service" target="_blank">CUNY Mapping Service at the Center for Urban Research</a></p>
              </div>
              <div class="tab-pane fade" id="theaters-tab">
                <p>Theater data courtesy of <a href="https://data.cityofnewyork.us/Recreation/Theaters/kdu2-865w" target="_blank">NYC Department of Information & Telecommunications (DoITT)</a></p>
              </div>
              <div class="tab-pane fade" id="museums-tab">
                <p>Museum data courtesy of <a href="https://data.cityofnewyork.us/Recreation/Museums-and-Galleries/sat5-adpb" target="_blank">NYC Department of Information & Telecommunications (DoITT)</a></p>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="legendModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Map Legend</h4>
          </div>
          <div class="modal-body">
            <p>Map Legend goes here...</p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>
          <div class="modal-body">
            <form id="contact-form">
              <fieldset>
                <div class="form-group">
                  <label for="name">Username:</label>
                  <input type="text" class="form-control" id="username">
                </div>
                <div class="form-group">
                  <label for="email">Password:</label>
                  <input type="password" class="form-control" id="password">
                </div>
              </fieldset>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary pull-right" data-dismiss="modal">Login</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-primary" id="feature-title"></h4>
          </div>
          <div class="modal-body" id="feature-info"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="attributionModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              Developed by <a href='http://bryanmcbride.com'>bryanmcbride.com</a>
            </h4>
          </div>
          <div class="modal-body">
            <div id="attribution"></div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.2/typeahead.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.3.0/handlebars.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
    <script src="//cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js"></script>
    <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.24.0/L.Control.Locate.js"></script>
    <script src="http://www.cityplanner.it/php/bootleaf-master/assets/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js"></script>
    <script src="http://www.cityplanner.it/php/bootleaf-master/assets/leaflet-activearea/L.activearea.js"></script>
    <script src="http://www.cityplanner.it/php/bootleaf-master/assets/leaflet-sidebar-0.1.5/L.Control.Sidebar.js"></script>
    
    <?php
/*
<script src="http://www.cityplanner.it/php/bootleaf-master/assets/js/app.js"></script>
*/
    ?>
    <script type="text/javascript">
var map, boroughSearch = [], theaterSearch = [], museumSearch = [];

$(document).ready(function() {
  getViewport();
});

function getViewport() {
  if (sidebar.isVisible()) {
    map.setActiveArea({
      position: "absolute",
      top: "0px",
      left: $(".leaflet-sidebar").css("width"),
      right: "0px",
      height: $("#map").css("height")
    });
  } else {
    map.setActiveArea({
      position: "absolute",
      top: "0px",
      left: "0px",
      right: "0px",
      height: $("#map").css("height")
    });
  }
}

function sidebarClick(id) {
  /* If sidebar takes up entire screen, hide it and go to the map */
  if (document.body.clientWidth <= 767) {
    sidebar.hide();
    getViewport();
  }
  map.addLayer(theaterLayer).addLayer(museumLayer);
  var layer = markerClusters.getLayer(id);
  markerClusters.zoomToShowLayer(layer, function() {
    map.setView([layer.getLatLng().lat, layer.getLatLng().lng], 18);
    layer.fire("click");
  });
}

/* Basemap Layers */
var mapquestOSM = L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png", {
  maxZoom: 19,
  subdomains: ["otile1", "otile2", "otile3", "otile4"],
  attribution: 'Tiles courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">. Map data (c) <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> contributors, CC-BY-SA.'
});
var mapquestOAM = L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg", {
  maxZoom: 18,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"],
  attribution: 'Tiles courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>. Portions Courtesy NASA/JPL-Caltech and U.S. Depart. of Agriculture, Farm Service Agency'
});
var mapquestHYB = L.layerGroup([L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg", {
  maxZoom: 18,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"]
}), L.tileLayer("http://{s}.mqcdn.com/tiles/1.0.0/hyb/{z}/{x}/{y}.png", {
  maxZoom: 19,
  subdomains: ["oatile1", "oatile2", "oatile3", "oatile4"],
  attribution: 'Labels courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> <img src="http://developer.mapquest.com/content/osm/mq_logo.png">. Map data (c) <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> contributors, CC-BY-SA. Portions Courtesy NASA/JPL-Caltech and U.S. Depart. of Agriculture, Farm Service Agency'
})]);

/* Overlay Layers */
var highlight = L.geoJson(null);

var boroughs = L.geoJson(null, {
  style: function (feature) {
    return {
      color: "#0099FF",
      fill: false,
      opacity: 0.7,
      clickable: false
    };
  },
  onEachFeature: function (feature, layer) {
    boroughSearch.push({
      name: layer.feature.properties.BoroName,
      source: "Boroughs",
      id: L.stamp(layer)/*,
      bounds: layer.getBounds()*/
    });
  }
});
$.getJSON("http://www.cityplanner.it/valleolona/geodata/olona.geojson", function (data) {
  boroughs.addData(data);
});

var subwayLines = L.geoJson(null, {
  style: function (feature) {
    if (feature.properties.highway === 'cycleway') {
      return {
        color: "#993300",
        weight: 3,
        opacity: 1
      };
    }
    /*
    if (feature.properties.idm === 1001) {
      return {
        color: "#00CC99",
        weight: 3,
        opacity: 1
      };
    }
    if (feature.properties.idm === 1002) {
      return {
        color: "#ff3135",
        weight: 3,
        opacity: 1
      };
    }
    */
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Division</th><td>" + feature.properties.name + "</td></tr>" + "<tr><th>Line</th><td>" + feature.properties.Line + "</td></tr>" + "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.Line);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([e.latlng.lat, e.latlng.lng], {
            stroke: false,
            fillColor: "#993300",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
    }
    layer.on({
      mouseover: function (e) {
        var layer = e.target;
        layer.setStyle({
          weight: 3,
          color: "#00FFFF",
          opacity: 1
        });
        if (!L.Browser.ie && !L.Browser.opera) {
          layer.bringToFront();
        }
      },
      mouseout: function (e) {
        subwayLines.resetStyle(e.target);
      }
    });
  }
});
$.getJSON("http://www.cityplanner.it/valleolona/geodata/piste.geojson", function (data) {
  subwayLines.addData(data);
});

/* Single marker cluster layer to hold all clusters */
var markerClusters = new L.MarkerClusterGroup({
  spiderfyOnMaxZoom: true,
  showCoverageOnHover: false,
  zoomToBoundsOnClick: true,
  disableClusteringAtZoom: 16
});

function getIcon(d) {
    return  d === "none" ? "<?php echo tipo_icon('none'); ?>" :
            d === "archaeological_site" ? '<?php echo tipo_icon("archaeological_site"); ?>' :
            d === "admin" ? '<?php echo tipo_icon("admin"); ?>' :
            d === "event" ? '<?php echo tipo_icon("event"); ?>' :
            d === "path" ? '<?php echo tipo_icon("path"); ?>' :
            d === "natural_tree" ? '<?php echo tipo_icon("natural_tree"); ?>' :
            d === "drinking_water" ? '<?php echo tipo_icon("drinking_water"); ?>' :
            d === "place_of_worship" ? '<?php echo tipo_icon("place_of_worship"); ?>' :
            d === "watermill" ? '<?php echo tipo_icon("watermill"); ?>' :
            d === "historic_railway" ? '<?php echo tipo_icon("historic_railway"); ?>' :
            d === "bridge" ? '<?php echo tipo_icon("bridge"); ?>' :
            d === "residential" ? '<?php echo tipo_icon("residential"); ?>' :
            '<?php echo tipo_icon("none"); ?>';           
}


/* Empty layer placeholder to add to layer control for listening when to add/remove theaters to markerClusters layer */
var theaterLayer = L.geoJson(null);
var theaters = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl:  getIcon(feature.properties.tipo),
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var myicon = getIcon(layer.feature.properties.tipo);
      var content = "<table class='table table-striped table-bordered table-condensed'>" 
      //+ "<tr><th>Name</th><td>" + feature.properties.NAME + "</td></tr>" 
      //+ "<tr><th>Autore</th><td>" + feature.properties.TEL + "</td></tr>" 
      //+  "<tr><th>Address</th><td>" + feature.properties.ADDRESS1 + "</td></tr>" 
+ "<tr><th colspan='2'><a href='" + feature.properties.url_post + "'>Scheda completa</a></th></tr>"
+ "<tr><th colspan='2'>"+feature.properties.titolo+"</th></tr>"
+ "<tr><th>Photo</th><td style='text-align:center;'><img src='" + feature.properties.picture + "' width='250'></td></tr>"
+ ""
+ "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.NAME);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
      $("#theater-table tbody").append('<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;"><td class="theater-name"><img src="'
        + myicon +'" width="20px"> '+layer.feature.properties.titolo+'<i class="fa fa-chevron-right pull-right"></td></tr>');
      theaterSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ADDRESS1,
        source: "Theaters",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
/*
$.getJSON("data/DOITT_THEATER_01_13SEPT2010.geojson", function (data) {
  theaters.addData(data);
  map.addLayer(theaterLayer);
});
*/
$.getJSON("http://www.cityplanner.it/valleolona/geodata/textfile.json", function (data) {
  theaters.addData(data);
  map.addLayer(theaterLayer);
});
/* Empty layer placeholder to add to layer control for listening when to add/remove museums to markerClusters layer */
var museumLayer = L.geoJson(null);
var museums = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl: "<?php echo $icon2;?>",
        iconSize: [24, 28],
        iconAnchor: [12, 28],
        popupAnchor: [0, -25]
      }),
      title: feature.properties.NAME,
      riseOnHover: true
    });
  },
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Name</th><td>" + feature.properties.NAME + "</td></tr>" + "<tr><th>Autore</th><td>" + feature.properties.TEL + "</td></tr>" + "<tr><th>Address</th><td>" + feature.properties.ADRESS1 + "</td></tr>" + "<tr><th>Website</th><td><a class='url-break' href='" + feature.properties.URL + "' target='_blank'>" + feature.properties.URL + "</a></td></tr>" + "<table>";
      layer.on({
        click: function (e) {
          $("#feature-title").html(feature.properties.NAME);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
          highlight.clearLayers().addLayer(L.circleMarker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
            stroke: false,
            fillColor: "#00FFFF",
            fillOpacity: 0.7,
            radius: 10
          }));
        }
      });
      $("#museum-table tbody").append('<tr style="cursor: pointer;" onclick="sidebarClick('+L.stamp(layer)+'); return false;"><td class="museum-name">'+layer.feature.properties.NAME+'<i class="fa fa-chevron-right pull-right"></td></tr>');
      museumSearch.push({
        name: layer.feature.properties.NAME,
        address: layer.feature.properties.ADRESS1,
        source: "Museums",
        id: L.stamp(layer),
        lat: layer.feature.geometry.coordinates[1],
        lng: layer.feature.geometry.coordinates[0]
      });
    }
  }
});
/*
$.getJSON("data/DOITT_MUSEUM_01_13SEPT2010.geojson", function (data) {
  museums.addData(data);
});
*/
$.getJSON("http://www.cityplanner.it/experiment_host/supply/leisure_garden.geojson", function (data) {
  museums.addData(data);
});

map = L.map("map", {
  zoom: 15,
  //center: [40.702222, -73.979378],
  center: [45.598245, 8.915992],
  layers: [mapquestOSM,  subwayLines, boroughs, markerClusters, highlight],
  zoomControl: false,
  attributionControl: false
});

/* Layer control listeners that allow for a single markerClusters layer */
map.on("overlayadd", function(e) {
  if (e.layer === theaterLayer) {
    markerClusters.addLayer(theaters);
  }
  if (e.layer === museumLayer) {
    markerClusters.addLayer(museums);
  }
});

map.on("overlayremove", function(e) {
  if (e.layer === theaterLayer) {
    markerClusters.removeLayer(theaters);
  }
  if (e.layer === museumLayer) {
    markerClusters.removeLayer(museums);
  }
});

/* Clear feature highlight when map is clicked */
map.on("click", function(e) {
  highlight.clearLayers();
});

/* Attribution control */
function updateAttribution(e) {
  $.each(map._layers, function(index, layer) {
    if (layer.getAttribution) {
      $("#attribution").html((layer.getAttribution()));
    }
  });
}
map.on("layeradd", updateAttribution);
map.on("layerremove", updateAttribution);

var attributionControl = L.control({
  position: "bottomright"
});
attributionControl.onAdd = function (map) {
  var div = L.DomUtil.create("div", "leaflet-control-attribution");
  div.innerHTML = "Developed by <a href='http://bryanmcbride.com'>bryanmcbride.com</a> | <a href='#' onclick='$(\"#attributionModal\").modal(\"show\"); return false;'>Attribution</a>";
  return div;
};
map.addControl(attributionControl);

var zoomControl = L.control.zoom({
  position: "bottomright"
}).addTo(map);

/* GPS enabled geolocation control set to follow the user's location */
var locateControl = L.control.locate({
  position: "bottomright",
  drawCircle: true,
  follow: true,
  setView: true,
  keepCurrentZoomLevel: true,
  markerStyle: {
    weight: 1,
    opacity: 0.8,
    fillOpacity: 0.8
  },
  circleStyle: {
    weight: 1,
    clickable: false
  },
  icon: "icon-direction",
  metric: false,
  strings: {
    title: "My location",
    popup: "You are within {distance} {unit} from this point",
    outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
  },
  locateOptions: {
    maxZoom: 18,
    watch: true,
    enableHighAccuracy: true,
    maximumAge: 10000,
    timeout: 10000
  }
}).addTo(map);

var sidebar = L.control.sidebar("sidebar", {
  closeButton: true,
  position: "left"
}).on("shown", function () {
  getViewport();
}).on("hidden", function () {
  getViewport();
}).addTo(map);

/* Larger screens get expanded layer control and visible sidebar */
if (document.body.clientWidth <= 767) {
  var isCollapsed = true;
} else {
  var isCollapsed = false;
  sidebar.show();
}

var baseLayers = {
  "Street Map": mapquestOSM,
  "Aerial Imagery": mapquestOAM,
  "Imagery with Streets": mapquestHYB
};

var groupedOverlays = {
  "Points of Interest": {
    "<img src='<?php echo $icon1;?>' width='24' height='28'>&nbsp;POI": theaterLayer/*,
    "<img src='<?php echo $icon2;?>' width='24' height='28'>&nbsp;Garden": museumLayer*/
  }/*,
  "Reference": {
    "Boroughs": boroughs,
    "Subway Lines": subwayLines
  }*/
};

var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
  collapsed: isCollapsed
}).addTo(map);

/* Highlight search box text on click */
$("#searchbox").click(function () {
  $(this).select();
});

/* Typeahead search functionality */
$(document).one("ajaxStop", function () {
  /* Fit map to boroughs bounds */
  map.fitBounds(boroughs.getBounds());
  $("#loading").hide();

  var boroughsBH = new Bloodhound({
    name: "Boroughs",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: boroughSearch,
    limit: 10
  });

  var theatersBH = new Bloodhound({
    name: "Theaters",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: theaterSearch,
    limit: 10
  });
  var theaterList = new List("theaters", {valueNames: ["theater-name"]}).sort("theater-name", {order:"asc"});

  var museumsBH = new Bloodhound({
    name: "Museums",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: museumSearch,
    limit: 10
  });
  var museumList = new List("museums", {valueNames: ["museum-name", "museum-address"]}).sort("museum-name", {order:"asc"});

  var geonamesBH = new Bloodhound({
    name: "GeoNames",
    datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: "http://api.geonames.org/searchJSON?username=bootleaf&featureClass=P&maxRows=5&countryCode=US&name_startsWith=%QUERY",
      filter: function (data) {
        return $.map(data.geonames, function (result) {
          return {
            name: result.name + ", " + result.adminCode1,
            lat: result.lat,
            lng: result.lng,
            source: "GeoNames"
          };
        });
      },
      ajax: {
        beforeSend: function (jqXhr, settings) {
          settings.url += "&east=" + map.getBounds().getEast() + "&west=" + map.getBounds().getWest() + "&north=" + map.getBounds().getNorth() + "&south=" + map.getBounds().getSouth();
          $("#searchicon").removeClass("fa-search").addClass("fa-refresh fa-spin");
        },
        complete: function (jqXHR, status) {
          $('#searchicon').removeClass("fa-refresh fa-spin").addClass("fa-search");
        }
      }
    },
    limit: 10
  });
  boroughsBH.initialize();
  theatersBH.initialize();
  museumsBH.initialize();
  geonamesBH.initialize();

  /* instantiate the typeahead UI */
  $("#searchbox").typeahead({
    minLength: 3,
    highlight: true,
    hint: false
  }, {
    name: "Boroughs",
    displayKey: "name",
    source: boroughsBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'>Boroughs</h4>"
    }
  }, {
    name: "Theaters",
    displayKey: "name",
    source: theatersBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='<?php echo $icon1;?>' width='24' height='28'>&nbsp;Theaters</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "Museums",
    displayKey: "name",
    source: museumsBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='<?php echo $icon2;?>' width='24' height='28'>&nbsp;Museums</h4>",
      suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
    }
  }, {
    name: "GeoNames",
    displayKey: "name",
    source: geonamesBH.ttAdapter(),
    templates: {
      header: "<h4 class='typeahead-header'><img src='http://www.cityplanner.it/php/bootleaf-master/assets/img/globe.png' width='25' height='25'>&nbsp;GeoNames</h4>"
    }
  }).on("typeahead:selected", function (obj, datum) {
    if (datum.source === "Boroughs") {
      map.fitBounds(datum.bounds);
    }
    if (datum.source === "Theaters") {
      if (!map.hasLayer(theaterLayer)) {
        map.addLayer(theaterLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "Museums") {
      if (!map.hasLayer(museumLayer)) {
        map.addLayer(museumLayer);
      }
      map.setView([datum.lat, datum.lng], 17);
      if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
      }
    }
    if (datum.source === "GeoNames") {
      map.setView([datum.lat, datum.lng], 14);
    }
    if ($(".navbar-collapse").height() > 50) {
      $(".navbar-collapse").collapse("hide");
    }
  }).on("typeahead:opened", function () {
    $(".navbar-collapse.in").css("max-height", $(document).height() - $(".navbar-header").height());
    $(".navbar-collapse.in").css("height", $(document).height() - $(".navbar-header").height());
  }).on("typeahead:closed", function () {
    $(".navbar-collapse.in").css("max-height", "");
    $(".navbar-collapse.in").css("height", "");
  });
  $(".twitter-typeahead").css("position", "static");
  $(".twitter-typeahead").css("display", "block");
});

    </script>
  </body>
</html>
