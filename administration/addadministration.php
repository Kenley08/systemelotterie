<?php
    session_start();
    require_once "../api/Modele/Mconnexion.class.php";
    require_once "../api/Dao/VilleDao.class.php";
    require_once "../api/Dao/administrationDao.class.php";
    require_once "../api/Modele/Madministration.class.php";
    require_once "../api/Modele/Mtypeadministration.class.php";
    require_once "../api/Dao/TypeadminDao.class.php";
    require_once "../api/Dao/surcussaleDao.class.php";
    require_once "../api/Dao/postDao.class.php";
   ini_set('display_errors', 'Off');


    if(isset($_POST['btnadd']) && isset($_POST['txtnom']) && isset($_POST['txtpin']) && isset($_POST['txtemail']) && isset($_POST['txttelephone'])
     && isset($_POST['txtville']) && isset($_POST['txtadressecomp']) && isset($_POST['txttypeadmin'])){

       //n ap kreye yon instans de obje administrationDao a
        $admin=new administration();

        //nou afekte l ak atribi l yo
        $idadmin=time()."".rand(1,100);
        $admin->idadmin=$idadmin;
        $admin->typeadminid=$_POST['txttypeadmin'];
        $admin->nomcomplet=ucwords($_POST['txtnom']);
        $admin->pin=$_POST['txtpin'];
        $admin->email=$_POST['txtemail'];
        $admin->telephone=$_POST['txttelephone'];
        $admin->villeid=$_POST['txtville'];
        $admin->adressecomplete=$_POST['txtadressecomp'];
        $admin->etat=1;

        $_SESSION['nom_complet']=$admin->nomcomplet;
        $_SESSION['pin']=$admin->pin;
        $_SESSION['email']=$admin->email;
        $_SESSION['telephone']=$admin->telephone;
        $_SESSION['adresse_complete']=$admin->adressecomplete;
        $_SESSION['ville']=$_POST['txtville'];
        if(isset($admin->idadmin) && isset($admin->typeadminid) && isset($admin->nomcomplet) && isset($admin->pin)
        && isset($admin->email) && isset($admin->telephone) && isset($admin->villeid) && isset($admin->adressecomplete)
        && isset($admin->etat)){
             $nc=$_POST['txtnom'];
             $tel=$_POST['txttelephone'];
             $email=$_POST['txtemail'];

                //nou teste si itilizate a mete chif nan non konple a
                if(preg_match ("/^[a-zA-Z\s]+$/",$nc)) {
                  //nou teste  si itilizate a mete byen mete yon foma tel
                  if(preg_match('/^[0-9]*$/',$tel)){
                    //Coversion des chiffres de telephone en string
                    $t=strval($tel);
                    //on teste maintenant la longeur du chaine
                    if(strlen($t)>=8){
                      //nou pral gade si admin k ap anrejistre a te deja nan base de donne deja
                     $row=administrationDao::getadminbyemailorphone($admin);
                      if($row[0]!=$email){
                         if($row[1]!=$tel){
                           //avan nou kreye admin la nou pral gade pou nou we adrsse surcussale moun la atre a egal
                           // avek vil kote ke sikisal la ye an a nan base de donnees a
                        //   $surcussale=new surcussaleDao();
                        //  $surcussale->villeid=$_POST['txtvilleSurcussale'];
                        //   $surcussale->adressecomplete=$_POST['txtadressesurcussale'];
                        // //   $liy=surcussaleDao::getByVilleAndAdresse($surcussale);


                          if($_POST['txttypeadmin']!=3){
                            administrationDao::createadmin($admin);
                            $sikse="insesyon an fet.";
                          }else{



                              if(isset($_GET['id_surcussale'])){
                                      $idsur=$_GET['id_surcussale'];
                                      $post=new postDao();
                                      $idpost=time()."".rand(1,100);
                                      $post->idpost=$idpost;
                                       $post->adminid=$admin->idadmin;
                                      $post->surcussaleid=$idsur;
                                      $post->etat=1;

                                    //  $admin->nomcomplet=$_SESSION['nom_complet'];
                                      //nou ajoute admin la nan base la ak tout type li le tout bagay byen pase
                                      //TypeadminDao::createtypeadmin($typeadmindao);
                                        administrationDao::createadmin($admin);
                                        //n ap insere nan tab post la kounya
                                        postDao::addPost($post);
                                      $sikse="insesyon an fet.";
                              }
                            //administrationDao::createadmin($admin);
                          //  $sikse="insesyon an fet.";
                          }




                         }else{
                           $mesaj="Gen yon anploye ki anregistre ak telefon sa deja,tanpri mete yon lot.";
                         }

                      }else{
                         $mesaj="Gen yon administrate ki anregistre ak email sa deja,tanpri mete yon lot.";

                         //echo $_SESSION['ville']=2;

                      }

                }else{
                  $mesaj="Nimewo telefon dwe genyen piti 8 chif.";
                }

                 }else{
                   $mesaj="Nimewo telephone la dwe gen chif selman";
                 }

                }else{
                  $mesaj="Non konple a sipoze ge let selman";
                }


        }else{
          $mesaj="li pa fet";
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
          <h1>add admin</h1>
          <?php
          if(isset($sikse)){
            echo $sikse;
          }else if(isset($mesaj)){
              echo $mesaj;
          }else{
            $mesaj="";
            $sikse="";
          }

            $ident="198122317601";

          ?>

          <form action="" method="post" class="form-inline">
                <input type="text" name="txtnom" class="form-control" value="<?php if(($mesaj)||($_POST['txttypeadmin']==3) || isset($_GET['id_surcussale'])){ echo $_SESSION['nom_complet'];}?>" required  placeholder="Ex:Fleurine Kenley">
                  <select  name="txttypeadmin" class="form-control">
                      <?php foreach(typeadminDao::GetTypeAdmin() as $li):

                        if($li[0]==3){
                            echo "<option selected='selected' value='$li[0]'>$li[1]</option>";
                          }else if(!isset($_POST['txttypeadmin'])){
                          echo "<option value='$li[0]'>$li[1]</option>";
                        }
                        else{
                          if(($li[0]==2) && ($mesaj)){

                                echo "<option selected='selected' value='$li[0]'>$li[1]</option>";

                          }else{
                                 echo "<option value='$li[0]'>$li[1]</option>";
                          }


                       }

                        endforeach;?>
                  </select>
                <input type="text" name="txtpin" class="form-control"  value="<?php if(($mesaj) || ($_POST['txttypeadmin']==3) || isset($_GET['id_surcussale'])){ echo $_SESSION['pin'];}?>" required placeholder="Ex:0089">
                <input type="email" name="txtemail" class="form-control"  value="<?php if(($mesaj)||($_POST['txttypeadmin']==3)  || isset($_GET['id_surcussale'])){ echo $_SESSION['email'];}?>" required placeholder="Ex:fleurinekenley@gmail.com">
                  <input type="text" name="txttelephone" class="form-control"  value="<?php if(($mesaj)||($_POST['txttypeadmin']==3)  || isset($_GET['id_surcussale'])){ echo $_SESSION['telephone'];}?>" required placeholder="Ex:47663774">
                  <select id="txtville" name="txtville" class="form-control">
                      <?php foreach(VilleDao::GetVille() as $li):
                        if(($_POST['txttypeadmin']==3) || isset($_GET['id_surcussale']) ||($mesaj)){
                          if(($li[0]==$_SESSION['ville'])){
                          echo "<option selected='selected' value='$li[0]'>$li[2]</option>";
                        }else{
                            echo "<option value='$li[0]'>$li[2]</option>";
                        }


                        }else{
                            echo "<option value='$li[0]'>$li[2]</option>";
                        }
                         endforeach;?>

                  </select>
                  <input type="text" name="txtadressecomp" class="form-control" value="<?php if(($mesaj)||($_POST['txttypeadmin']==3) || isset($_GET['id_surcussale'])){ echo $_SESSION['adresse_complete'];}?>"  required placeholder="tabarre 36,en face de l'univers market">

               <input type="submit" name="btnadd" value="ajouter" class="btn btn-success">

          </form>

          <?php
              if(isset($_POST['btnadd'])){
                if($_POST['txttypeadmin']==3){
          ?>

          <table id="user_adr" class="table table-striped table-bordered">
              <tr>
                <th>ID SURCUSSALE</th>
                    <th>Ville</th>
                      <th>ADRESSE COMPLETE</th>
                          <th>OPTION</th>
              </tr>

              <?php
                if (isset($_SESSION['entreprise_id'])){
                  $_SESSION['entreprise_id']="158902317669";
                  $ident=$_SESSION['entreprise_id'];
                }
              foreach(surcussaleDao::getAllSurcussale($ident) as $row):?>
                <tr>
                    <td><?=$row[0]?></td>
                    <td><?= ucwords($row[1])?></td>
                    <td><?= ucwords($row[3])?></td>

                      <td>
                      <a href="./addadministration.php?id_surcussale=<?=$row[0]?>&&etat=<?=$row[4]?>"><input type="submit" value="Choisir" name="btnchoisir" class="btn btn-secondary btn-sm" data-toggle="modal"/></a>
                      </td>


                </tr>


              <?php endforeach;?>
          </table>

          <?php
                  }
              }
          ?>
      </div>

  </body>

</html>
