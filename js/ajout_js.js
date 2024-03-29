/**
 * Created by ASUS on 13/08/2016.
 */

$(document).ready(function () {

    $('#msform').validate({
        lang: 'fr',
        rules: {
            field: {
                required: true
            }

        }
    });



});




function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURL(this);
});


//<![CDATA[

/* -------------------------------------------------------

 * Filename:     Adding Form Fields Dynamically
 * Website:      http://www.shanidkv.com
 * Description:  Shanidkv AngularJS blog
 * Author:       Muhammed Shanid shanidkannur@gmail.com

 ---------------------------------------------------------*/

var app = angular.module('ingredients', []);

app.controller('MainCtrl', function ($scope) {

    $scope.choices = [{Numero: '1'}, {Numero: '2'}];

    $scope.addNewChoice = function () {
        var newItemNo = $scope.choices.length + 1;
        $scope.choices.push({'Nombre': newItemNo});
    };

    $scope.removeChoice = function () {
        var lastItem = $scope.choices.length - 1;
        $scope.choices.splice(lastItem);
    };

});
//]]>


$(document).ready(function () {




    // Autocompletion des origines
    $(".name_list").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "post",
                minLength: 3,
                url: "/view/recette/get_info.php?term=" + encodeURIComponent(request.term),
                dataType: "json",
                success: function (data) {
                    response(data);
                }
            });
        }
    });

    // autocompletion du 1er champ des ingredients
    $(".ingr_origi1").autocomplete({
        source: function (request, response) {
            $.ajax({
                type: "post",
                minLength: 3,
                url: "/view/recette/get_ingredient.php?term=" + encodeURIComponent(request.term),
                dataType: "json",
                success: function (data) {
                    response(data);
                }
            });
        }
    });


    var i = 1;
    $('#add').click(function () {
        i++;
        $('#dynamic_field').append('<tr>' +
            '<td>' + i + ' :</td>' +
            ' <td><div class="ui input">'+
            '<input  type="text" id="ingr" name="ingred_' + i + '" placeholder="Ingrédient"' +
            'class="form-control ingr_origi" /> </div></td>' +



            +
            '</tr>'
        );
        // autocompletion des ingredients
        $(".ingr_origi").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: "post",
                    minLength: 3,
                    url: "/view/recette/get_ingredient.php?term=" + encodeURIComponent(request.term),
                    dataType: "json",
                    success: function (data) {
                        response(data);
                    }
                });
            }
        });
    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });


});
