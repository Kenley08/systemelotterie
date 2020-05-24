<?php
  class connexion{
      private $username;
      private $password;
      private $server;
      private $db;
      private $connexion;

      public function __construct (){

        $this->connexion=new mysqli("localhost","root","","db_lotterie");
      }

     public function executerequete($sql){
       $contenu=$this->connexion->query($sql);
       return $contenu->fetch_all();
     }

     public function executeactualisation($sql){
      $contenu=$this->connexion->query($sql);
      return $contenu;
     }

      public function closeconnexion(){
        $this->connexion->close();
      }




  }

?>
