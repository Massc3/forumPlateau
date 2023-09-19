<?php
// declaration de la variable categorie
$categories = $result["data"]["categories"];
$title = $result["data"]["title"];

?>

<h1 id="titre-list-category">liste des categories</h1>
<div class="list-category">
    <?php
    // pour chacune des categories afficher sa liste des Topics
    foreach ($categories as $value) {
    ?>
        <!-- action qui relie grace au cheminement la fonction des categories par leur ID  -->
        <p><a href="index.php?ctrl=forum&action=findTopicByCategoryId&id=<?= $value->getId() ?>"><?= $value->getNameCategory() ?></a></p>

    <?php

    }
    ?>
</div>

<div class="button-category">
    <button class="button-update"><a href="index.php?ctrl=forum&action=updateCategoryForm">Update Category</a></button>
    <button class="button-add"><a href="index.php?ctrl=forum&action=addCategoryForm">Add Category</a></button>
</div>