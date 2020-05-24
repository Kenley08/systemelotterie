<?php
class postDao{
  //fonction pour add boule
  public static function addPost($post){
  $con=new connexion();
  $resultat=$con->executeactualisation("insert into tblpost (id_post,admin_id,surcussale_id,etat,date_ajout,date_modifier)
  values('" . $post->idpost . "','" . $post->adminid . "','" . $post->surcussaleid . "','" . $post->etat . "',NOW(),NOW())");
  $con->closeconnexion();
  }

  public static function GetAllAdmin($ident){
            $con=new connexion();
            $cont=$con->executerequete("SELECT p.id_post,a.nom_complet,v.nom_ville, s.adresse_complete,a.etat,a.id_admin FROM tblsurcussale s
            inner join tbladministration a
            INNER join tblpost p
            INNER JOIN tblville v
            on p.admin_id=a.id_admin  AND p.surcussale_id=s.id_surcussale and v.id_ville=s.ville_id WHERE s.entreprise_id='$ident'");
            $con->closeconnexion();
            return $cont;
  }

  public static function GetAdmin($nom){
            $con=new connexion();
            $cont=$con->executerequete("SELECT p.id_post,a.nom_complet,v.nom_ville, s.adresse_complete,a.etat,a.id_admin FROM tblpost p
            inner join tbladministration a
            INNER join tblsurcussale s
            INNER JOIN tblville v
            on p.admin_id=a.id_admin  AND p.surcussale_id=s.id_surcussale and v.id_ville=s.ville_id where a.nom_complet='$nom'");
            $con->closeconnexion();
            return $cont[0];
  }

  public static function inactif($id){
    $con=new connexion();
    $con->executeactualisation("update tblpost set etat=0 where id_post='$id'");
    $con->closeconnexion();
  }

  public static function actif($id){
    $con=new connexion();
    $con->executeactualisation("update tblpost set etat=1 where id_post='$id'");
    $con->closeconnexion();
  }
  public static function inactifAllPost($id){
    $con=new connexion();
    $con->executeactualisation("update tblpost set etat=0 where surcussale_id='$id'");
    $con->closeconnexion();
  }
  public static function actifAllPost($id){
    $con=new connexion();
    $con->executeactualisation("update tblpost set etat=1 where surcussale_id='$id'");
    $con->closeconnexion();
  }
}
?>
