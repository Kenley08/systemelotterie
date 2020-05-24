<?php
    class surcussaleDao{
      //fonction pour creer typeadmin
      public static function addSurcussale($surcussale){
      $con=new connexion();
      $resultat=$con->executeactualisation("insert into tblsurcussale (id_surcussale,entreprise_id,ville_id,adresse_complete,etat,date_ajout,date_modifier)
      values('" . $surcussale->idsurcussale . "','" . $surcussale->entrepriseid . "','" . $surcussale->villeid . "','" . $surcussale->adressecomplete . "','" . $surcussale->etat . "',NOW(),NOW())");
      $con->closeconnexion();

      }
      public static function getsurcussalebyid($id){
                $con=new connexion();
                $cont=$con->executerequete("SELECT * FROM tblsurcussale  WHERE id_surcussale='$id'");
                $con->closeconnexion();
                return $cont[0];

      }
           public static function updateSurcussale($surcussale){
                     $con=new connexion();
                     $con->executeactualisation("update tblsurcussale set ville_id=$surcussale->villeid,adresse_complete='$surcussale->adressecomplete',date_modifier=NOW() where id_surcussale='$surcussale->idsurcussale'");
                     $con->closeconnexion();

           }

           public static function inactif($id){
                     $con=new connexion();
                     $con->executeactualisation("update tblsurcussale set etat=0,date_modifier=NOW() where id_surcussale='$id'");
                     $con->closeconnexion();

           }
           public static function actif($id){
                     $con=new connexion();
                     $con->executeactualisation("update tblsurcussale set etat=1,date_modifier=NOW() where id_surcussale='$id'");
                     $con->closeconnexion();

           }

           public static function getAllSurcussale($id){
                     $con=new connexion();
                     $cont=$con->executerequete("SELECT s.id_surcussale,v.nom_ville,s.ville_id,s.adresse_complete,s.etat from tblsurcussale s inner join tblville v
                            on s.ville_id=v.id_ville where entreprise_id='$id' and etat=1");
                     $con->closeconnexion();
                     return $cont;
           }
           
           public static function getAllSurcussale2($id){
                     $con=new connexion();
                     $cont=$con->executerequete("SELECT s.id_surcussale,v.nom_ville,s.ville_id,s.adresse_complete,s.etat from tblsurcussale s inner join tblville v
                            on s.ville_id=v.id_ville where entreprise_id='$id'");
                     $con->closeconnexion();
                     return $cont;

           }


            public static function getByVilleAndAdresse($surcussale){
                      $con=new connexion();
                      $cont=$con->executerequete("SELECT s.id_surcussale,s.etat,s.ville_id,s.adresse_complete,v.nom_ville from tblsurcussale s inner join tblville v
                        on v.id_ville=s.ville_id where s.ville_id=$surcussale->villeid and s.adresse_complete='$surcussale->adressecomplete'");
                      $con->closeconnexion();
                      return $cont[0];

                      }



    }
?>
