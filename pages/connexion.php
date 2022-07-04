<?php
    if (empty($_SESSION))
    {
?>
        <form class="page_co" action="./?page=inscription" method="post">
            <p>S'inscrire</p>
            <label for="login">Choisissez un pseudo :</label>
            <input type="text" name="login" id="login">
            <label for="prenom">Votre prénom :</label>
            <input type="text" name="prenom" id="prenom">
            <label for="nom">Votre nom :</label>
            <input type="text" name="nom" id="nom">
            <label for="email">Votre email :</label>
            <input type="email" name="email" id="email">
            <label for="mdp">Choisissez un mot de passe :</label>
            <input type="password" name="mdp" id="mdp">
            <input type="submit" value="S'inscrire">
        </form>
        <form class="page_co" action="./?page=identification" method="post">
            <p>Se connecter</p>
            <label for="login_co">Login :</label>
            <input type="text" name="login_co" id="login_co" required>
            <label for="mdp_co">Mot de passe :</label>
            <input type="password" name="mdp_co" id="mdp_co" required>
            <input type="submit" value="Se connecter">
        </form>

<?php
    }
    else
    {
        echo "Vous êtes déjà connecté.";
    }
?>