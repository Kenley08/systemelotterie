<?php
class fiche{
    public $idfiche;
    public $prixtotal;
    public $adminid;
    public $etat;
    public $paye;
    public $dateaj;
    public $dateup;

    public function __construct(){
      $this->idfiche="";
      $this->prixtotal="";
      $this->adminid="";
      $this->etat="";
      $this->paye="";
      $this->dateaj="";
      $this->dateup="";
    }
  }
?>
