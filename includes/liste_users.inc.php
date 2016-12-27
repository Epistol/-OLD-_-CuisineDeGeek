<div class="container">
<button id="button">Utilisateurs séléctionnés</button>
<button id="delete">Supprimer</button>


<table class="ui celled table"  >
    <thead>
    <tr>

        <th id="header"><input type="checkbox" class="mdl-checkbox__input"></th>
        <th class="mdl-data-table__cell--non-numeric">Id</th>
        <th>Pseudo</th>
        <th>Mail</th>
        <th>Activé</th>
        <th>Role</th>


    </tr>
    </thead>

<?php
echo "<tbody>";

$tout_user2 = $this->modelObj->get_users_nofetch('all');
while($donnees = $tout_user2->fetch()){
    if($donnees['activation'] == 0){
        $active = '<span style="color:red;">Non</span>';
    }
    else {
        $active = '<span style="color:green;">Oui</span>';
    }

    if($donnees['role'] == 0){
        $role = '<span >Utilisateur</span>';
    }
    else {
        $role = '<span style="font-weight: bold;">Admin</span>';
    }


    echo '<tr id="'.$donnees['id'].'"><td><input type="checkbox" class="mdl-checkbox__input"></td><td>';

    if (strpos($donnees['image_util'], 'https://api.adorable.io') !== false) {
        echo '<amp-img width="50" height="50" src="'. $donnees['image_util'] . '" style="
                            border-radius: 50%;
                            height: 30px;
                        "/>';
    }
    else {
        echo ' <amp-img width="50" height="50" src="/img/utilisateurs/thumbs/thumb' . $donnees['image_util'] . '" style="
                            border-radius: 50%;
                            height: 30px;
                        "/>';
    }


    echo '</td>
                    <td><a href="/admin/utilisateur/' . $donnees['id'] . '">' . $donnees['username'] . '</a></td>
                    <td><a href="mailto:' . $donnees['email'] . '">' . $donnees['email'] . '</a> </td>
                    <td>' . $active . ' </td>
                    <td>' . $role . ' </td>
                    
                    </tr>';


}



echo "</tr></tbody></table>";
?>