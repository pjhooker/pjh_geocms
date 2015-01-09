<?php
// aggiungi questo codice al tuo function.php
function view_meta_post($ID){
  $key="view_meta";
  $value=get_post_meta($ID,$key,true);
  if ($value==1){
    $div_meta="".the_meta()."<hr>";
  }
  else {
    $div_meta="";
  }
  echo $div_meta;
}
?>
