Mediante questa funzione è possibile definire un set di icone, che vengono associate al punto, in base ad una variabile Feature objects presente nella FeatureCollection.
I  pratica si possono esportare nel formato GeoJSON, i punti di uno shapefile con QGis. Nella tabella di questi punti, possiamo creare una colonna chiamata [tipo] oppure [icon], ma questo nome è solo un riferimento e potete scegliere qualsiasi nome. Come valore, per ogni punto inserite dei nomi, che rappresentano le categorie, come nell’esempio: admin, event, natural_tree, …
Dall’esportazione otteniamo così un file, che aprendolo con un editor di testo, possiamo individuare facilmente il  Feature objects [tipo] :

{ "features" : [{ 
  "geometry" :{
    "coordinates" : [8.855103661376916,45.616284964878155],
    "type" : "Point"
  },
        "properties" : {
    "colour" : "#ffffff", ...,"tipo":"natural_tree",...
  },
        "type" : "Feature"
      },
      {
  "geometry" : ...


In base a questo  Feature objects [tipo] possiamo definire una funzione che ad ogni punto, legge la variabile [tipo] e restituisce un valore definito:

vedi pagina sorgente line:499
function getIcon(d) {
return
d === "none" ? "icon/icon_poi.png" :
            d === "natural_tree" ? "icon/tree.png" :
            …
d === "archaeological_site" ? "icon/archeol.png" :
"icon/poi_generico.png";           
}
Questa funzione, o meglio la variabile getIcon, può essere adesso richiamata, mentre si “disegna” il marker
vedi pagina sorgente line:518
var theaters = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
    return L.marker(latlng, {
      icon: L.icon({
        iconUrl:  getIcon(feature.properties.tipo),
        ...
da notare che come in ogni funzione, si può definire una variabile function(variable) ed in questo caso la variabile è proprio la feature object [tipo].


ulteriori sviluppi
la scritta d=== “text1” ? “text2” : per i meno esperti è la sintassi in javascript per dire “se trovi questo valore, restituisco quest’altro valore” e in php equivale a: if($d==”text1){$valoreritorno=”text2”} else if ; IF/ELSE nei diversi linguaggi di programmazione sono molto usati e questo è un output chiaro, per il suo utilizzo.
Invece di definire esattamente un valore associato ad un altro, si può inserire una classificazione di tipo continua, ad esempio d < 1000 ? …
E poi invece delle icone, che possono essere anche dei grafici a torta (bosta salvare 5 immagini rappresentative, che può bastare), ma sopratutto si possono dimensionare in modo diverso, colorare, quindi restituire qualsiasi tipo di informazione, nel modo più graficamente comprensibile che si desidera.
