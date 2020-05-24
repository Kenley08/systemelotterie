<?php
session_start();
    require_once "../api/Modele/Mconnexion.class.php";
    require_once "../api/Dao/surcussaleDao.class.php";
    require_once "../api/Dao/postDao.class.php";

    if(isset($_GET['id_surcussale']) && isset($_GET['etat'])){
      $id=$_GET['id_surcussale'];
      $etat=$_GET['etat'];
      if($etat==1){

        surcussaleDao::inactif($id);
        postDao::inactifAllPost($id);
      }else if($etat==0){
        surcussaleDao::actif($id);
        postDao::actifAllPost($id);
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
        <table id="user_adr" class="table table-striped table-bordered">
            <tr>
              <th>ID SURCUSSALE</th>
                  <th>Ville</th>
                    <th>ADRESSE COMPLETE</th>
            </tr>

            <?php
            $ident="198122317601";



            foreach(surcussaleDao::getAllSurcussale2($ident) as $row):?>
              <tr>
                  <td><?=$row[0]?></td>
                  <td><?= ucwords($row[1])?></td>
                  <td><?= ucwords($row[3])?></td>
                    <td>
                      <a href="?id_surcussale=<?=$row[0]?>&&etat=<?=$row[4]?>"><input type="submit" value="<?php
                      if($row[4]==1){
                          echo"inactif";
                        }else if($row[4]==0){
                            echo"actif";
                          }
                      ?>" name="btnupdateetat" class="btn btn-secondary btn-sm" data-toggle="modal"/></a>
                    </td>
              </tr>
            <?php endforeach;?>
        </table>
      </div>
        <!-- <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> -->

  </body>

</html>
