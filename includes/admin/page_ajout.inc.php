<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 13/11/2016
 * Time: 14:47
 */

?>


<div class="html ui top attached segment">

<form class="ui form" action-xhr="pages/ajouter" method="post">
    <div class="field">
        <label>Nom de la page : </label>
        <input type="text" name="titre">
    </div>
    <div class="field">
        <label>Contenu</label>
        <textarea class="myeditablediv" type="text" name="contenu">


            </textarea>
    </div>
    <button class="ui button" type="submit">Submit</button>
</form>

</div>