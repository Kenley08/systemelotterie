<?php
  class administration{
      public $idadmin;
      public $typeadminid;
      public $nomcomplet;
      public $pin;
      public $email;
      public $telephone;
      public $villeid;
      public $adressecomplete;
      public $etat;
      public $dateaj;
      public $datemodifier;

      public function __construct(){
        $this->idadmin="";
        $this->typeadminid="";
        $this->nomcomplet="";
        $this->pin="";
        $this->email="";
        $this->telephone="";
        $this->villeid="";
        $this->adressecomplete="";
        $this->etat="";
        $this->dateaj="";
        $this->dateup="";
      }
  }
?>
