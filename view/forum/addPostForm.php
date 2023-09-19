<?php
$topic = $result["data"]["topic"];
?>
<h1>Ajout d'un post</h1>


<form action="index.php?ctrl=forum&action=addPost" method="post">

    <label for="text">Contenu du Post</label>

    <textarea type="text" id="post" name="text" placeholder="Ecrire votre message" cols="60" rows="10"></textarea>
    <input type="text" name="topicId" value="<?= $topic->getId() ?>" placeholder="updateTopic" maxlength="30" />
    <?php
    if (isset($errorMessages) && isset($errorMessages["text"]) && $errorMessages["text"]) {
    ?>
        <p class="text-error"><?= $errorMessages["text"] ?></p>
    <?php
    }
    ?>
    <button type="submit">enregistrer</button>

</form>