<!doctype html>
<!--

  ____ ____   ____
  / ___|  _ \ / ___|
 | |   | | | | |  _
 | |___| |_| | |_| |
  \____|____/ \____|

Idea, Code, Design by :
-----------------------

🍥 Epistol
MICHAEL LEBEAU
mikaleb🐼live.com // admin🐼cuisinedegeek.com // contact🐼epistol.info



 ... Want some cake ? Time to recall old games 🎂

-->
<html ⚡ lang="fr-fr">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <link rel="canonical" href="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if (isset($varpage)) {
            echo ucfirst($varpage) . ' - CDG';
        } else {
            echo 'CDG';
        } ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <meta name="google-site-verification" content="Nh7EUAtLR45gYdpkGWfi2KJAi_UP-0lJfy5OHhE0HPs"/>

    <!-- ICONS -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon.png"/>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="/css/bulma.css">


    <style amp-boilerplate>body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }</style>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link href="/css/featherlight.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="/css/main.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <noscript>
        <style amp-boilerplate>body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }</style>
    </noscript>

    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <script type="text/javascript" src="/js/cookie.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"
            type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" async></script>
    <script src="/semantic/dist/semantic.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.myeditablediv',
            height: 500,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
        });
    </script>



</head>
<body>
<?php require_once 'view/menu/menu.php'; ?>
<?php


if (isset($_SESSION['msg'])) {
    echo "<div class=' notification    " . $_SESSION['color'] . "'>
        
        <i class='material-icons' style='padding-right: 1em;font-size: 32px;'>error_outline</i>" . $_SESSION['msg'] . "
        
         </div>";
    unset($_SESSION['msg']);
    unset($_SESSION['color']);
}


?>