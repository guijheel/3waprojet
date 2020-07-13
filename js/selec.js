/*

        Fonction qui cache / affiche les donnée admin 

*/

 $(function() {
    $('.selection').change(function(){
        $('.formulaire_admin').hide();
        $('#' + $(this).val()).show();
    });
});