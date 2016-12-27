<div class="ui container"  >


    <div class="ui segment" >
        <div class="ui left rail" id="formulaire_entier">
            <div class="ui segmen ui sticky" style="top: 25%;">
                <div class="ui tablet stackable vertical steps ">
                    <a class="step" href="#nom">
                        <div class="content">
                            <div class="title">Nom de la recette</div>
                        </div>
                    </a>
                    <a class="step" href="#type">
                        <div class="content">
                            <div class="title">Type & Univers</div>
                        </div>
                    </a>
                    <a class="step" href="#details">
                        <div class="content">
                            <div class="title">Details</div>
                        </div>
                    </a>
                    <a class="step" href="#ingredients">
                        <div class="content" >
                            <div class="title">Ingrédients</div>
                        </div>
                    </a>
                    <a class="step" href="#steps">
                        <div class="content" >
                            <div class="title">Etapes</div>
                        </div>
                    </a>
                    <a class="step" href="#validation">
                        <div class="content" >
                            <div class="title">Validation</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>



        <form id="msform" class="my-awesome-dropzone" method="post"
              enctype="multipart/form-data"  action-xhr="ajouter"
              target="_top" >

            <h1>Ajouter une recette</h1>


            <div class="ui hidden divider"></div>

            <!--<ul id="progressbar">
                <li class="active">Nom de la recette</li>
                <li>Type & Univers</li>
                <li>Details</li>
                <li>Ingrédients</li>
                <li>Etapes</li>
                <li>Fini :)</li>
            </ul>-->


            <div class="ui form">
                <!-- fieldsets -->





                <fieldset class="field" id="nom">

                    <div class="ui column grid">
                        <div class="row">
                            <div class="column">

                                <h2 class="fs-title">Nom de votre recette</h2>

                                <div class="ui fluid corner labeled input">
                                    <input   type="text" name="nom_recette" id="field" placeholder="Nom de la recette" required
                                             data-validation="length" data-validation-length="min2">
                                    <div class="ui corner label">
                                        <i class="asterisk icon"></i>
                                    </div>
                                </div>

                                <div class="ui hidden divider"></div>


                                <textarea  name="descr"
                                           placeholder="Une astuce ? Un commentaire ? L'histoire de votre recette ? C'est ici ! "
                                           maxlength="1000"></textarea>

                                <div class="ui hidden divider"></div>



                                <div class="img_preview">



                                    <input type="file"  name="photo" id="imgInp" accept="image/*" class="inputfile" />

                                    <label for="imgInp"><i class="material-icons">file_upload</i> Envoyez une photo</label>

                                    <amp-img id="blah" src="" style="max-height: 130px;max-width: 130px;"/></div>

                            </div>
                        </div>

                    </div>






                </fieldset>


                <fieldset class="field" id="type">

                    <div class="ui nine column grid">


                        <div class="row">
                            <h2 class="fs-title">Catégorie : </h2>
                        </div>
                        <div class="row">







                            <?php
                            $i = 1;
                            $pos = 0;

                            foreach ($yo as $lib_univ) {

                                echo '

 <div class="column">


            <input type="radio" name="categ_univers" value="' . $i . '" style="border: 1px solid #cccccc;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    background-position-y: '.$pos.'px;">';
                                echo '<label>';

                                echo $lib_univ . '</label>';
                                $i++;
                                $pos = $pos - 32;
                                echo '</div>';
                            }
                            ?>



                        </div>
                    </div>

                    <div class="ui hidden divider"></div>

                    <div class="row">
                        <div class="column">


                            <div class="ui-widget">
                                <h2 class="fs-title">D'ou viens votre recette ? </h2>

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input name_list to_complete" type="text" id="tags" name="origine"
                                           placeholder="Exemple : Skyrim, Harry Potter, Buffy, etc ...">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>

                    <div class="row">
                        <div class="column">




                            <h2 class="fs-title"><i class="fa fa-tag" aria-hidden="true"></i> Type de plat</h2>
                            <label for="categorie_r"></label><select class="ui dropdown" id="categorie_r" name="categorie_r">
                                <option value="1">Entrée</option>
                                <option value="2">Plat</option>
                                <option value="3">Dessert</option>
                                <option value="4">Accompagnement</option>
                                <option value="5">Amuse-bouche</option>
                                <option value="6">Bonbon</option>
                                <option value="7">Sauce</option>
                                <option value="8">Cocktail</option>
                            </select>



                        </div>
                    </div>





                </fieldset>


                <fieldset class="field" id="details">

                    <div class="ui three column grid" >


                        <div class="row">

                            <div class="column">

                                <h2 class="fs-title"> Difficulté</h2>
                                <label for="contenu"></label><select class="ui dropdown" id="contenu" name="difficulte">
                                    <option value="1">Facile</option>
                                    <option value="2">Moyen</option>
                                    <option value="3">Difficile</option>
                                </select>

                            </div>
                            <div class="column">

                                <h2 class="fs-title">Coût</h2>
                                <select class="ui dropdown" id="contenu" name="cost">
                                    <option value="1">Econome</option>
                                    <option value="2">Abordable</option>
                                    <option value="3">Onereux</option>
                                </select>
                            </div>
                            <div class="column">
                                <h2 class="fs-title">Personnes</h2>
                                <div class="ui input">
                                    <input  placeholder="Nombre d'invités ..." id="nb_convive" name="nb_convive" type="number" min="1">



                                </div>





                            </div>
                        </div>
                    </div>

                    <h2 class="fs-title">Tout est une question de timing</h2>
                    <div class="ui five column grid">

                        <div class="column">


                            <div class="ui grid">

                                <div class="sixteen wide column">
                                    <h3 class="fs-title"> Temps de préparation *</h3>
                                </div>
                            </div>


                            <div class="ui grid">

                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input id="tps_preparation-h" name="tps_preparation-h" type="number" placeholder="Nombre d'heures ... " min="0">
                                        <div class="ui basic label">
                                            h
                                        </div>
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input  name="tps_preparation-m"   id="tps_preparation-m"  type="number"
                                                placeholder="Nb minutes ..." min="0" >
                                        <div class="ui basic label">
                                            min
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">

                            <div class="ui grid">

                                <div class="sixteen wide column">
                                    <h3 class="fs-title"> Temps de congélation ou cuisson *</h3>
                                </div>
                            </div>

                            <div class="ui grid">

                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input id="tps_cuisson-h" name="tps_cuisson-h" type="number" placeholder="Nombre d'heures ... " min="0">
                                        <div class="ui basic label">
                                            h
                                        </div>
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input  name="tps_cuisson-m"   id="tps_cuisson-m"  type="number"
                                                placeholder="Nb minutes ..." min="0" >
                                        <div class="ui basic label">
                                            min
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="column"></div>
                        <div class="column">

                            <div class="ui grid">

                                <div class="sixteen wide column">
                                    <h3 class="fs-title"> Temps de repos *</h3>
                                </div>
                            </div>

                            <div class="ui grid">

                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input id="tps_repos-h" name="tps_repos-h" type="number" placeholder="Nombre d'heures ... " min="0">
                                        <div class="ui basic label">
                                            h
                                        </div>
                                    </div>
                                </div>
                                <div class="eight wide column">
                                    <div class="ui right labeled input">
                                        <input  name="tps_repos-m"   id="tps_repos-m"  type="number"
                                                placeholder="Nb minutes ..." min="0" >
                                        <div class="ui basic label">
                                            min
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>




                </fieldset>

                <fieldset class="field" id="ingredients">
                    <h2 class="fs-title">Ingredients</h2>




                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field" style="width: 80%;">
                            <tr>

                                <td>
                                    <button type="button" name="add" id="add"  class="ui primary button" class="addfields button-success pure-button">+ Ajouter un
                                        autre
                                    </button>
                                </td>
                            <tr><td style="
    min-height: 25px;
    height: 25px;
"></td></tr>
                            </tr>
                            <tr>
                                <td>1 : </td>
                                <td>
                                    <div class="ui input">

                                        <input type="text" id="ingr" name="ingred_1"
                                               placeholder="Ingrédient" class="form-control ingr_origi1"/>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>


                </fieldset>


                <fieldset class="field" id="steps" >
                    <h2 class="fs-title">Etapes</h2>


                    <div ng-app="ingredients" ng-controller="MainCtrl" >




                        <fieldset data-ng-repeat="choice in choices">

                            <div class="ui two column stackable grid">

                                <div class="six wide column">
                                    <label for="stepy"> Etape {{$index + 1}} : </label>
                                </div>

                                <div class="ten wide column">
                                    <textarea name="etape_{{$index + 1}}" type="text" ng-model="choice.name" name="stepy" id="stepy"></textarea>

                                    <button class="ui right floated button icon remove" type="button" ng-click="removeChoice()"><i class="minus icon"></i></button>
                                </div>

                            </div>

                        </fieldset>

                        <div class="ui right internal rail">
                            <div class="ui sticky" >
                                <button class="ui teal button icon button-success pure-button ajout_step" type="button" ng-click="addNewChoice()"
                                ><i class="plus icon"></i> Ajouter une étape
                                </button>
                            </div>

                        </div>


                    </div>


                </fieldset>


                <fieldset class="field" id="validation">

                    <div class="g-recaptcha" data-sitekey="6LddZwoTAAAAAKplqpYFwSEUcWYW9lYFkgvfuTLN"
                         data-callback="enableBtn"></div>


                    <button id="button1"  name="submit" type="submit" class="btn btn-primary submit  ui primary button">Envoyer la recette</button>

                    <button class="ui button" type="reset" name="previous" value="Effacer">
                        Effacer
                    </button>

                </fieldset>

            </div>
        </form>

        <!-- jQuery easing plugin -->
        <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

        <!-- Script perso sur l'ajout de recette -->
        <script src="/js/ajout_js.js"></script>

        <script>
            $('.ui.dropdown')
                .dropdown()
            ;
            $( document ).ready(function() {
                $('.ui.sticky').sticky();



            });

        </script>

        <script>
            $(function() {
                $('a[href*="#"]:not([href="#"])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        if (target.length) {
                            $('html, body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });
            });
        </script>



    </div>
