<h1>Mettre à jour une categorie</h1>

<div class="update-category">



    <h1>Update the category</h1>


    <form method="POST" action="index.php?ctrl=forum&action=updateCategoryForm&id=<?= $id ?>" class="form-flex-column">

        <nameCategory for="category-nameCategory" class="form-nameCategory-center">category name</nameCategory>

        <input type="text" id="category" class="form-input-center" name="nameCategory" value="<?= $formValues["nameCategory"] ?>" placeholder="nameCategory" maxlength="30" />

        <?php
        if (isset($errorMessages) && isset($errorMessages["nameCategory"])) {
        ?>
            <p class="text-error"><?= $errorMessages["nameCategory"] ?></p>
        <?php
        }
        ?>

        <!-- Quand on clique sur Update, le résultat renvoie vers le détail du category -->

        <button type="submit" class="button-link">↑ Update ↑</button>

    </form>



    <a href="index.php?ctrl=forum&action=listCategories" class="button-link">Return</a>



</div>