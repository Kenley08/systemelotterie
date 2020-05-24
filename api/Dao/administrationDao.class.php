<?php
 class administrationDao{
   //fonction pour creer typeadmin
   public static function createadmin($admin){
   $con=new connexion();
   $resultat=$con->executeactualisation("insert into tbladministration (id_admin,type_admin_id,nom_complet,pin,email,telephone,ville_id,adresse_complete,etat,date_ajout,date_modifier)
   values('" . $admin->idadmin . "','" . $admin->typeadminid . "','" . $admin->nomcomplet . "','" . $admin->pin . "','" . $admin->email . "','" . $admin->telephone . "','" . $admin->villeid . "',
   '" . $admin->adressecomplete . "','" . $admin->etat . "',NOW(),NOW())");
   $con->closeconnexion();

   }

     public static function getadminbyemailorphone($admin){
       $con=new connexion();
       $cont=$con->executerequete("select email,telephone from tbladministration where email='$admin->email' or telephone=$admin->telephone");
       $con->closeconnexion();
       return $cont[0];
     }


     public static function getadminbyid($id){
               $con=new connexion();
               $cont=$con->executerequete("SELECT a.id_admin,a.nom_complet,a.pin,a.email,a.telephone,a.adresse_complete,t.type_admin,a.type_admin_id,a.ville_id FROM tbladministration a
                INNER join tbltypeadministration t on a.type_admin_id=t.id_type_admin WHERE id_admin='$id'");
               $con->closeconnexion();
               return $cont[0];

     }


     public static function updateadmin($admin){
               $con=new connexion();
               $con->executeactualisation("update tbladministration set nom_complet='$admin->nomcomplet',pin='$admin->pin',email='$admin->email',telephone='$admin->telephone',ville_id=$admin->villeid,adresse_complete='$admin->adressecomplete',
               date_modifier=NOW() where id_admin='$admin->idadmin'");
               $con->closeconnexion();

     }

     public static function bloke($id){
               $con=new connexion();
               $con->executeactualisation("update tbladministration set etat=0 where id_admin='$id'");
               $con->closeconnexion();

     }

     public static function debloke($id){
               $con=new connexion();
               $con->executeactualisation("update tbladministration set etat=1 where id_admin='$id'");
               $con->closeconnexion();

     }



 }

?>
