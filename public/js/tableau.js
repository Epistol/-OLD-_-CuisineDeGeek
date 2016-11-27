/**
 * Created by ASUS on 27/11/2016.
 */

$(document).ready(function() {

    var checked = [];


    // dès que l'état du bouton input checkbox change
    $('input:checkbox').change(function(){
        // si il est coché
        if($(this).is(":checked")) {
            checked.push($(this).val());
            $(this).parent().parent().addClass("is-selected");

        }
        // si il est décoché
        else {
            $(this).parent().parent().removeClass("is-selected");
            checked.pop($(this).val());

        } });

});



