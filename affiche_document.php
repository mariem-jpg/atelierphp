<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
input[type=submit] {
    width: 10em; height: 2em;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}
.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
</style>
<title>Affiche Document</title>
</head>
<body>
<h2>Liste des documents</h2>

<form action="" method="post">
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

    $type = $_POST['type'];

    // ----- LIVRES -----
    if ($type == "livre") {
        include("connexion.php");
        $idcom = connect("bibliotheque");

        $requete = "SELECT d.code, d.titre, d.etat, l.auteur, l.nbrpages
                    FROM document d, livre l 
                    WHERE d.code = l.code";

        $result = $idcom->query($requete);

        if (!$result) {
            $mes_erreur = $idcom->errorInfo();
            echo "Lecture impossible, code : ", $idcom->errorCode(), " - ", $mes_erreur[2];
        } else {

            $nbart = $result->rowCount();
            echo "<h3>Il y a $nbart livres</h3>";

            // lire la première ligne
            $ligne = $result->fetchObject();

            // si la table est vide
            if ($ligne === false) {
                echo "<h3>Aucun livre trouvé.</h3>";
            } else {

                // affichage entêtes du tableau
                echo "<table border=\"1\"><tr>";
                foreach ($ligne as $nomcol => $val) {
                    echo "<th>", $nomcol, "</th>";
                }
                echo "<th colspan=\"2\">Action</th></tr>";

                // affichage des valeurs
                do {
                    echo "<tr>";
                    echo "<td>", $ligne->code, "</td>";
                    echo "<td>", $ligne->titre, "</td>";
                    echo "<td>", $ligne->etat, "</td>";
                    echo "<td>", $ligne->auteur, "</td>";
                    echo "<td>", $ligne->nbrpages, "</td>";
                    ?>

                    <td>
                        <a href="maj_livre.php?edit=<?php echo $ligne->code; ?>" class="edit_btn">
                            Modifier
                        </a>
                    </td>
                    <td>
                        <a href="supp_livre.php?del=<?php echo $ligne->code; ?>" class="del_btn">
                            Supprimer
                        </a>
                    </td>

                    </tr>
                    <?php
                } while ($ligne = $result->fetchObject());

                echo "</table>";
            }

            $result->closeCursor();
            $idcom = null;
        }
    }

    // ----- DICTIONNAIRES -----
    else if ($type == "dictionnaire") {
        echo "<h3>Section dictionnaire non encore implémentée.</h3>";
    }

    // ----- REVUES -----
    else if ($type == "revue") {
        echo "<h3>Section revue non encore implémentée.</h3>";
    }

}
?>

</body>
</html>
