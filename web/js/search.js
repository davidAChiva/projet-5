$("#search").autocomplete({
    source : function (requete, reponse)
    {
        var motcle = $('#search').val();
        var DATA = 'motcle=' + motcle;
        $.ajax( {
            type: "POST",
            url:"{{ path('front_office_recipe_json') }}",
            dataType: "json",
            data: DATA,

            success: function (donnee) {
                reponse($.map(donnee, function (objet){
                    return objet;
                }));
            }
        });

    }
});