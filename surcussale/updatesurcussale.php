<?php
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Dao/VilleDao.class.php";
require_once "../api/Dao/surcussaleDao.class.php";
require_once "../api/Modele/Msurcussale.class.php";
//  ini_set('display_errors', 'Off');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $ligne=surcussaleDao::getsurcussalebyid($id);
}
if(isset($_POST['btnmodifier']) && isset($_POST['txtville'])  && isset($_POST['txtadressecomp'])){
    $surcussale=new surcussaleDao();
    $surcussale->idsurcussale=$id;
    $surcussale->villeid=$_POST['txtville'];
    $surcussale->adressecomplete=$_POST['txtadressecomp'];
    surcussaleDao::updateSurcussale($surcussale);
    $sikse="sikisal la modifye avek sikse.";
  }

?>
<html>
<head>
  <title>update surcussale</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>Update surcussale</h1>
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
            <select  name="txtville" class="form-control">
              <?php foreach(VilleDao::GetVille() as $l):
                if($l[0] ==$ligne[2]){
                  echo "<option selected='selected' value='$l[0]'>$l[2]</option>";
                 }
                 else{
                     echo "<option value='$l[0]'>$l[2]</option>";
                 }
              endforeach;?>
            </select>
                  <input type="text" name="txtadressecomp" class="form-control" value="<?php if($ligne){ echo $ligne[3];}?>"  required placeholder="tabarre 36,en face de l'univers market">
              <input type="submit" name="btnmodifier" value="Modifier" class="btn btn-success">

          </form>
      </div>

  </body>

</html>
