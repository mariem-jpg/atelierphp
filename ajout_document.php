<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajout Document</title>
</head>
<body>
<h2>Ajout d'un document</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<label>Type de document</label>
<select name="type">
    <option value="livre">Livre</option>
    <option value="dictionnaire">Dictionnaire</option>
    <option value="revue">Revue</option>
</select>
<input type="submit" value="valider" name="envoi" /><br/><br/>
</fieldset>
</form>

<?php
if (isset($_POST["envoi"])) {

    if ($_POST["type"] == "livre") {
?>
<form method="post">
<fieldset>
<legend><h3>Ajout d'un livre</h3></legend>
<table>
<tr><td>Code</td><td><input type="text" name="code" required></td></tr>
<tr><td>Titre</td><td><input type="text" name="titre" required></td></tr>
<tr><td>Auteur</td><td><input type="text" name="auteur" required></td></tr>
<tr><td>Nombre de pages</td><td><input type="text" name="nbpages" required></td></tr>
<tr><td colspan="2"><input type="submit" name="addbook" value="Ajouter livre"></td></tr>
</table>
</fieldset>
</form>
<?php
    }

    if ($_POST["type"] == "dictionnaire") {
?>
<form method="post">
<fieldset>
<legend><h3>Ajout d'un dictionnaire</h3></legend>
<table>
<tr><td>Code</td><td><input type="text" name="code" required></td></tr>
<tr><td>Titre</td><td><input type="text" name="titre" required></td></tr>
<tr><td>Langue</td><td><input type="text" name="langue" required></td></tr>
<tr><td colspan="2"><input type="submit" name="adddict" value="Ajouter dictionnaire"></td></tr>
</table>
</fieldset>
</form>
<?php
    }

    if ($_POST["type"] == "revue") {
?>
<form method="post">
<fieldset>
<legend><h3>Ajout d'une revue</h3></legend>
<table>
<tr><td>Code</td><td><input type="text" name="code" required></td></tr>
<tr><td>Titre</td><td><input type="text" name="titre" required></td></tr>
<tr><td>Mois d'édition</td><td><input type="text" name="mois" required></td></tr>
<tr><td>Année d'édition</td><td><input type="text" name="annee" required></td></tr>
<tr><td colspan="2"><input type="submit" name="addrevue" value="Ajouter revue"></td></tr>
</table>
</fieldset>
</form>
<?php
    }
}

/* ----------------------------------------------------------
   INSERTION LIVRE
---------------------------------------------------------- */
if (isset($_POST['addbook'])) {

    include("connexion.php");
    $id = connect("bibliotheque");

    $code   = $id->quote($_POST['code']);
    $titre  = $id->quote($_POST['titre']);
    $auteur = $id->quote($_POST['auteur']);
    $nbp    = $id->quote($_POST['nbpages']);

    // CORRECTION : préciser les colonnes !
    $sql1 = "INSERT INTO document (code, titre, etat) VALUES ($code, $titre, 'disponible')";
    $sql2 = "INSERT INTO livre (code, auteur, nbrpages) VALUES ($code, $auteur, $nbp)";

    try {
        $id->exec($sql1);
        $id->exec($sql2);
        echo "<script>alert('Le livre est ajouté');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erreur : ".$e->getMessage()."');</script>";
    }

    $id = null;
}

/* ----------------------------------------------------------
   INSERTION DICTIONNAIRE
---------------------------------------------------------- */
if (isset($_POST['adddict'])) {

    include("connexion.php");
    $id = connect("bibliotheque");

    $code   = $id->quote($_POST['code']);
    $titre  = $id->quote($_POST['titre']);
    $langue = $id->quote($_POST['langue']);

    $sql1 = "INSERT INTO document (code, titre, etat) VALUES ($code, $titre, 'disponible')";
    $sql2 = "INSERT INTO dictionnaire (code, langue) VALUES ($code, $langue)";

    try {
        $id->exec($sql1);
        $id->exec($sql2);
        echo "<script>alert('Le dictionnaire est ajouté');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erreur : ".$e->getMessage()."');</script>";
    }

    $id = null;
}

if (isset($_POST['addrevue'])) {

    include("connexion.php");
    $id = connect("bibliotheque");

    $code  = $id->quote($_POST['code']);
    $titre = $id->quote($_POST['titre']);
    $mois  = $id->quote($_POST['mois']);
    $annee = $id->quote($_POST['annee']);

    $sql1 = "INSERT INTO document (code, titre, etat) VALUES ($code, $titre, 'disponible')";
    $sql2 = "INSERT INTO revue (code, mois, annee) VALUES ($code, $mois, $annee)";

    try {
        $id->exec($sql1);
        $id->exec($sql2);
        echo "<script>alert('La revue est ajoutée');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Erreur : ".$e->getMessage()."');</script>";
    }

    $id = null;
}
?>
</body>
</html>
