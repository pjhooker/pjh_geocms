<?php
//aggiungi questo codice dove vuoi visualizzare
//i meta dell'articolo

//da mettere all'inizio
$postid = get_the_ID();

//da mettere dove si vuole visualizzare
//questa è una funzione che cerca in function.php
view_meta_post($postid);
?>
