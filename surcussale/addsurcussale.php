<?php
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Dao/VilleDao.class.php";
require_once "../api/Dao/surcussaleDao.class.php";
  ini_set('display_errors', 'Off');
  if(isset($_POST['btnadd']) && isset($_POST['txtville'])  && isset($_POST['txtadressecomp'])){
    $surcussale=new surcussaleDao();
    $surcussale->idsurcussale=time()."".rand(1,100);
    $surcussale->entrepriseid=time()."".rand(1,100);
    $surcussale->villeid=$_POST['txtville'];
    $surcussale->adressecomplete=$_POST['txtadressecomp'];
    $surcussale->etat=1;
    if (isset($surcussale->idsurcussale) && isset($surcussale->entrepriseid) && isset($surcussale->villeid) && isset($surcussale->adressecomplete) && isset($surcussale->etat)){
      surcussaleDao::addSurcussale($surcussale);
      $sikse="sikisal la anrejistre";
    }
  }else{
    $mesaj="Sikisal la pa pa arive anrejistre.";
  }

?>

<html>
<head>
  <title>add surcussale</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>Add surcussale</h1>
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
            <select id="txtville" name="txtville" class="form-control">
                <?php foreach(VilleDao::GetVille() as $li):
                  echo "<option value='$li[0]'>$li[2]</option>"; endforeach;?>
            </select>
                  <input type="text" name="txtadressecomp" class="form-control" value="<?php if($mesaj){ echo $_POST['txtadressecomp'];}?>"  required placeholder="tabarre 36,en face de l'univers market">
              <input type="submit" name="btnadd" value="ajouter" class="btn btn-success">

          </form>
      </div>

  </body>

</html>
