<?php
  class entrepriseDao{
    //fonction pour ajouter une entreprise
    public static function add($entreprise){
    $con=new connexion();
    $resultat=$con->executeactualisation("insert into tblentreprise (id_entreprise,admin_id,nom,logo,ville_id,adresse_complete,etat,date_ajout,date_modifier)
    values('" . $entreprise->ident . "','" . $entreprise->adminid . "','" . $entreprise->nom . "','" . $entreprise->logo . "','" . $entreprise->villeid . "','" . $entreprise->adressecomp . "',1,NOW(),NOW())");
    $con->closeconnexion();

    }

  }
?>
