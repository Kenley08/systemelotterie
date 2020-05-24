<?php
class bouleDao{
  //fonction pour add boule
  public static function addBoule($boule){
  $con=new connexion();
  $resultat=$con->executeactualisation("insert into tblboule (id_boule,type_boule_id,boule,prix,fiche_id,date_ajout,date_modifier)
  values('" . $boule->idboule . "','" . $boule->typebouleid . "','" . $boule->boule . "','" . $boule->prix . "','" . $boule->ficheid . "',NOW(),NOW())");
  $con->closeconnexion();
  }

  //fonction pour aditionner les prix des boules joues
  public static function prixtotal($id){
    $con=new connexion();
    $cont=$con->executerequete("select sum(prix) from tblboule where fiche_id='$id'");
    $con->closeconnexion();
    return $cont[0];
  }

  //fonction pour aficher les boules jouer et leur prix
  public static function GetInfoBoule($id){
    $con=new connexion();
    $cont=$con->executerequete("select boule,prix from tblboule where fiche_id='$id'");
    $con->closeconnexion();
    return $cont;
  }
}
?>
