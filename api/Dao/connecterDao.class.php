<?php
  class connecterDao{
    //fonction pour creer typeadmin
    public static function connecter($connecter){
    $con=new connexion();
    $resultat=$con->executeactualisation("insert into tblconnexion (id_connexion,admin_id,etat,date_ajout)
    values('" . $connecter->idcon . "','" . $connecter->adminid . "',1,NOW())");
    $con->closeconnexion();

    }

    public static function deconnecter($deconnecter){
    $con=new connexion();
    $resultat=$con->executeactualisation("insert into tblconnexion (id_connexion,admin_id,etat,date_ajout)
    values('" . $deconnecter->idcon . "','" . $deconnecter->adminid . "',0,NOW())");
    $con->closeconnexion();

    }

  }
?>
