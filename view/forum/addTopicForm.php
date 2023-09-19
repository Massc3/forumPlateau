<?php
$title = $result["data"]["title"];
?>

<h1>Ajout d'un topic</h1>

<form action="index.php?ctrl=forum&action=addTopic&id=<?= $id ?>" method="post" class="add-topic-form">

    <label for="title">Nom du Topic</label>

    <input type="text" id="topic" name="title" placeholder="camp de basket junior" maxlength="30" />
    <?php
    if ($title == 0) {
        // Le titre est unique, vous pouvez l'ajouter à la base de données
    } else {
        // Le titre existe déjà, affichez un message d'erreur à l'utilisateur
        echo "Ce titre existe déjà. Veuillez en choisir un autre.";
    }
    ?>

    <label for="text">contenu du post</label>

    <textarea type="text" id="id_post" name="text" placeholder="Veuillez ecrire un message pour votre nouveau sujet" cols="60" rows="10"></textarea>
    <!-- On vous organise un camp de basket cet été, si vous souhaitez vous insrire veuillez vous connecter a votre espace personnel -->
    <!-- <input type="submit" value="enregistrer"> -->
    <button type="submit">enregistrer</button>

</form>