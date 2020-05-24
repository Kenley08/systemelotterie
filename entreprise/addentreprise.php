<?php
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Dao/entrepriseDao.class.php";
require_once "../api/Modele/Mentreprise.class.php";

$entreprise=new entrepriseDao();
$entreprise->ident="093845495038";
$entreprise->adminid="1123343299";
$entreprise->nom="Adson Cesar";
$entreprise->logo="";
$entreprise->villeid=65;
$entreprise->adressecomp="tabarre,carrefour rita";
if(isset($entreprise->ident) && isset($entreprise->adminid) && isset($entreprise->nom) && isset($entreprise->logo) && isset($entreprise->villeid) && isset($entreprise->adressecomp)){
  entrepriseDao::add($entreprise);
}

?>
