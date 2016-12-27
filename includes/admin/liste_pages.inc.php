<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 13/11/2016
 * Time: 14:13
 */

?>

<a href="/admin/pages/ajouter">
<button class="ui labeled icon primary button">
    <i class="plus icon"></i>
    Nouveau
</button>
</a>


<table class="ui celled table">
    <thead>
    <tr><th>Id</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Aperçu</th>
        <th>Edit / Delete </th>
    </tr></thead>
    <tbody>

    <?php


    $i = 0;
    foreach ($toutes_pages as $page){



        // strip tags to avoid breaking any html
        $string =  stripslashes( htmlspecialchars_decode($page['contenu']));

        if (strlen($string) > 500) {

            // truncate string
            $stringCut = substr($string, 0, 500);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
        }



        echo '<tr><td>'.$page['id'].'</td>';
        echo '<td>'.$page['name'].'</td>';
        echo '<td>'.$page['slug'].'</td>';
        echo '<td>'.$string.'</td>';
        echo '<td><a href="/admin/pages/edit/'.$page['id'].'"><button class="ui mini button">Edit</button></a>
         <button class="ui mini button" onclick="myFunction()"  >Supprimer</button></td></tr>';
        $i++;
    }



    ?>


    </tbody>
    <tfoot>
    <tr><th colspan="5">
            <div class="ui right floated pagination menu">
                <a class="icon item">
                    <i class="left chevron icon"></i>
                </a>
                <a class="item">1</a>
                <a class="item">2</a>
                <a class="item">3</a>
                <a class="item">4</a>
                <a class="icon item">
                    <i class="right chevron icon"></i>
                </a>
            </div>
        </th>
    </tr></tfoot>
</table>

<p id="demo"></p>
<script>
    function myFunction() {
        document.getElementById("demo").innerHTML = "Hello World";
    }
</script>

