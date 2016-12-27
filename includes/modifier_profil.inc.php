<div class="twelve wide column">
    <h2 class="ui icon header">
        <i class="settings icon"></i>
        <div class="content">
            Paramètres du compte
            <div class="sub header">Manage your account settings and set e-mail preferences.</div>
        </div>
    </h2>




<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    <div class="mdl-tabs__tab-bar">
        <a href="#Profil" class="mdl-tabs__tab is-active">Profil</a>
        <a href="#mdp" class="mdl-tabs__tab">Mot de passe</a>
        <a href="#notifs" class="mdl-tabs__tab">Notifications</a>
    </div>

    <div class="mdl-tabs__panel is-active" id="Profil">
        <form data-recording-ignore="mask"
        ><label for="pseudo">Votre pseudo : </label>
            <input name="pseudo" type="text" class="form-control" value="<?php echo $this->modelObj->get_info_current_user('username');?>">
        </form>
    </div>
    <div class="mdl-tabs__panel" id="mdp">
        <form data-recording-ignore="mask" action="verification_psd_reset" class="pure-form pure-form-stacked" method="POST">
            <fieldset>
                <legend>Définir un nouveau mot de passe</legend>

                <label for="psw1">Entrez votre mot de passe actuel</label>
                <input id="psw1" name="psw1" type="password" placeholder="">

                <label for="psw2">Tapez votre nouveau mot de passe</label>
                <input id="psw2" name="psw2" type="password" placeholder="">

                <label for="psw3">Tapez le de nouveau</label>
                <input id="psw3" name="psw3" type="password" placeholder="Ici">

                <div class="g-recaptcha" data-sitekey="6LddZwoTAAAAAKplqpYFwSEUcWYW9lYFkgvfuTLN"></div>


                <button type="submit" name="submit" class="pure-button pure-button-primary">Changer de mot de passe</button>
            </fieldset>
        </form>
    </div>
    <div class="mdl-tabs__panel" id="notifs">
        <ul>
            <li>Viserys</li>
            <li>Daenerys</li>
        </ul>
    </div>
</div>

</div> </div> </div>