<?php


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>

    <!-- link css-->
    <link rel="stylesheet" href="Css/home.css">

    <!-- link js-->
    <script src="Js/script.js" type="text/javascript"></script>
</head>

<body>

    <main>
        <h1>Search</h1>
        <form action="recherche.php" method="get">
            <input type="search" name="search" id="search" placeholder="Rechercher un pays" value="<?= isset($_GET['search'])? strip_tags($_GET['search']):'' ?>">

        </form>
        <div>
            <span id="searchResult"></span>
            <span id="searchSuggestion"></span>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>