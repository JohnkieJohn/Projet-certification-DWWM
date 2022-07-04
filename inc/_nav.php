<nav id="menu" class="menu">
    <div class="menu__content">
        <ul>
        <?php 
            if(!empty($_SESSION)) // Si session ouverte
            {      
                if ($_SESSION["user"] === "admin") // Si session admin
                {
        ?>
                    <li><a href="./?page=backoffice">Gestion du catalogue</a></li>
                    <li><a href="./?page=usersList">Liste des utilisateurs</a></li>
            <?php
                }
                else // Si session utilisateur
                {
            ?>
                    <li><a href="./?page=commande">Accéder au bon de commande</a></li>
                    <li><a href="./?page=userOrder">Mes commandes</a></li>
            <?php
                }
            ?>
                <!-- Accessible à tous types de session -->
                <li><a href="./?page=catalogue">Catalogue</a></li>       
                <li><a href="./?page=deconnexion">Déconnexion</a></li>
        <?php 
            } 
            else // Si absence de session (visiteur)
            {
        ?>
                <li><a href="./?page=connexion">Connexion</a></li>
        <?php 
            } 
        ?> 
        </ul>
    </div>
</nav>