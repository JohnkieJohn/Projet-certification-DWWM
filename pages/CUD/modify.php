<h2>BackOffice</h2>
<ul>
    <li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li>
</ul>

<p>Sélectionner un article à modifier</p>
<select class="menuSelect"></select>

<form action="./?page=update" method="post">
    <p>Id de l'article :</p>
    <input name="line_index" id="line_index" readonly>
    <p>Libellé :</p>
    <input name="option_selected">
    <p>Référence :</p>
    <input name="ref[]">
    <p>Prix unitaire :</p>
    <input name="prixunit">
    <input type="submit" value="Modifier">
</form>