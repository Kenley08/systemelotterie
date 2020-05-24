<?php
    require_once "../api/Modele/Mconnexion.class.php";
    require_once "../api/Dao/ficheDao.class.php";
//     if(isset($_POST['btnrechecher'])){
//      $idsur='43812097612';
//      $ident='198122317601';
//       $debut = date("y-m-d",strtotime($_POST['txtdebut']));
//       $fin= date("y-m-d",strtotime($_POST['txtfin']));
//       foreach (ficheDao::GetficheByDate($debut,$fin,$idsur,$ident) as $row):
//       echo $row[0]."</br>";
//         //echo $row[0];
//       endforeach;
// }
?>

<html>
<head>
  <title>Get fiche by Date</title>
  <meta charset="utf-8"/>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  
  <head>
  <body>

      <div class="container">
            <form action="?" method="post">
              <table>
                <tbody>
                  <tr>
                    <td><label for="txtdebut">Debut</label></td>
                    <td>
                        <input id="datepicker" name="txtdebut" width="276" />
                    <td/>
                    <td>
                      <script>
                      $('#datepicker').datepicker({
                          uiLibrary: 'bootstrap4'
                      });
                      </script>
                    </td>
                  </tr>

                  <tr>
                    <td><label for="txtfin">Fin</label></td>
                    <td>
                        <input id="datepicke"  name="txtfin" width="276" />
                    <td/>
                    <td>
                      <script>
                      $('#datepicke').datepicker({
                          uiLibrary: 'bootstrap4'
                      });
                      </script>
                    </td>
                    <td>
                         <input type="submit" name="btnrechecher" value="Rechercher" class="btn btn-success">
                    </td>
                  </tr>
                </tbody>

              </table>
            </form>

            <table id="user_adr" class="table table-striped table-bordered">
                <tr>
                  <th>ID FICHE</th>
                    <th>PRIX TOTAL</th>
                      <th>ETAT</th>
                        <th>PAYE</th>
                          <th>DATE AJOUT</th>
                            <th>CAISSIER</th>
                </tr>
                <tbody>
                  <?php
                  if(isset($_POST['btnrechecher'])){
                   $idsur='348902310239';
                   $ident='198122317601';
                    $debut = date("y-m-d",strtotime($_POST['txtdebut']));
                    $fin= date("y-m-d",strtotime($_POST['txtfin']));
                    foreach (ficheDao::GetficheByDate($debut,$fin,$idsur,$ident) as $row):
                    //echo $row[0]."</br>";
                  ?>
                  <tr>
                      <td><?php echo $row[0];?></td>
                      <td><?php echo $row[1];?></td>
                      <td><?php if($row[2]==1){
                         echo  "Actif";
                      }else{
                         echo  "ACtif";
                      }?></td>
                      <td><?php if($row[3]==0){
                         echo  "Non";
                      }else{
                         echo  "oui";
                      }?></td>
                      <td><?php echo $row[4];?></td>
                      <td><?php echo $row[5];?></td>
                  </tr>
                  <?php
                endforeach;
          }
                  ?>
                </tbody>
            </table>
      </div>

  </body>

</html>
