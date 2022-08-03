
<?php
require_once './Includes/header.php'; 
require_once './Models/CountryModel.php';

$countryModel = new CountryModel();

?>

<?php if (isset($_GET['id']) && !empty($_GET['id'])) :

$id = strip_tags($_GET['id']);

$country = $countryModel->singleElement($id);

?>

<div class="singlePage">
   
        <section class="image">
            <img src="Images/<?= $country->countryMapImage?>" alt="">
        </section>
        <section class="description">
            <h3><?= $country->name ?></h3>

            <div>
                <span>
                   <p> Capitale</p>
                    <?= $country->capitalCity ?>
                </span>
                <span>
                    <p> Drapeau</p>
                    <img src="Images/<?= $country->flagImage ?>" alt="">
                </span>
            </div>

            <span>
                <p>Description</p>
                <hr>
                <?= $country->description ?>
           </span> 


        </section>
    
    </div>
<?php else : ?>
    <?php header('Location: index.php')    ?>
<?php endif ?>