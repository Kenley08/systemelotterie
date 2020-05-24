<?php
class ficheDao{
  //fonction pour creer fiche
  public static function creerfiche($fiche){
  $con=new connexion();
  $resultat=$con->executeactualisation("insert into tblfiche (id_fiche,prix_total,admin_id,etat,paye,date_ajout,date_modifier)
  values('" . $fiche->idfiche . "','" . $fiche->prixtotal . "','" . $fiche->adminid. "','" . $fiche->etat . "','" . $surcussale->paye . "',NOW(),NOW())");
  $con->closeconnexion();

  }

  public static function GetficheByDate($debut,$fin,$idsur,$ident){
            $con=new connexion();
            $cont=$con->executerequete("SELECT f.id_fiche,f.prix_total,f.etat,f.paye,f.date_ajouT,a.nom_complet FROM tblfiche f INNER JOIN tbladministration a
              INNER JOIN tblpost p INNER JOIN tblsurcussale s INNER JOIN tblentreprise e
              on f.admin_id=a.id_admin and s.id_surcussale=p.surcussale_id and e.id_entreprise=s.entreprise_id and p.admin_id=a.id_admin
              WHERE f.date_ajout BETWEEN CAST('$debut' AS DATE) AND CAST('$fin' AS DATE) and p.surcussale_id='$idsur' and e.id_entreprise='$ident'");
            $con->closeconnexion();
            return $cont;
  }


}
?>
