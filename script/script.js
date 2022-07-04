$(document).ready(function(){

    var patternArticle = /[^a-zA-Z0-9]/;
    var patternPrice = /[^0-9](,[0-9]{2,2})/;
    var somme = 0;
    var response = '';

    /* Ajoute une ligne produit (back-office ajout de contenu) */
    function beforeGenerateInfos()
    {
        var article = $("#article").val();
        var refProd = $("#referenceProd").val();
        var prixUnitProd = parseFloat($("#prixUnitProd").val());
        if (patternArticle.test(article) || patternPrice.test(prixUnitProd) || refProd == "" || article == "" || prixUnitProd == "")
        {
            $("#recap").html("<span>Un des champs n'est pas valide, ou est resté vide, recommencez.</span>");
            return;
        }
        else
        {
            var preLib = $("<input>");
            $(".row:eq(0)").append(preLib);
            preLib.addClass("preLib");
            preLib.attr("name", "artcl[]");
            preLib.val($("#article").val());

            var preRef = $("<input>");
            $(".row:eq(1)").append(preRef);
            preRef.addClass("preRef");
            preRef.attr("name", "rfr[]");
            preRef.val($("#referenceProd").val());

            var prePrice = $("<input>");
            $(".row:eq(2)").append(prePrice);
            prePrice.addClass("prePrice");
            prePrice.attr("name", "prx[]");
            prePrice.val(parseFloat($("#prixUnitProd").val()).toFixed(2));

            var delInfos = $("<button></button>");
            $(".row:eq(3)").append(delInfos);
            delInfos.addClass("delInfos");
            delInfos.attr("type", "button");
            delInfos.html("supprimer");
        }
    }

    /* Supprime une ligne article (back-office ajout de contenu) */

    function removeLinePreGenerateInfos(i)
    {
        $(".preLib:eq("+i+")").remove();
        $(".preRef:eq("+i+")").remove();
        $(".prePrice:eq("+i+")").remove();
        $(".delInfos:eq("+i+")").remove();
    }

    /* Vide les champs après ajout de la ligne produit (back-office ajout de contenu) */

    function clearFields()
    {
        $("#article").val("");
        $("#referenceProd").val("");
        $("#prixUnitProd").val("");
    }

    /* Les 5 fonctions suivantes ajoute une ligne dans le bon de commande (user) lorsque le bouton "+" a été cliqué */

    function addSelect()
    {
        var newSelect = $("<select></select>");
        $(".column:eq(0)").append(newSelect);
        newSelect.addClass("menuSelect");
        var newOption = $("<option></option>");
        newSelect.append(newOption);
        newOption.html('-');
    }

    function addInputRef()
    {
        var newRef = $("<input>");
        $(".column:eq(1)").append(newRef);
        newRef.attr("name", "ref[]");
        newRef.attr("type", "text");
        newRef.attr("readonly", "");
    }

    function addInputPrixUnit()
    {
        var newPrixUnit = $("<input>");
        $(".column:eq(2)").append(newPrixUnit);
        newPrixUnit.attr("name", "prixunit");
        newPrixUnit.attr("type", "number");
        newPrixUnit.attr("value", 0);
        newPrixUnit.attr("readonly", "");
    }

    function addInputPrixGlobal()
    {
        var newPrixGlobal = $("<input>");
        $(".column:eq(3)").append(newPrixGlobal);
        newPrixGlobal.attr("name", "prixglob");
        newPrixGlobal.attr("type", "number");
        newPrixGlobal.attr("value", 0);
        newPrixGlobal.attr("readonly", "");
    }

    function addInputQuantite()
    {
        var newQte = $("<input>");
        $(".column:eq(4)").append(newQte);
        newQte.attr("name", "qte[]");
        newQte.attr("type", "number");
        newQte.attr("value", 1);
        newQte.attr("min", 1)
        newQte.attr("disabled", "");
    }

    /* Les 2 fonctions suivantes gèrent le fait de ne pas pouvoir ajouter plus de lignes dans le bon de commande
    qu'il n'y a de produits dans le catalogue, ainsi que le fait de laisser au moins une ligne de formulaire minimum */

    function setAddLine()
    {
        if ($(".menuSelect").length >= $(".menuSelect:eq(0)").children('option').length-1)
        {
            $("#addLine").prop("disabled", true);
        }
        else
        {
            $("#addLine").prop("disabled", false);
        }
    }

    function setRemoveLine()
    {
        if($(".menuSelect").length > 1)
        {
            $("#removeLine").prop("disabled", false);
        }
        else
        {
            $("#removeLine").prop("disabled", true);
        }
    }

    /* Supprime une ligne du formulaire de commande lorsque le bouton "-" a été cliqué */

    function removeLine()
    {
        var index = $(".menuSelect").length-1;
        $(".menuSelect:eq("+index+")").remove();
        $("input[name='ref[]']:eq("+index+")").remove();
        $("input[name='prixunit']:eq("+index+")").remove();
        $("input[name='prixglob']:eq("+index+")").remove();
        $("input[name='qte[]']:eq("+index+")").remove();
    }

    /* Calcul des prix globaux en fonction de la quantité de produit, et active la possibilité de changer la quantité lorsqu'un
    produit est choisi */

    function choiceByMenu(int)
    {
        $("input[name='prixglob']:eq("+int+")").val(parseFloat($("input[name='prixunit']:eq("+int+")").val()) * 
        parseFloat($("input[name='qte[]']:eq("+int+")").val()));
        $("input[name='prixglob']:eq("+int+")").val(parseFloat($("input[name='prixglob']:eq("+int+")").val()).toFixed(2));
        $("input[name='qte[]']:eq("+int+")").prop("disabled", false); 
    }

    /* Désactive une option du menu select dans les autres menu select du bon de commande si celle ci a déjà été choisi,
    sauf pour l'option par défaut */

    function optionsDisabled()
    {
        $('option').prop('disabled', false);
        $('.menuSelect').each(function() 
        {
            var val = this.value;
            $('.menuSelect').not(this).find('option').filter(function() 
            {
                return this.value === val;
            }).prop('disabled', true);
        });
        $('option').each(function()
        {
            $('option:eq(0)').prop('disabled', false);
        })
    }

    /* Calcul du prix total en faisant la somme des prix globaux sur chacunes des lignes du formulaire de commmande */

    function calculTotal()
    {
        $("input[name='prixglob']").each(function() {
            somme = somme + parseFloat($(this).val());
        });
        $("#total").val(parseFloat(somme));
        $("#total").val(Math.round($("#total").val() * 100) / 100);
        $("#total").val(parseFloat($("#total").val()).toFixed(2));
        somme = 0;
    }

    /* Calcul du prix global quand la quantité est modifiée */

    function calculPrixGlobal(j)
    {
        $("input[name='prixglob']:eq("+j+")").val(parseFloat($("input[name='prixunit']:eq("+j+")").val() * 
        $("input[name='qte[]']:eq("+j+")").val()));
        $("input[name='prixglob']:eq("+j+")").val(Math.round($("input[name='prixglob']:eq("+j+")").val() * 100) / 100);
        $("input[name='prixglob']:eq("+j+")").val(parseFloat($("input[name='prixglob']:eq("+j+")").val()).toFixed(2));
    }

    /* Récupère le libellé de l'article sélectionné */

    function getArticleName()
    {
        $("input[name='option_selected']:eq(0)").val($("option:selected").val());
    }

    /* ----- AJAX FUNCTIONS ------*/

    /* Affiche les options du menu select pour le bon de commande (user) */

    function getOptions()
    {
        var index = $(".menuSelect").length-1;
        response = $.ajax({
            type: "GET",
            url: "ajax/selectoptions.php?q=article_nom",
            async: false
        }).responseText;
        $(".menuSelect:eq("+index+")").html('<option>-</option>'+response);
    }

    /* Affiche la référence et le prix unitaire du produit choisi via l'option du menu select (bon de commande user) */

    function getRef(str, int)
    {
        if(str == '-')
        {
            $("input[name='ref[]']:eq("+int+")").val('');
            return;
        }
        response = $.ajax({
            type: "GET",
            url: "ajax/showRef.php?r="+str,
            async: false
        }).responseText;
        $("input[name='ref[]']:eq("+int+")").val(response);
    }

    function getPrice(str, int) 
    {
        if(str == '-')
        {
            $("input[name='prixunit']:eq("+int+")").val(0.00);
            choiceByMenu(int);
            calculTotal();
            return;
        }
        response = $.ajax({
            type: "GET",
            url: "ajax/showPrice.php?p="+str,
            async: false
        }).responseText;
        $("input[name='prixunit']:eq("+int+")").val(parseFloat(response).toFixed(2));
        choiceByMenu(int);
        calculTotal();
    }

    /* Affiche le contenu du catalogue */

    function showCatalogue(str, str2)
    {
        response = $.ajax({
            type: "GET",
            url: "ajax/showCatalogue.php",
            data: {'s': str, 't': str2},
            async: false
        }).responseText;
        $("#catalogue").html(response);
    }

    /* Affiche le ou les produits correspondants à l'entrée dans la barre de recherche de la page catalogue */

    /*function searchCatalogue(str)
    {
        response = $.ajax({
            type: "GET",
            url: "ajax/showCatalogue.php?t="+str+"%",
            async: false
        }).responseText;
        $("#catalogue").html(response);
    }*/

    /* Affiche l'id du produit */

    function getID(str)
    {
        response = $.ajax({
            type: "GET",
            url: "ajax/showID.php?s="+str,
            async: false
        }).responseText;
        $("#line_index").val(response);
    }

    /* Affiche la liste des utilisateurs */

    function getUsers()
    {
        response = $.ajax({
            type: "GET",
            url: "ajax/showAllUsers.php?s=show",
            async: false
        }).responseText;
        $('#list').html(response);
    }

    /* Affiche le ou les produits correspondants à l'entrée dans la barre de recherche de la page catalogue */

    function searchUsers(str)
    {
        response = $.ajax({
            type: "GET",
            url: "ajax/searchUsers.php?s="+str+"%",
            async: false
        }).responseText;
        $("#list").html(response);
    }

    /* -------- ONLOAD FUNCTIONS --------- */

    if ($(".menuSelect").length > 0)
    {
        getOptions();
    }

    if ($(".catalogue").length > 0)
    {
        showCatalogue('0', '');
    }

    if ($(".list").length > 0)
    {
        getUsers();
    }

    /* -------- EVENTS -------- */

    $(document).click(function(e)
    {
        if (e.target.className == "delInfos")
        {
            for (i = 0; i < $(".delInfos").length; i++)
            {
                if ($(".delInfos")[i] == e.target)
                {
                    removeLinePreGenerateInfos(i);
                }
            }
            /*$(".delInfos").each(function()
            {
                if ($(this) == e.target)
                {
                    removeLinePreGenerateInfos($(this).index());
                }
            })*/
        }

        if (e.target.id == "addLine")
        {
            addSelect();
            addInputRef();
            addInputPrixUnit();
            addInputPrixGlobal();
            addInputQuantite();
            setAddLine();
            setRemoveLine();
            getOptions();
            optionsDisabled();
        }

        if (e.target.id == "removeLine")
        {
            removeLine();
            calculTotal();
            setAddLine();
            setRemoveLine();
            optionsDisabled();
        }

        if (e.target.id == "addOptions")
        {
            beforeGenerateInfos();
            clearFields();
        }

        if (e.target.className == "menuSelect")
        {
            optionsDisabled();
        }
    });

    $(document).change(function(e)
    {
        if (e.target.className == "menuSelect")
        {
            var els = Array.prototype.slice.call($(".menuSelect"), 0 );
            getRef(e.target.value, els.indexOf(e.target));
            getPrice(e.target.value, els.indexOf(e.target));
            optionsDisabled();
            if ($("input[name='option_selected']").length > 0)
            {
                if ($('option:selected').val() !== '-')
                {
                    getID($('option:selected').val());
                    getArticleName();
                }
                else
                {
                    $('#line_index').val('');
                    $("input[name='option_selected']").val('');
                }
            }
        }
        if (e.target.name == 'qte[]')
        {
            for (j = 0; j < $(".menuSelect").length; j++)
            {
                calculPrixGlobal(j);
            }
            calculTotal();
        }
        if (e.target.id == "filtre")
        {
            showCatalogue(e.target.value, $('#search_catalog').val());
        }
    });

    $(document).on('input', function(e)
    {
        if (e.target.id == "search_catalog")
        {
            showCatalogue($('#filtre').children("option:selected").val(), e.target.value);
        }
        if (e.target.id == "search_users")
        {
            searchUsers(e.target.value);
        }
    });
  
});