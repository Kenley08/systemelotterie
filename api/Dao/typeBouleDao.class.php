<?php
  class typebouleDao{
         public static function getTypeBoule(){
           $con=new connexion();
           $cont=$con->executerequete("select * from tbltypeboule");
           $con->closeconnexion();
           return $cont;
         }

  }
?>
