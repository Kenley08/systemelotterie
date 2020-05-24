<?php
  require_once "../api/Modele/Mconnexion.class.php";
  require_once "../api/Modele/Mtypeadministration.class.php";
  require_once "../api/Dao/TypeadminDao.class.php";
  try {
    if(isset($_POST['btnadd'])){
      if(isset($_POST['txttypeadmin'])){
      //    echo $typeadmin->gettype();
          //n ap kreye yon instans de klass typeadminDao array
         $typeadmindao=new typeadminDao();
         $typeadmindao->typeadmin=$_POST['txttypeadmin'];
        // $typeadmindao->etat=0;
         $typeadmindao->idtypeadmin=time()."".rand(1,100);
          //nou pase fonction ki nan klas typeadminDao a objet typeadmin mwen te kreye a
        //  $typedao->createtypeadmin($typeadmin);
          if(($typeadmindao->idtypeadmin) && isset($typeadmindao->typeadmin) && isset($typeadmindao->etat)){
            typeadminDao::createtypeadmin($typeadmindao);
            $sikse="type admin insere avek sikse.";
          }else{
             $mesaj="insesyon an a fet";
          }

      }

    }
  } catch (PDOException $e) {
      die('Erreur:'.$e->getMessage());
  }

if(!isset($sikse)){
  $mesaj="insesyon an pa fet";
}


?>


<html>
<head>
  <title>add typeadmin</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <head>
  <body>

      <div class="container">
          <h1>typeadmin</h1>
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
                <input type="text" name="txttypeadmin" class="form-control" required placeholder="Ex:Caissier">
                <input type="submit" name="btnadd" value="ajouter" class="btn btn-success">

          </form>
      </div>

  </body>

</html>
