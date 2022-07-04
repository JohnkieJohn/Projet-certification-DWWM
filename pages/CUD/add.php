<h2>BackOffice</h2>
<ul>
    <li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li>
</ul>

<div class="wrapper-container">
    <div id="firstContainer" class="firstContainer">
        <p id="recap" class="recap"></p>
        <input type="text" id="article" placeholder="Nom article" autofocus>
        <input type="text" id="referenceProd" placeholder="Référence produit">
        <input type="number" id="prixUnitProd" placeholder="Prix unitaire" min="0">
        <button type="button" id="addOptions">Ajouter</button>
    </div>
    <div id="table" class="table">
        <form action="./?page=insert" method="POST" class="table">
            <div class="row">
                <p>Libellé</p>
            </div>
            <div class="row">
                <p>Référence</p>
            </div>
            <div class="row">
                <p>Prix unitaire</p>
            </div>
            <div class="row">
                <p>-</p>
            </div>
            <button type="submit" name="submit">Insérer</button>
        </form>
    </div>
</div>
