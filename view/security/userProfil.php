<?php
// declaration de la variable user
$user = $result["data"]["user"];

?>
<h1> Profil </h1>
<div class="user-profil-items">
    <!-- recuperation du Pseudo, de l'email et de la date de creation du User en session -->
    <p>Pseudo <?= $user->getPseudo() ?></p>
    <p>Email <?= $user->getEmail() ?></p>
    <p>Date d'Inscription<?= $user->getDateInscription() ?></p>
    <p>Mot de passe <?= $user->getPassword() ?></p>

</div>