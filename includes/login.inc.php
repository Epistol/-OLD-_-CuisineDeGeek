<style type="text/css">
    body {
        background-color: #DADADA;
    }

    body > .grid {
        height: 100%;
    }

    .image {
        margin-top: -50px;
    }

    .column {
        max-width: 550px;
    }
</style>


<div class="ui middle aligned center aligned grid max_height box">
    <div class="column">


        <div class="titre_page centred">
            <p>Connectez-vous</p>
        </div>


        <form method="post" action-xhr="login" class="ui large form">

            <?php
            echo '<input type="hidden" name="location" value="';
            if (isset($_GET['location'])) {
                echo htmlspecialchars($_GET['location']);
            }
            echo '" />';
            ?>


            <i class="user icon"></i>
            <input type="text" autocomplete="username" name="txt_uname_email"
                   placeholder="Pseudo ou adresse mail">

            <i class="lock icon"></i>
            <input type="password" autocomplete="current-password" name="txt_password"
                   placeholder="Mot de passe">

            <div class="ui hidden divider"></div>
            <button class="button is-primary" type="submit">Connexion</button>


            <div class="ui error message notification"></div>

        </form>


        <div class="ui message">
            Pas encore de compte ? <a href="register"> Enregistrez-vous !</a>
        </div>


    </div>

</div>


<?php


// mail('mikaleb@live.fr', 'Test', 'Coucou', "From: epistolshow@gmail.com" );

// Create the mail transport configuration
$transport = Swift_MailTransport::newInstance();

// Create the message
$message = Swift_Message::newInstance();
$message->setTo(array(
    "hello@gmail.com" => "Aurelio De Rosa",
    "test@fake.com" => "Audero"
));
$message->setSubject("This email is sent using Swift Mailer");
$message->setBody("You're our best client ever.");
$message->setFrom("account@bank.com", "Your bank");

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);