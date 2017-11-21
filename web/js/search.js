$("#search").autocomplete({
    source : function (requete, reponse)
    {
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