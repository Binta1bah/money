<?php
session_start();
if (!isset($_SESSION['Convertir'])) {
    $_SESSION['Convertir'] = array();
}
function conversion()
{
    $resultat = null;
    if (isset($_POST['Convertir'])) {
        $valeur = ($_POST['franc']);
        if ($valeur >= 0) {
            $resultat = $valeur / 650;
            $date = date('d-m-Y');
            // $_SESSION['Convertir'][] = array('franc' => $valeur, 'euro' => $resultat, 'date' => $date);
            $_SESSION['Convertir'][$date][] = array('franc' => $valeur, 'euro' => $resultat);
        } else {
            echo "Entrez un nombre positif";
        }
    }
    return $resultat;
}
$euro = conversion();
$_POST['euro'] = $euro;


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Convertissaur de monnaie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <form action="" method="post">
            <input type="number" id="champ1" name="franc" placeholder="Entrez le montant en franc" step="0.01" value="<?php if (isset($_POST['franc'])) echo $_POST['franc']; ?>"><br>
            <input type="submit" id="btn" name="Convertir" value="Convertir"><br>
            <input type="number" id="champ2" name="euro" value="<?php if (isset($_POST['euro'])) echo $_POST['euro']; ?>">
        </form>
    </div>


</body>

</html>


<?php

echo "<h3> <U> Voici votre historique de convertion: </U> </h1>";


foreach ($_SESSION['Convertir'] as $date => $conversion) {
    echo "<form action='' method='post'>";
    echo "<B>Conversion effectuée le: " . $date . "  </B> ";
    echo "<input type='hidden' name='dateSup' value='$date'>";
    echo "<input type='submit' name='Sup' value='Supprimer cette date'>";
    echo "</form>";
    echo "<br>";
    foreach ($conversion as $c) {
        // echo "convertion effectuée le " . $c['date'];
        echo "  Montant en franc:" . $c['franc'] . " ;       Montant en euro: " . $c['euro'];
        echo "<br>";
    }
    echo "<br>";
}

if (isset($_POST['Sup'])) {
    $dateSup = $_POST['dateSup'];
    unset($_SESSION['Convertir'][$dateSup]);
}


// foreach ($_SESSION['Convertir'] as $c) {
//     echo "convertion effectuée le " . $c['date'];
//     echo " montant en franc: " . $c['franc'] . " ;       Montant en euro: " . $c['euro'];
//     echo "<br>";
//     echo "<br>";
// }

// session_destroy();
?>