<!DOCTYPE html>


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

<html lang="fr-fr">
<head>

    <meta charset="utf-8">
    <!-- <script async src="https://cdn.ampproject.org/v0.js"></script> -->
    <link rel="canonical" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', '') - {{ config('app.name', 'CDG') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">

    <script src="/semantic/dist/semantic.min.js"></script>


    <!-- <script type="text/javascript" src="js/cookie.js"></script> -->
    <script src='https://www.google.com/recaptcha/api.js' async></script>


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


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">

        @include('layouts.menu')

        @yield('content')
    </div>

    @include('layouts.footer')



    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <!--  <script type="text/javascript">
          window.smartlook||(function(d) {
              var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
              var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
              c.charset='utf-8';c.src='//rec.smartlook.com/recorder.js';h.appendChild(c);
          })(document);
          smartlook('init', 'c21420a7e3cfabeff99d6221bbe9f5133ffa7576');
      </script> -->

      <script src="/js/tableau.js"></script>



  </body>
  </html>
