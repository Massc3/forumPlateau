<h1>Mettre à jour un topic</h1>

<?php
$topic = $result["data"]['topic'];
$categoryId = $result["data"]["categoryId"];
?>
<div class="update-topic">



    <h1>Update the topic</h1>


    <form method="POST" action="index.php?ctrl=forum&action=updateTopic&id=<?= $topic->getId() ?>" class="form-flex-column">

        <label for="topic-updateTopic" class="form-updateTopic-center">topic name</label>

        <input type="text" id="topic-updateTopic" class="form-input-center" name="updateNameTopic" value="<?= $topic->getTitle() ?>" placeholder="updateTopic" maxlength="30" />

        <input type="hidden" name="categoryId" value="<?= $categoryId ?>">

        <?php
        if (isset($errorMessages) && isset($errorMessages["updateTopic"])) {
        ?>
            <p class="text-error"><?= $errorMessages["updateTopic"] ?></p>
        <?php
        }
        ?>

        <!-- Quand on clique sur Update, le résultat renvoie vers le détail du topic -->

        <button type="submit" class="button-link">↑ Update ↑</button>

    </form>



    <a href="index.php?ctrl=forum&action=listTopics" class="button-link-topic">Return</a>



</div>