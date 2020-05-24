<?php
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Modele/Mtypeadministration.class.php";
require_once "../api/Dao/TypeadminDao.class.php";
  if(isset($_POST['btnrechercher'])){
    $idtypeadmin=$_POST['txtidtypeadmin'];
    $ligne=typeadminDao::GetTypeAdmin($idtypeadmin);
    echo $sikse="Voici les donnees:"."<br/>";

    if($sikse){
      typeadminDao::UpdateTypeAdmin($_POST['txttypeadmin'],$idtypeadmin);
      //$mesaj="modifikasyon a fet.";
    }
  }
?>
<html>
<head>
  <title>Gestion des clients</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>Rechercher</h1>
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
                <input type="text" name="txtidtypeadmin" class="form-control" required value="<?php echo $ligne[0]?>" placeholder="Ex:00982345">
                <input type="text" name="txttypeadmin" class="form-control" value="<?php echo $ligne[1]?>" required placeholder="Ex:caisser">
                <input type="submit" name="btnrechercher" value="<?php
                if($sikse)
                  {
                  echo "Modifier";
                  }
                  else{
                  echo "Rechercher";
                  }
                ?>" class="btn btn-success">

          </form>
      </div>

  </body>

</html>
