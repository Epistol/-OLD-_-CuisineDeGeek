<?php

if (isset($_SERVER['REQUEST_URI'])) {
    $url = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
} else {
    $url = '/';
}

?>


<div class="ui container">

    <div class="ui segment">

        <form id="msform" class="my-awesome-dropzone" method="post"
              enctype="multipart/form-data" action-xhr="/recette/modifier_valid/<?php echo $url[2]; ?>"
              target="_top">


            <h1>Ajouter une recette</h1>

            <div class="ui hidden divider"></div>
            <fieldset class="ui form">
                <!-- fieldsets -->


                <fieldset class="field" id="nom">

                    <div class="ui column grid">
                        <div class="row">
                            <div class="column">

                                <h2 class="fs-title">Nom de votre recette</h2>

                                <div class="ui fluid corner labeled input">

                                    <input style="width: 100%;" type="text" name="nom_recette" id="field"
                                           placeholder="Nom de la recette" required
                                           data-validation="length" data-validation-length="min2"
                                           value="<?php echo $nom; ?>"/>

                                    <div class="ui corner label">
                                        <i class="asterisk icon"></i>
                                    </div>
                                </div>


                                <div class="ui hidden divider"></div>


                                <textarea class="myeditablediv" name="descr"
                                          placeholder="Une astuce ? Un commentaire ? L'histoire de votre recette ? C'est ici ! "
                                          maxlength="1000"> <?= $desc ?> </textarea>

                                <div class="ui hidden divider"></div>


                                <div class="img_preview">

                                    <amp-img src="/img/recette/thumbs/thumb<?php echo $img_url; ?>" width="50px"/>

                                    <input type="file" name="photo" id="imgInp" accept="image/*" class="inputfile"/>

                                    <label for="imgInp"><i class="material-icons">file_upload</i> Envoyez une
                                        photo</label>

                                    <img id="blah" src="" style="max-height: 130px;max-width: 130px;"/></div>

                            </div>
                        </div>


                </fieldset>

                <fieldset>

                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col">
                            <h2 class="fs-title">Univers : </h2>

                            <select name="categ_univers" class="country">
                                <option value="else">Choisissez l'origine de votre recette
                                </option>
                                <?php
                                $i = 1;


                                foreach ($yo as $lib_univ) {

                                    if ($univers_cat == $i) {
                                        $select = 'selected';
                                    } else {
                                        $select = '';
                                    }
                                    echo '<option  value="' . $i . '" ' . $select . '>' . $lib_univ . ' </option>';

                                    $i++;


                                }

                                ?>

                            </select>
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="ui-widget">
                                <h2 class="fs-title">Origine: </h2>
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input name_list to_complete"
                                           type="text" id="tags" name="origine"
                                           value="<?php echo $lib_origine; ?>">
                                </div>


                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <h2 class="fs-title"><i class="fa fa-tag" aria-hidden="true"></i> Type</h2>
                            <label for="categorie_r"></label><select id="categorie_r"
                                                                     name="categorie_r">


                                <?php
                                $i = 1;

                                $type_univ = array('Entrée', 'Plat', 'Dessert', 'Accompagnement', 'Amuse-bouche',
                                    'Bonbon', 'Sauce', 'Cocktail');

                                foreach ($type_univ as $type_array) {

                                    if ($type == $i) {
                                        $select = 'selected';
                                    } else {
                                        $select = '';
                                    }
                                    echo '<option  value="' . $i . '" ' . $select . '>' . $type_array . ' </option>';

                                    $i++;


                                }

                                ?>

                            </select>

                        </div>
                    </div>


                </fieldset>


                <fieldset class="field" id="nom">

                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2 class="fs-title"><i class="fa fa-star" aria-hidden="true"></i>
                                Difficulté</h2>
                            <label for="contenu"></label><select id="contenu" name="difficulte">

                                <?php
                                $i = 1;

                                $difficulte_array = array('Facile', 'Moyen', 'Difficile');

                                foreach ($difficulte_array as $type_array) {

                                    if ($diff == $i) {
                                        $select = 'selected';
                                    } else {
                                        $select = '';
                                    }
                                    echo '<option  value="' . $i . '" ' . $select . '>' . $type_array . ' </option>';

                                    $i++;


                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2 class="fs-title"><i class="fa fa-usd" aria-hidden="true"></i> Coût</h2>
                            <select id="contenu" name="cost">
                                <?php
                                $i = 1;

                                $cout_array = array('Econome', 'Abordable', 'Onéreux');

                                foreach ($cout_array as $retour) {

                                    if ($cout == $i) {
                                        $select = 'selected';
                                    } else {
                                        $select = '';
                                    }
                                    echo '<option  value="' . $i . '" ' . $select . '>' . $retour . ' </option>';

                                    $i++;


                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <h2 class="fs-title"><i class="fa fa-user" aria-hidden="true"></i> Nombre de
                        convives</h2>
                    <input id="nb_convive" class="pure-input-1-4" name="nb_convive" type="number"
                           placeholder="ex : 4" min="1" value="<?php echo $nb_convive; ?>">
                </fieldset>

                <fieldset class="field" id="nom">
                    <h2 class="fs-title">Tout est une question de timing</h2>

                    <div class="ui three column grid">


                        <div class="column"><label class="label_add" for="tps_preparation-h"><i
                                    class="fa fa-clock-o"
                                    aria-hidden="true"></i> Temps de
                                préparation * : </label>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_preparation-h" name="tps_preparation-h" class="pure-input-1-4"
                                       type="number"
                                       placeholder="00" min="0" value="<?php echo $tps_preparation_h; ?>">
                                <p style="
    float: left;padding: 1%;
"> heure(s) </p></div>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_preparation-m" name="tps_preparation-m" class="pure-input-1-4"
                                       type="number"
                                       placeholder="00" min="0" value="<?php echo $tps_preparation_m; ?>">
                                <p style="
    float: left;padding: 1%;
"> min</p>
                            </div>
                        </div>


                        <div class="column"><label class="label_add" for="tps_preparation-h">
                                <i class="fa fa-fire" aria-hidden="true"></i>
                                Temps de cuisson / congélation : </label>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_cuisson-h" name="tps_cuisson-h" class="pure-input-1-4"
                                       type="number"
                                       placeholder="00" min="0" value="<?php echo $tps_cuisson_h; ?>">
                                <p style="
    float: left;padding: 1%;
"> heure(s) </p>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_cuisson-m" name="tps_cuisson-m" class="pure-input-1-4"
                                       type="number"
                                       value="<?php echo $tps_cuisson_m; ?>"
                                       placeholder="00" min="0">
                                <p style="
    float: left;padding: 1%;
"> min</p>
                            </div>
                        </div>


                        <div class="column">

                            <label class="label_add" for="tps_preparation-h"> <i
                                    class="fa fa-pause"
                                    aria-hidden="true"></i>
                                Temps de repos : </label>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_repos-h" name="tps_repos-h" value="<?php echo $tps_repos_h; ?>"
                                       class="pure-input-1-4" type="number" placeholder="00" min="0">
                                <p style="
    float: left;padding: 1%;
"> heure(s) </p>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col">

                                <input id="tps_repos-m" name="tps_repos-m" value="<?php echo $tps_repos_m; ?>"
                                       class="pure-input-1-4" type="number" placeholder="00" min="0">
                                <p style="
    float: left;padding: 1%;
"> min</p>
                            </div>
                        </div>


                    </div>
                </fieldset>


                <fieldset class="field" id="nom">
                    <h2 class="fs-title">Ingredients</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>

                                <td>
                                    <button type="button" name="add" id="add"  class="ui primary button" class="addfields button-success pure-button">+ Ajouter un
                                        autre
                                    </button>
                                </td>

                            </tr>


                            <?php
                            $i = 1;


                            foreach ($ingredients as $ingr_array => $valeur) {

                                if ($type == $i) {
                                    $select = 'selected';
                                } else {
                                    $select = '';
                                }
                                echo '
                           <tr><td >' . $i . '</td> 
                           <td><input type="text" id="qtt" name="qtt_' . $i . '"
                                                    placeholder="Quantité" class="form-control qtt_' . $i . '" value="' . $valeur["quantite"] . ' "/>
                    </td>
                    
                    <td ><input type="text" id="ingr" name="ingred_' . $i . '" 
                                                    placeholder="Ingrédient" class="form-control ingr_origi' . $i . '" value="' . $valeur["lib_ingredient"] . '"/>
                    </td>
                           </tr>';


                                $i++;


                            }

                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><input type="text" id="qtt" name="qtt_<?php echo $i; ?>"
                                           placeholder="Quantité" class="form-control qtt_<?php echo $i; ?>" "/>
                                </td>
                                <td><input type="text" id="ingr" name="ingred_<?php echo $i; ?>"
                                           placeholder="Ingrédient" class="form-control ingr_origi<?php echo $i; ?>"/>
                                </td>
                            </tr>


                        </table>

                    </div>


                </fieldset>


                <fieldset class="field" id="nom">
                    <h2 class="fs-title">Etapes</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>

                                <td>

                                    <button type="button" name="add2" id="add2"  class="ui primary button"
                                            class="addfields button-success pure-button">+ Ajouter une etape
                                    </button>


                                </td>

                            </tr>


                            <?php
                            $l = 1;


                            foreach ($steps as $ingr2_array => $valeur) {


                                if ($type == $l) {
                                    $select = 'selected';
                                } else {
                                    $select = '';
                                }
                                echo '
                           <tr><td style="width: 10%">' . $l . '</td> 
                    <td style="width: 100%;">
                    <textarea type="text" id="etape" name="etape_' . $l . '" style="width: 100%;"
                                                    placeholder="Etape" class="form-control etape_origi'
                                    . $l . '" value="' . $valeur["instructions"] . '">'.$valeur["instructions"].'</textarea>
                    </td>
                           </tr>';


                                $l++;


                            }

                            ?>

                            <tr>
                                <td><?php echo $l; ?></td>
                                <td style="width: 100%;"><input type="text" id="ingr" name="etape_<?php echo $l; ?>"
                                                                style="width: 100%;"
                                                                placeholder="Etape" class="form-control etape_origi1"/>
                                </td>
                            </tr>


                        </table>

                    </div>

                </fieldset>


                <fieldset class="field" id="nom" >

                    <div class="g-recaptcha" data-sitekey="6LddZwoTAAAAAKplqpYFwSEUcWYW9lYFkgvfuTLN"
                         data-callback="enableBtn"></div>


                    <?php // TODO Validation étape par étape avant ce boutton ?>
                    <button id="button1" name="submit" type="submit" class="btn btn-primary submit action-button">Submit
                        form
                    </button>
                </fieldset>

            </fieldset>


        </form>

        <!-- jQuery easing plugin -->
        <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
        <script
            src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

        <!-- Script perso sur l'ajout de recette -->

        <script>
            var thedata = <?php echo $i?>;
            var thedata2 = <?php echo $l?>;
        </script>
        <script src="/js/modif.js"></script>