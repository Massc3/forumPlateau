<?php
// declaration de la variable post
$posts = $result["data"]['posts'];
$topic = $result["data"]["topic"];

?>

<h1> Messages</h1>

<div id="list-post">
    <?php
    if ($posts !== NULL) {
        // pour chaque post afficher le message correspndant au post choisi
        foreach ($posts as $post) {
    ?>
            <!-- afficher le message du post -->
            <p class="post"><?= $post->getText() ?></p>
            <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>&topicId=<?= $topic->getId() ?>">delete</a>
    <?php
        }
    } else {
        $posts = "le topic n'a pas pu etre ajouté ";
    }
    ?>

    <div class="delete-post-boutton">
        <button class="button-add-post"><a href="index.php?ctrl=forum&action=addPostForm&id=<?= $_GET['id'] ?>">Add Post</a></button>
    </div>
</div>