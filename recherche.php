<?php
require_once './Includes/header.php';
require_once './Models/CountryModel.php';

$countryModel = new CountryModel();

?>

<?php if (isset($_GET['search']) && !empty($_GET['search'])) :

    $search = strip_tags($_GET['search']);


    $countries = $countryModel->searchSuggestion($search);
    
?>

    <?php foreach ($countries as $value) : ?>

        <a href="./element.php?id=<?= $value->id ?>">
            <img src="Images/<?= $value->flagImage?>" alt="">
            <span><?= $value->name?></span>
        </a>
    <?php endforeach ?>

<?php else : ?>
    <?php header('Location: ../index.php')    ?>
<?php endif ?>