<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Supprimez adhérent</title>
</head>
<body>
<?php
include('connexion.php');
$idcom=connect('bibliotheque');
//isset — Détermine si une variable est déclarée et est différente de null
if (!empty($_POST['code']) && !empty($_POST['code'])) {
$code=(integer)$_POST['code'];
// Requête SQL
$requete="DELETE FROM adherant WHERE idAdherant='$code' ";
$nblignes=$idcom->exec($requete);
if($nblignes==1)
echo "succès";
else
echo "erreur";
}
else
echo "vérifier votre formulaire";
?>
</body>
</html>