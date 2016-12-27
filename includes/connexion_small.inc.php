<li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover transition <?php echo $util_select;?>">
    <a href="/utilisateur/login" class="pure-menu-link transition">Connexion</a>

    <ul class="pure-menu-children">
        <div class="login_small">

            <form method="post" action="/utilisateur/login" data-recording-ignore="mask">
                <?php
                echo '<input type="hidden" name="location" value="';
                if(isset($_GET['location'])) {
                    echo htmlspecialchars($_GET['location']);
                }
                echo '" />';
                ?>

                <div class="no_register">
                    <div class="form-group">
                        <input type="text" id="form-login" autocomplete="username" name="txt_uname_email"
                               placeholder="Pseudo ou email" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="form-login" autocomplete="current-password" name="txt_password"
                               placeholder="Votre mot de passe" required/>
                    </div>
                    <div class="form-group">

                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name="btn-login" type="submit"
                                style="
    width: 90%;
    font-size: 1.2em;
    height: 3em;
"
                        >
                            CONNEXION
                        </button>
            </form>

        </div>
    </ul>

</li>