<h2>BackOffice</h2>
<ul>
    <li><a href="./?page=backoffice">Revenir au menu du backoffice</a></li>
</ul>

<p>Sélectionner un article à retirer</p>
<select class="menuSelect"></select>

<form action="./?page=delete" method="post">
    <p>Id de l'article :</p>
    <input name="line_index" id="line_index" readonly>
    <p>Libellé :</p>
    <input name="option_selected" readonly>
    <p>Référence :</p>
    <input name="ref[]" readonly>
    <p>Prix unitaire :</p>
    <input name="prixunit" readonly>
    <input type="submit" value="Supprimer">
</form>