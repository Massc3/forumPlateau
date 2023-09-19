<h1>Ajout d'une categorie</h1>

<?php
if (isset($isAddCategorySuccess) && isset($globalMessage) && $globalMessage) {
?>
    <p id="global-message" class="<?= $isAddCategorySuccess ? "text-success" : "text-error" ?>"><?= $globalMessage ?></p>
<?php
}
?>

<form action="index.php?ctrl=forum&action=addCategory" method="post" class="category-form">

    <label for="nameCategory">Nom de la categorie</label>

    <input type="text" id="category" name="nameCategory" placeholder="Junior" maxlength="30" />

    <?php
    if (isset($errorMessages) && isset($errorMessages["nameCategory"]) && $errorMessages["nameCategory"]) {
    ?>
        <p class="text-error"><?= $errorMessages["nameCategory"] ?></p>
    <?php
    }
    ?>

    <button type="submit">Enregistrer</button>

</form>