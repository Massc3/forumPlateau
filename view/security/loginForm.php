<link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">



<h1>Connexion</h1>



<form action="index.php?ctrl=security&action=login" method="post">
    <div>
        <label for="pseudo">Pseudonyme:</label>
        <input type="text" name="pseudo" id="pseudo" required=true>
    </div>

    <!-- <div>

        <label for="userEmail">Email:</label>

        <input type="email" name="userEmail" id="userEmail" required=true>

    </div> -->

    <div>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required=true>

    </div>
    <div class="mdp-oublie">
        <a href="index.php?ctrl=security&action=updatePasswordForm">mot de passe oublié?</a>
    </div>

    <!-- soumettre la demande du formulaire -->
    <button type="submit">Connexion</button>

    <footer class="d-flex flex-column justify-content-center gap-2">

        <p>Pas encore inscrit ? </p>
        <p>
            <a href="index.php?ctrl=security&action=loginForm">S'inscrire ici</a>
        </p>

    </footer>



</form>