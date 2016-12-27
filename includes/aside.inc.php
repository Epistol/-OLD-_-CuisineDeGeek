<div class="ui doubling stackable grid container">
    <div class='four  wide column user_account ' >

        <a href="/utilisateur/compte"><h1><?php echo  $this->modelObj->get_pseudo() ;?> </h1></a>


        <?php
        
        if($clickable == TRUE){
            ?>
        <button class="img_profil_modifier dialog-button">
            <div class='ui circular image user_pic' id="blah2"  style="
                background:url('<?= $image_a_afficher; ?> '); background-size: cover;">
            </div>
        </button>

        <dialog id="dialog" class="mdl-dialog" style="
    max-width: 50%;
    width: calc(100% - 98rem);
">
            <h3 class="mdl-dialog__title">Votre avatar</h3>
            <div class="mdl-dialog__content">
                <form method="post" enctype="multipart/form-data" id="uploadForm" data-recording-ignore="mask">

                    ';

                    echo '
                    <div class="form-group">

                        <div class="img_preview">
                            <input type=\'file\' id="imgInp2" name="photo" accept="image/*"/>
                            <amp-img id="blah" src="" style="
              margin-top: 10%;
            "/>
                        </div>

                    </div>
            </div>
            <div class="mdl-dialog__actions">


                <button type="submit" class="mdl-button">Ok</button>
                <button type="button" class="mdl-button close">Annuler</button>
            </div>
            </form>
        </dialog>


        <script>
            $(document).ready(function () {
                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $(\'#blah\').attr(\'src\', e.target.result);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#imgInp2").change(function () {
                    readURL(this);
                });
            });
        </script>



        <script>
            $(document).ready(function () {
                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $(\'#blah2\').css(\'background-image\', \'url(\' + e.target.result + \')\');
                            $(\'.user_pic\').css(\'border\', \'3px dashed #fafafa\');
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#imgInp2").change(function () {
                    readURL(this);
                });
            });
        </script>


       <?php
        }
        else {


            ?>


            <!-- User's picture -->

            <a href="/utilisateur/modifier_profil">
                <amp-img class="ui circular image " src="<?= $image_a_afficher; ?>">
                </amp-img>
            </a>
            <?php
        }
        echo '<br /><a href="/utilisateur/modifier_profil">Modifier mon profil</a>';

        ?>
    </div>


        <script>
            (function() {
                'use strict';
                var dialogButton = document.querySelector('.dialog-button');
                var dialog = document.querySelector('#dialog');
                if (! dialog.showModal) {
                    dialogPolyfill.registerDialog(dialog);
                }
                dialogButton.addEventListener('click', function() {
                    dialog.showModal();
                });
                dialog.querySelector('button:not([disabled])')
                    .addEventListener('click', function() {

                        dialog.close();
                    });
                dialog.querySelector('.close').addEventListener('click', function() {
                    dialog.close();
                });
            }());
        </script>
