<?php
// declaration de la variable categorie
$topics = $result["data"]['topics'];
$category = $result['data']['category'];
?>


<h2>liste des topics</h2>
<title>Voici </title>

<div class="list-topics">
    <?php
    // pour chaque topics afficher le topic 
    // if ($topics) {
    if ($topics !== NULL) {
        foreach ($topics as $topic) {
    ?>
            <!-- afficher le titre du Topic -->
            <div class="list-topic-addTopic">
                <p class="list-topic"><a href="index.php?ctrl=forum&action=findPostByTopicId&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></p>
                <a href="index.php?ctrl=forum&action=updateTopicForm&id=<?= $topic->getId() ?>&categoryId=<?= $category->getId() ?>">Update</a>
                <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>&categoryId=<?= $category->getId() ?>">delete</a>
            </div>
    <?php
        }
    } else {
        $topics = "le topic n'a pas pu etre ajouté ";
    }
    ?>


</div>
<div class="list-topics-add">
    <a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $_GET['id'] ?>">Add Topic</a>
</div>