<?php
// declaration de la variable des users
$users = $result["data"]["users"];

?>

<h1>liste des topics</h1>

<?php
// Afficher la liste des users
foreach ($users as $value) {
?>
    <p><?= $value->getPseudo() ?></p>
<?php
}
?>