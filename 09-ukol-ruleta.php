<?php  
session_start();

if (!array_key_exists("konto",$_SESSION)) {
    $_SESSION["konto"] = 100;
    
}

if (array_key_exists("submit-ruleta",$_POST)) {
    $vsazeno = $_POST["sazka"];
    $vybrano = $_POST["vyber"];
    $vseOK = true;

        if ($vsazeno <= 0) {
            $vseOK = false;
        }
        if ($vybrano == "a") {
            $vseOK = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruleta</title>
</head>
<body>
    <h1>ruleta</h1>

    <?php
    
    if (array_key_exists("konto",$_SESSION)) {
        
            if (isset($vseOK) && $vseOK == true) {
                $ruleta = rand(0,36);
                echo "Padlo číslo $ruleta";
                echo "<br>";
                    if  (($ruleta % 2 == 0 && $vybrano == "suda") || ($ruleta % 2 !== 0 && $vybrano == "licha"))  {
                        echo "<h2>Výhra !!!<h2>";
                        $_SESSION["konto"] = $_SESSION["konto"] + $vsazeno;
                        
                    } else {
                        echo "<h2>Prohra :(<h2>";
                        $_SESSION["konto"] = $_SESSION["konto"] - $vsazeno;  
                    }
            }
    }
    
    echo "<br>";

    echo "<strong> Stav konta : {$_SESSION["konto"]} Kč</strong>";
    
    ?>

    <form action="" method="post">

        <label for="aaa">sázka:</label>
        <input type="number" name="sazka" id="aaa">
        <?php echo "Kč" ?>
        <br>
        <label for="bbb">Sudé/Liché</label>
        <select name="vyber" id="bbb">
            <option value="a">--Vyberte--</option>
            <option value="suda">Sudá</option>
            <option value="licha">Lichá</option>
        </select>
        <br>
        <input type="submit" name="submit-ruleta" value="Zatočit ruletou">

    </form>

</body>
</html>
