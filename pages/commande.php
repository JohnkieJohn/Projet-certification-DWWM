<h2>Bon de commande</h2>
<div class="wrapper-container">
    <div id="commandLine" class="commandLine">
        <button type="button" id="addLine">+</button>
        <button type="button" id="removeLine" disabled>-</button>
    </div>
    <form id="myForm" class="myForm" action="./?page=validate-order" method="post">
        <div class="columnContainer">
            <div class="column">
                <p>Libellé</p>
                <select class="menuSelect" id="output">
                    <option>-</option>
                </select>
            </div>
            <div class="column">
                <p>Référence</p>
                <input name="ref[]" type="text" readonly>
            </div>
            <div class="column">
                <p>Prix unitaire</p>
                <input type="number" name="prixunit" value=0.00 readonly>
            </div>
            <div class="column">
                <p>Prix</p>
                <input type="number" name="prixglob" value=0.00 readonly>
            </div>
            <div class="column">
                <p>Quantité</p>
                <input type="number" name="qte[]" value=1 min=1 disabled>
            </div>
            <div class="total">
                <p>Total :</p>
                <input type="number" name="total_order" id="total" value=0 readonly>
            </div>
            <input type="submit" value="Enregistrer ma commande">
        </div>
    </form>
</div>