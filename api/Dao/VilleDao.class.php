<?php
class villeDao{
  public static function GetVille(){
            $con=new connexion();
            $cont=$con->executerequete("select * from tblville");
            $con->closeconnexion();
            return $cont;

  }

  // public static function GetVilleById($id){
  //           $con=new connexion();
  //           $cont=$con->executerequete("select nom_ville from tblville WHERE id_ville=$id");
  //           $con->closeconnexion();
  //           return $cont[0];
  //
  // }



}


?>
