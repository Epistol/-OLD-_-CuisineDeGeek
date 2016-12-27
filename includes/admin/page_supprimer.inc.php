<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 14/11/2016
 * Time: 00:00
 */

?>




        <label>Nom de la page : </label>
        <h1><?= $page['name'] ?></h1>


<div class="ui segment">
            <?= html_entity_decode($page['contenu']) ?>
            </div>



<button class="ui primary button" id="ajout">
    Supprimer
</button>



<div id="modaldiv" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        Vous êtes sur ?
    </div>

    <div class="actions">
        <div class="ui black button">
            Nope
        </div>
        <div class="ui positive right labeled icon button">
            Yep
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $('#logIn').click(function(){


            $('#modaldiv').modal({
                closable  : false,
                onDeny    : function(){

                    return false;
                },
                onApprove : function() {

                    window.alert('Approved!');
                }
            })


            $('#modaldiv').modal('show');
        });
    });

</script>
