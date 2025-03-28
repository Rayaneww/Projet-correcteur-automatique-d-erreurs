
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Qui est-ce ?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }
        .questions {
            flex: 1;
            padding-right: 20px;
        }
        .images {
            flex: 1;
            text-align: right;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }
        img {
            width: 100px;
            height: auto;
        }
        .highlight {
            border: 5px solid red;
        }
        .bas {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Qui est-ce ?</h1>

<div class="container">
    <div class="questions">
        <form method="POST" action="">
            <h2>1. A-t-il des lunettes ?</h2>
            <input type="radio" name="q1" value="1"> Oui
            <input type="radio" name="q1" value="0"> Non<br><br>

            <h2>2. A-t-il une moustache ?</h2>
            <input type="radio" name="q2" value="1"> Oui
            <input type="radio" name="q2" value="0"> Non<br><br>

            <h2>3. A-t-il un chapeau ?</h2>
            <input type="radio" name="q3" value="1"> Oui
            <input type="radio" name="q3" value="0"> Non<br><br>

            <h2>4. A-t-il des cheveux ?</h2>
            <input type="radio" name="q4" value="1"> Oui
            <input type="radio" name="q4" value="0"> Non<br><br>

            <h2>5. A-t-il une boucle d'oreille ?</h2>
            <input type="radio" name="q5" value="1"> Oui
            <input type="radio" name="q5" value="0"> Non<br><br>

            <h2>6. A-t-il une barbe ?</h2>
            <input type="radio" name="q6" value="1"> Oui
            <input type="radio" name="q6" value="0"> Non<br><br>

            <h2>7. A-t-il un nœud papillon ?</h2>
            <input type="radio" name="q7" value="1"> Oui
            <input type="radio" name="q7" value="0"> Non<br><br>

            <input type="submit" value="Vérifier">
        </form>
    </div>

    <div class="images">
        <?php
        // Liste des images possibles
        $images = [
            "0000000.png", "0001111.png", "0010011.png", "0011100.png",
            "1100011.png", "0100101.png", "0101010.png", "0110110.png",
            "0111001.png", "1011010.png", "1000110.png", "1001001.png",
            "1010101.png", "1101100.png", "1110000.png", "1111111.png"
        ];

        $highlightedImage = "";
        $bits = "";
        $masques1 = "1010101"; // Masque pour syndrome 1
        $masques2 = "0110110"; // Masque pour syndrome 2
        $masques3 = "0001111"; // Masque pour syndrome 3
        $message = ""; // Message d'erreur

        // Vérification du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des réponses du formulaire
            for ($i = 1; $i <= 7; $i++) {
                $bits .= isset($_POST['q' . $i]) ? $_POST['q' . $i] : "0";
            }

            // Calcul des syndromes
            $syndrome1 = 0;
            $syndrome2 = 0;
            $syndrome3 = 0;

            // Calcul du syndrome 1
            for ($i = 0; $i < 7; $i++) {
                if ($masques1[$i] == '1') {
                    $syndrome1 ^= (int)$bits[$i]; // XOR pour la parité
                }
            }

            // Calcul du syndrome 2
            for ($i = 0; $i < 7; $i++) {
                if ($masques2[$i] == '1') {
                    $syndrome2 ^= (int)$bits[$i]; // XOR pour la parité
                }
            }

            // Calcul du syndrome 3
            for ($i = 0; $i < 7; $i++) {
                if ($masques3[$i] == '1') {
                    $syndrome3 ^= (int)$bits[$i]; // XOR pour la parité
                }
            }

            // Résultat du contrôle des syndromes
            $resultat = (string)$syndrome1 . (string)$syndrome2 . (string)$syndrome3;

            // Vérifier quel est le mensonge et afficher un message
            switch ($resultat) {
                case "100":
                    $message = "Vous avez menti sur la question 1.";
                    $bits[0] = (string)(1 - (int)$bits[0]); // Correction de l'erreur
                    break;
                case "010":
                    $message = "Vous avez menti sur la question 2.";
                    $bits[1] = (string)(1 - (int)$bits[1]); // Correction de l'erreur
                    break;
                case "110":
                    $message = "Vous avez menti sur la question 3.";
                    $bits[2] = (string)(1 - (int)$bits[2]); // Correction de l'erreur
                    break;
                case "001":
                    $message = "Vous avez menti sur la question 4.";
                    $bits[3] = (string)(1 - (int)$bits[3]); // Correction de l'erreur
                    break;
                case "111":
                    $message = "Vous avez menti sur la question 5.";
                    $bits[4] = (string)(1 - (int)$bits[4]); // Correction de l'erreur
                    break;
                case "011":
                    $message = "Vous avez menti sur la question 6.";
                    $bits[5] = (string)(1 - (int)$bits[5]); // Correction de l'erreur
                    break;
                case "101":
                    $message = "Vous avez menti sur la question 7.";
                    $bits[6] = (string)(1 - (int)$bits[6]); // Correction de l'erreur
                    break;
                default:
                    $message = "Aucun mensonge détecté ou vous avez menti 2 fois.";
                    break;
            }

            // Mettre à jour l'image
            if (in_array($bits . ".png", $images)) {
                $highlightedImage = $bits . ".png";
            } else {
                // Si le résultat corrigé ne correspond pas à une image existante, afficher l'image d'erreur
                $highlightedImage = "Erreur.png"; // Choisir une image d'erreur
            }
        }
        
        shuffle($images);
        // Affichage des images
        foreach ($images as $image) {
            $class = ($image === $highlightedImage) ? "class='highlight'" : "";
            echo "<img src='http://btsio.org/2025/lebrunm/Qui-est-ce/$image' $class alt='$image'>";
        }
        ?>
    </div>
</div>

<div class="bas">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2 id='reponse'>Personne trouvée : $highlightedImage</h2>";
        echo "<p>$message</p>";  // Afficher le message d'erreur ou de succès
    }
    ?>
</div>

</body>
</html>

