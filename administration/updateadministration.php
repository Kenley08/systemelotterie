<?php
require_once "../api/Modele/Mconnexion.class.php";
require_once "../api/Modele/Madministration.class.php";
require_once "../api/Dao/administrationDao.class.php";
require_once "../api/Dao/typeadminDao.class.php";
require_once "../api/Dao/villeDao.class.php";
 ini_set('display_errors', 'Off');

  if(isset($_POST['btnrechercher'])){
    $idadmin=$_POST['txtidadmin'];
    $ligne=administrationDao::getadminbyid($idadmin);
    //echo $ligne[2];
    $sikse="Voici les donnees:"."<br/>";
  }

  if(isset($_POST['btnmodifier'])){

    //typeadminDao::UpdateTypeAdmin($_POST['txttypeadmin'],$idtypeadmin);
     $admin=new administrationDao();
    $admin->idadmin=$_POST['txtidadmin'];
    $admin->nomcomplet=$_POST['txtnom'];
    $admin->pin=$_POST['txtpin'];
    $admin->email=$_POST['txtemail'];
    $admin->telephone=$_POST['txttelephone'];
    $admin->adressecomplete=$_POST['txtadressecomp'];
    $admin->villeid=$_POST['txtville'];

    $type=new typeadminDao();
    $type->typeadmin=$_POST['txttypeadmin'];
    $type->idtypeadmin=$_POST['txtidtypeadmin'];
      if(($type->idtypeadmin) && isset($type->typeadmin) && isset($admin->idadmin) && isset($admin->nomcomplet) && isset($admin->pin)
     && isset($admin->email) && isset($admin->telephone) && isset($admin->adressecomplete) && isset($admin->villeid)){
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
                   //nou ajoute admin la nan base la ak tout type li le tout bagay byen pase
                  administrationDao::updateadmin($admin);
                  typeadminDao::UpdateTypeAdmin($type);
                  $sikse="Modifikasyon a fet.";
              
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
       $mesaj="Modifikasyon a pa arive fet.";
     }

  }
?>
<html>
<head>
  <title>update Admin</title>
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
            <input type="text" name="txtidtypeadmin" hidden class="form-control"  value="<?php if($ligne){echo $ligne[7];}else{echo $_POST['txttypeadmin'];}?>">
            <input type="text" name="txtidadmin" class="form-control"  value="<?php if($ligne){  echo $ligne[0];}else{echo $_POST['txtidadmin'];}?>"   placeholder="Ex:003432411">
            <input type="text" name="txtnom" class="form-control" value="<?php if($ligne){  echo $ligne[1];}else{echo $_POST['txtnom'];}?>"   placeholder="Ex:Fleurine Kenley">
            <input type="text" name="txttypeadmin" class="form-control"  value="<?php if($ligne){ echo $ligne[6];}else{echo $_POST['txttypeadmin'];}?>"  placeholder="Ex:Caissier">
            <input type="text" name="txtpin" class="form-control"  value="<?php if($ligne){ echo $ligne[2];}else{echo $_POST['txtpin'];}?>"  placeholder="Ex:0089">
            <input type="email" name="txtemail" class="form-control"  value="<?php if($ligne){ echo $ligne[3];}else{echo $_POST['txtemail'];}?>" placeholder="Ex:fleurinekenley@gmail.com">
              <input type="text" name="txttelephone" class="form-control"  value="<?php if($ligne){ echo $ligne[4];}else{echo $_POST['txttelephone'];}?>"  placeholder="Ex:47663774">
                <select  name="txtville" class="form-control">
                  <?php foreach(VilleDao::GetVille() as $l):
                    if($l[0] ==$ligne[8]){
                      echo "<option selected='selected' value='$l[0]'>$l[2]</option>";
                     }
                     else{
                         echo "<option value='$l[0]'>$l[2]</option>";
                     }
                  endforeach;?>
                </select>


              <input type="text" name="txtadressecomp" class="form-control" value="<?php if($ligne){ echo $ligne[5];}else{echo $_POST['txtadressecomp'];}?>"  placeholder="tabarre 36,en face de l'univers market">
              <input type="submit" name="btnrechercher" value="Rechercher" class="btn btn-success">
              <input type="submit" name="btnmodifier" value="Modifier" class="btn btn-success">



          </form>
      </div>

  </body>

</html>
