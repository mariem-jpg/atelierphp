<?php
include('connexion.php');
$idcom = connect('bibliotheque');
if (!isset($_GET['edit']) && !isset($_POST['modif'])) {
    die("Erreur : aucun livre sélectionné !");
}

if(!isset($_POST['modif'])) {
    $code = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
    if ($code == 0) {
        die("Erreur : code invalide !");
    }

    $requete="SELECT * FROM document d, livre l WHERE d.code=l.code AND d.code='$code'";
    $result = $idcom->query($requete);
    if (!$result) {
        die("Erreur SQL !");
    }

    $coord = $result->fetch(PDO::FETCH_NUM);
    if (!$coord) {
        die("Aucun livre trouvé pour le code : $code");
    }
?>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" >
<fieldset>
<legend><b>Modifiez les informations du livre</b></legend>
<table>
<tr>
<td>Code :</td>
<td><input type="text" name="code" value="<?= $coord[3] ?>" /></td>
</tr>
<tr>
<td>Titre :</td>
<td><input type="text" name="titre" value="<?= $coord[1] ?>" /></td>
</tr>
<tr>
<td>Etat :</td>
<td><input type="text" name="etat" value="<?= $coord[2] ?>" /></td>
</tr>
<tr>
<td>Auteur :</td>
<td><input type="text" name="auteur" value="<?= $coord[4] ?>" /></td>
</tr>
<tr>
<td>Nombre de pages :</td>
<td><input type="text" name="nbpages" value="<?= $coord[5] ?>" /></td>
</tr>
<tr>
<td><input type="reset" value="Effacer"></td>
<td><input type="submit" name="modif" value="Enregistrer"></td>
</tr>
</table>
</fieldset>
<input type="hidden" name="code" value="<?= $code ?>" />
</form>
<?php
$result->closeCursor();

} elseif (!empty($_POST['code']) && !empty($_POST['titre']) && !empty($_POST['etat']) &&
!empty($_POST['auteur']) && !empty($_POST['nbpages'])) {
    $codeli=$idcom->quote($_POST['code']);
    $titre=$idcom->quote($_POST['titre']);
    $etat=$idcom->quote($_POST['etat']);
    $auteur=$idcom->quote($_POST['auteur']);
    $nbpages=$idcom->quote($_POST['nbpages']);
    $code=(integer)$_POST['code'];

    $req1="UPDATE document SET code=$codeli,titre=$titre,etat=$etat WHERE code=$code";
    $req2="UPDATE livre SET code=$codeli,auteur=$auteur,nbrpages=$nbpages WHERE code=$code";

    $res1=$idcom->exec($req1);
    $res2=$idcom->exec($req2);

    if($res1===false || $res2===false) {
        echo "<script>alert('Erreur : ".$idcom->errorCode()."')</script>";
    } else {
        echo "<script>window.location='affiche_document.php';</script>";
        exit;
    }

} else {
    echo "Modifiez les informations du livre !";
}
?>
