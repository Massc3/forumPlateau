<?php
// declaration de la variable des users
$users = $result["data"]["users"];

?>

<h1>liste des users</h1>

<?php
// Afficher la liste des users
foreach ($users as $value) {
?>
    <a href="index.php?ctrl=security&action=userProfil&id=<?= $value->getId() ?>">
        <p><?= $value->getPseudo() ?><br><?= $value->getEmail() ?></p>
    </a>
<?php
}
?>

<!-- user : lola; mdp : lolaBonjour.21.  -->