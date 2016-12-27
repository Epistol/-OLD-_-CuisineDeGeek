<div class="container">
    <div class="grad_log">
        <div class="formulaire_log">
            <div class="form-container">
                <form data-recording-ignore="mask" method="post" class="pure-form pure-form-aligned"
                      enctype="multipart/form-data" id="uploadForm">
                    <div class="no_register">
                        <h1>Enregistrez-vous</h1>

                        <div class="form-group">
                            <input type="text" id="form-login" class="form-control" autocomplete="username"
                                   name="txt_uname" required placeholder="Pseudo" value="<?php if (isset($error)) {
                                echo $uname;
                            } ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" id="form-login" class="form-control" autocomplete="email"
                                   name="txt_umail" required placeholder="Email" value="<?php if (isset($error)) {
                                echo $umail;
                            } ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="password" id="form-login" class="form-control" autocomplete="new-password"
                                   name="txt_upass" required placeholder="Mot de passe"/>
                        </div>
                        <div class="form-group">
                            <input type="password" id="form-login" class="form-control" autocomplete="current-password"
                                   name="password2" placeholder="Validez votre mot de passe"/>
                        </div>
                        <div class="form-group">
                            <p>Votre avatar</p>
                            <div class="img_preview">
                                <input type='file' id="imgInp2" name="photo" accept="image/*"/>
                                <amp-img id="blah" src="" style="
        max-height: 130px;
    max-width: 130px;
    margin-top: 15%;
        "/>
                            </div>

                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group">



                            <button type="submit" class="button  is-outlined" name="btn-signup" style="width: 50%;height: 3em;">
                                Enregistrez-vous
                            </button>
                        </div>
                        <hr/>

                    </div>
                    <div class="no_register">
                        <h1>Déjà inscrit ? </h1>
                        <a href="login">
                            <button class="button  is-outlined"
                                    type="button">
                                Connectez-vous !
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp2").change(function () {
            readURL(this);
        });
    });
</script>