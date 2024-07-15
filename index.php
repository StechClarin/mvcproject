<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESP ACTUALITE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h3>ESP ACTUALITE</h3>
    </div>
    <div class="nav">
        <a href="?">Accueil</a>
        <a href="?categorie=1">Sport</a>
        <a href="?categorie=2">Découverte</a>
        <a href="?categorie=3">E-Learning</a>
        <a href="?categorie=4">Politique</a>
    </div>
    <div class="container">
        <?php
        
        $mysqli = new mysqli("localhost", "root", "", "mglsi_news");

        
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        
        if (isset($_GET['categorie'])) {
            $categorie_id = intval($_GET['categorie']);
            $articles_query = "SELECT * FROM Article WHERE categorie=$categorie_id";
        } else {
            $articles_query = "SELECT * FROM Article";
        }

        
        $articles_result = $mysqli->query($articles_query);
        if ($articles_result->num_rows > 0) {
            while ($article = $articles_result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<h2>' . $article['titre'] . '</h2>';
                echo '<p>' . $article['contenu'] . '</p>';
                echo '<small>Publié le ' . $article['dateCreation'] . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun article trouvé.</p>';
        }

        
        $mysqli->close();
        ?>
    </div>
</body>
</html>
