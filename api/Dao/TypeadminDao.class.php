<?php
 class typeadminDao{


     public static function GetTypeAdmin(){
               $con=new connexion();
               $cont=$con->executerequete("select * from tbltypeadministration");
               $con->closeconnexion();
               return $cont;

     }

      public static function UpdateTypeAdmin($type){
                     $con=new connexion();
                     $con->executeactualisation("update tbltypeadministration set type_admin='$type->typeadmin',date_modifier=NOW() where id_type_admin='$type->idtypeadmin'");
                     $con->closeconnexion();

                 }



 }

?>
