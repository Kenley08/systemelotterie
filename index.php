<?php
    require_once "api/Modele/Mconnexion.class.php";
    require_once "api/Dao/connecterDao.class.php";
    require_once "api/Modele/Mconnecter.class.php";
//
//   $connecter=new connecterDao();
// echo $connecter->idcon=time()."".rand(1,100);
// echo  $connecter->adminid="158938582588";
//   //echo $connecter->etat=1;
// if(isset($connecter->idcon) && isset($connecter->adminid)){
//   connecterDao::connecter($connecter);
// }


  $deconnecter=new connecterDao();
echo $deconnecter->idcon=time()."".rand(1,100);
echo  $deconnecter->adminid="158938582588";
  //echo $connecter->etat=1;
if(isset($deconnecter->idcon) && isset($deconnecter->adminid)){
  connecterDao::deconnecter($deconnecter);
}

  ?>
