<?php
session_start();
require_once "../api/Modele/MBoule.class.php";
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Dao/bouleDao.class.php";
require_once "../api/Dao/typebouleDao.class.php";
require_once "../api/Dao/ficheDao.class.php";
require_once "../api/Modele/Mfiche.class.php";
  ini_set('display_errors', 'Off');
  $_SESSION['admin_id']='23812237695';
  //$_SESSION['fiche_id']=null;
  if(isset($_POST['btnajouterboule']) && isset($_POST['txttypeboule'])  && isset($_POST['txtprix'])){
    $boule=new bouleDao();
    $ficheid="";
    //n ap teste si id ki jerere a diferan ak sak ki te nan session a deja nan premier random la ki te fet nan variable fichierid a
    if($ficheid!=$_SESSION['fiche_id']){
     $fid="";
     //si li diferan seke te deja gen valeur nan session a deja,mwen kenbe session sa nan yon champ ke mwen mete hidden
    $_POST['txtficheid']=$_SESSION['fiche_id'];
    //mwen atribiye l ak atribi instans ke m te declare anle a
    $boule->ficheid=$_POST['txtficheid'];
    //la mwen netwaye variable ficheid a paske li pa nesese pou genb yon random ladan l anko sak,fe sa se paske pou le session['fiche_id'] diferan avel
     //poul pa kenbe random ke mwen jenere a nan komansman kote m te di si fichierid !=0 fe yon random metel ladan
    $ficheid="";
  }else{

    //la se le kontre,anvan tou n ap netwaye session kite kenbe random la nan ka presedan,pou nou ka jenere yon nouvel id ke n ap mete nan yon lot varyab
    $_SESSION['fiche_id']=null;
    //n ap netwaye varyab $ficheid ki te gen premye insesyon a paske li pa nesese an ka sa
    $ficheid="";
    //n ap mete random ke nou n ap jenere a nan yon varyab kote ke le caissier a fin insere tout liy boule ki lye ak premye ficheid a
    $fid=time()."".rand(1,100);
    //nou remete nouvo ficheid sa nan menm $_SESSION['fiche_id'] pakse se li menm nou mete kom value nan chan ki hidden la
    $_SESSION['fiche_id']=$fid;
    //n ap pase session sa nan chan hidden la
    $_POST['txtficheid']=$_SESSION['fiche_id'];
    //epi la n ap pase arraytribi instans la chan hidden la
    $boule->ficheid=$_POST['txtficheid'];
  }

  //pati kod sa se kote ke ficheid a te gen yon premye random li epi li rejenere yon lot,men li pral antre nan baz de done selon test ki fet anle a
  if($ficheid!=""){
    $ficheid=time()."".rand(1,100);
    $_SESSION['fiche_id']=$ficheid;
  }
//le tout test finn fet pou fichierid a nou pase $boule atribi li yo
    $boule->idboule=time()."".rand(1,100);
    $boule->typebouleid=$_POST['txttypeboule'];
    $boule->boule=$_POST['txtboule'];
    $boule->prix=$_POST['txtprix'];

    if (isset($boule->idboule) && isset($boule->typebouleid) && isset($boule->prix) && isset($boule->ficheid)){
      bouleDao::addBoule($boule);
      $sikse="boul la anrejistre";
    }
  }else{
    $mesaj="boul la pa pa arive anrejistre.";
  }

   if(isset($_POST['btnsotirfiche'])){
     ///n ap kreye yon lot instans k ap rele fiche
       $fiche=new ficheDao();
       //n ap fe yon recherche ki pou vini ak prixtotal tout boule ki jwe yo pou fich sila
       $row=bouleDao::prixtotal($_POST['txtficheid']);
      //n ap mete atribi yo nan instans nou te kreye anle a
       $fiche->idfiche=time()."".rand(1,100);
       $fiche->prixtotal=$row[0];
       $fiche->adminid=$_SESSION['admin_id'];
       $fiche->etat=1;
       $fiche->paye=0;
       if(isset($fiche->idfiche) && isset($fiche->prixtotal) && isset($fiche->adminid) && isset($fiche->etat) && isset($fiche->paye) && $row){
          ficheDao::creerfiche($fiche);
          //n ap pran infomasyon sou boule ki jwe yo
          echo "Id fiche:".$_POST['txtficheid']."<br/>";
          echo "Boules:"." "." Prix:" ."<br/>";
          foreach(bouleDao::GetInfoBoule($_POST['txtficheid']) as $row1):
             echo $row1[0]." ".$row1[1]."<br/>";
          endforeach;
          echo "Prix Total:".$row[0];
          //nou mete session an null pou li ka resevwa yon lot vale le gen yon lot fiche ki pral kreye
          $_SESSION['fiche_id']=NULL;
       }





  }

?>

<html>
<head>
  <title>creer fiche</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>creer fiche</h1>
          <?php
          if(isset($sikse)){
            echo $sikse;
          }else if(isset($mesaj)){
              echo $mesaj;
          }else{
            $mesaj="";
            $sikse="";
          }


          ?>

          <form action="" method="post" class="form-inline">
              <input type="text" name="txtficheid" value="<?php echo $_SESSION['fiche_id'];?>"class="form-control">
            <select  name="txttypeboule" class="form-control">
                <?php foreach(typebouleDao::getTypeBoule() as $li):
                  echo "<option value='$li[0]'>$li[1]</option>"; endforeach;?>
            </select>
              <input type="text" name="txtboule" class="form-control" value="<?php if($mesaj){ echo $_POST['txtboule'];}?>"   placeholder="Boule">
            <input type="text" name="txtprix" class="form-control" value="<?php if($mesaj){ echo $_POST['txtprix'];}?>"   placeholder="Ex:10 gdes">

           <input type="submit" name="btnajouterboule" value="ajouter" class="btn btn-success">
            <input type="submit" name="btnsotirfiche" value="Sortir Fiche" class="btn btn-success">

          </form>

      </div>

  </body>

</html>
