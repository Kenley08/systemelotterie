<?php
        require_once "../api/Modele/Mconnexion.class.php";
        require_once "../api/Dao/postDao.class.php";
        require_once "../api/Dao/administrationDao.class.php";
        if(isset($_GET['id_admin']) && isset($_GET['etat']) && isset($_GET['id_post'])){
          $id=$_GET['id_admin'];
          $idpost=$_GET['id_post'];
          $etat=$_GET['etat'];
          if($etat==1){
            administrationDao::bloke($id);
            postDao::inactif($idpost);
          }else if($etat==0){
            administrationDao::debloke($id);
            postDao::actif($idpost);
          }
        }
?>
<html>
<head>
  <title>add administration</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>Tous les admins</h1>
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
            <input type="text" name="txtnom" class="form-control"  value="<?php if($mesaj){ echo $_POST['txtnom'];}?>"  placeholder="Ex:Fleurine Kenley">
            <input type="submit" name="btnrechercher" value="Rechercher" class="btn btn-success">

          </form>
                <table id="user_adr" class="table table-striped table-bordered">
                    <tr>
                      <th>ID_POST</th>
                      <th>NOM COMPLETE</th>
                          <th>VILLE</th>
                            <th>ADRESSE COMPLETE</th>
                    </tr>

                    <?php
                   if(!isset($_POST['txtnom'])){
                      //$nomcom="Fleurine Kenley";
                      $ident="198122317601";
                      foreach(postDao::GetAllAdmin($ident) as $row):
                        ?>
                        <tr>
                          <td><?= $row[0] ?></td>
                          <td><?= $row[1] ?></td>
                          <td><?= $row[2] ?></td>
                          <td><?= ucwords($row[3])?></td>

                          <td>
                            <a href="?etat=<?=$row[4]?>&&id_admin=<?=$row[5]?>&&id_post=<?=$row[0]?>"><input type="submit" value="<?php
                            if($row[4]==1){
                                echo"bloquer";
                              }else if($row[4]==0){
                                  echo"Debloquer";
                                }
                            ?>" name="btnblock" class="btn btn-secondary  btn-sm" data-toggle="modal"/></a>
                          </td>
                      </tr>

                        <?php
                      endforeach;
                    ?>


                      <?php
                    }
                  else{
                    $nomcom=$_POST['txtnom'];
                    $liy=postDao::GetAdmin($nomcom);
                    if(isset($_POST['btnrechercher'])){

                      ?>
                      <tr>
                        <td><?= $liy[0] ?></td>
                        <td><?= $liy[1] ?></td>
                        <td><?= $liy[2] ?></td>
                        <td><?=ucwords($liy[3])?></td>
                        <td>
                          <a href="?etat=<?=$liy[4]?>&&id_admin=<?=$liy[5]?>&&id_post=<?=$liy[0]?>"><input type="submit" value="<?php
                          if($liy[4]==1){
                              echo"bloquer";
                            }else if($liy[4]==0){
                                echo"Debloquer";
                              }
                          ?>" name="btnblock" class="btn btn-secondary  btn-sm" data-toggle="modal"/></a>
                        </td>

                      </tr>
                      <?php
                      }
                    }
                    ?>

                </table>


      </div>



  </body>

</html>
