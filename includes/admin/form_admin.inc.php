<div class="container">
    <form method="post" action-xhr="liste_recettes">


        <button type="submit" name="action" value="delete" class="ui red basic button">Supprimer les recettes</button>
        <button type="submit" name="action" value="update" class="ui primary basic button">Selection des recettes
        </button>


        <table class="ui celled table">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric"></th>
                <?php

                $nom_colonnes = array('Img', 'Titre', 'Type', 'Cout', 'Préparation'
                , 'Cuisson', 'Repos', 'Convives', 'Type univers', 'Univers', 'Auteur', 'Date', 'Vues');

                foreach ($nom_colonnes as $nc) {
                    echo '<th style="padding: 1em;">' . $nc . '</th>';
                }
                echo '<th>Edit</th>';

                ?>
            </tr>
            </thead>

<?php
echo "<tbody>";


$tout_recettes = $this->modelObj->get_recettes();


$j = 0;

while ($donnees = $tout_recettes->fetch()) {
    $j++;

    echo '<tr id="' . $donnees['id'] . '"><td>
            <input name="checked[]" value="' . $donnees['id'] . '" type="checkbox" class="mdl-checkbox__input"></td><td>';


    echo ' <amp-img width="50" height="50" src="/img/recette/thumbs/thumb' . $donnees['url_img'] . '" style="
    border-radius: 50%;
    height: 30px;
"/>';


    echo '</td>
<td><a href="/recettes/view_recipe?id=' . $donnees['id'] . '">' . $donnees['titre'] . '</a></td>
<td>' . $donnees['type'] . ' </td>
<td>' . $donnees['cout'] . ' </td>
<td>' . $donnees['tps_prepa'] . ' </td>
<td>' . $donnees['tps_cuisson'] . ' </td>
<td>' . $donnees['tps_repos'] . ' </td>
<td>' . $donnees['nb_convives'] . ' </td>
<td>' . $donnees['id_categ_univers'] . ' </td>
<td>' . $donnees['id_univers'] . ' </td>
<td>' . $donnees['id_utilisateur'] . ' </td>
<td>' . $donnees['date_ajout'] . ' </td>
<td><b>' . $donnees['nb_vues'] . '</b></td>
<td><a href="/admin/liste_recettes/edit/' . $donnees['id'] . '">Editer</a></td>
</tr>';


}


echo "</tr></tbody></table></form>";
?>