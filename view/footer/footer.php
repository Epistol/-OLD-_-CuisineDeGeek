
</div></div>
<!-- TODO Améliorer ce pied de page -->
<div class="notification  is-paddingless is-clearfix" style="background:rgba(133, 127, 225, 0.5); margin-top: 20px">

    <div id="close" class="transition"><i class="material-icons">close</i></div>

    <p class="title_notif">Newsletter : pour recevoir des idées de recettes chaque semaine !</p>


    <form class="control is-grouped" style="width: 60%; margin-left: 20%; padding: 1%;">

        <p class="control is-expanded has-icon">
            <input class="input" type="email" placeholder="VotreEmail@">
            <i class="material-icons fa">email</i>
        </p>


        <p class="control">
            <button class="button " type="submit">
                <i class="material-icons">create</i>
                <span>S'inscrire</span>
            </button>

        </p>


    </form>

</div>


<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted grid">
            <div class="five wide column">
                <div class="active item">CDG</div>
            </div>
            <div class="six wide column">
                <div class="ui inverted celled horizontal link list ">
                    <a href="/admin" class="item">Admin</a>
                    <a href="/modules/mail" class="item">Contact</a>
                    <a href="/modules/about" class="item">A propos</a>
                    <a href="/modules/faq" class="item">FAQ</a>
                    <a href="/modules/cgu" class="item">CGU</a>
                    <a href="javascript:tarteaucitron.userInterface.openPanel();" class="item">Gestion des cookies</a>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<!-- SCRIPTS JS -->


<script src="/js/tableau.js"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script id="dsq-count-scr" src="//cuisinedegeek.disqus.com/count.js"></script>

<script>
    $(document).ready(function () {

        if (Cookies.get('no_email_sub') == 1) {
            $('.email_sub').hide();
        }


        // Timeout le popup d'alerte
        setTimeout(function () {
            $('.alert').fadeOut('fast');
        }, 3000); // <-- time in milliseconds


        $('#close').click(function (e) {
            Cookies.set('no_email_sub', '1', {expires: 7});
            $('.email_sub').fadeOut('slow', function () {
                $('#close').fadeOut('slow');
            });
        });

    });
</script>

<script type="text/javascript">
    window.smartlook || (function (d) {
        var o = smartlook = function () {
            o.api.push(arguments)
        }, h = d.getElementsByTagName('head')[0];
        var c = d.createElement('script');
        o.api = new Array();
        c.async = true;
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.src = '//rec.smartlook.com/recorder.js';
        h.appendChild(c);
    })(document);
    smartlook('init', 'c21420a7e3cfabeff99d6221bbe9f5133ffa7576');
</script>


<script type="text/javascript" src="/tarteaucitron/tarteaucitron.js"></script>

<script type="text/javascript">
    tarteaucitron.init({
        "hashtag": "#tarteaucitron", /* Ouverture automatique du panel avec le hashtag */
        "highPrivacy": false, /* désactiver le consentement implicite (en naviguant) ? */
        "orientation": "bottom", /* le bandeau doit être en haut (top) ou en bas (bottom) ? */
        "adblocker": false, /* Afficher un message si un adblocker est détecté */
        "showAlertSmall": false, /* afficher le petit bandeau en bas à droite ? */
        "cookieslist": true, /* Afficher la liste des cookies installés ? */
        "removeCredit": true /* supprimer le lien vers la source ? */
    });
</script>


<script src="/js/plugins.js" async defer></script>
<script src="/js/main.js" async defer></script>


<script type="text/javascript" async defer>
    tarteaucitron.user.analyticsUa = 'UA-56116805-1';
    tarteaucitron.user.analyticsMore = function () { /* add here your optionnal ga.push() */
    };
    (tarteaucitron.job = tarteaucitron.job || []).push('analytics');
</script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-56116805-1', 'auto');
    ga('send', 'pageview');

</script>


</body>
</html>
