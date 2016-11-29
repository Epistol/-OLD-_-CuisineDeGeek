

<nav class="navbar navbar-default navbar-static-top ui  borderless menu " style="min-height:50px; border-radius: 0px; width:100%; border:0px;">
    <a href="{{ url('/') }}" class="header item">
        <amp-img src="/img/cdglogo.png" width="35px" height="20px" />

    </a>
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <a href="/recettes" class="item">Recettes</a>
    <div class="ui simple dropdown item">
        Types <i class="dropdown icon"></i>
        <div class="menu">
            <a class="item" href="/recettes/type/1">Entrées</a>
            <a class="item" href="/recettes/type/2">Plats</a>
            <a class="item" href="/recettes/type/3">Desserts</a>
            <a class="item" href="/recettes/type/4">Accompagnements</a>
            <a class="item" href="/recettes/type/5">Amuse-Bouche</a>
            <a class="item" href="/recettes/type/6">Bonbons</a>
            <a class="item" href="/recettes/type/7">Sauces</a>
            <a class="item" href="/recettes/type/8">🍹 Cocktails</a>
        </div>
    </div>
    <div class="ui simple dropdown item">
        Univers <i class="dropdown icon"></i>
        <div class="menu">
            <a class="item" href="/recettes/univers/2">Game of Thrones</a>
            <a class="item" href="/recettes/univers/1">Skyrim</a>
            <a class="item" href="/recettes/univers/">Et encore d'autres !</a>
        </div>
    </div>
    <div class="ui simple dropdown item">
        Catégories <i class="dropdown icon"></i>
        <div class="menu">
            <a href="/recettes/categorie/1" class="item">🎮 Jeux-vidéo</a>
            <a href="/recettes/categorie/2" class="item">🎥 Cinéma / TV</a>
            <a href="/recettes/categorie/3" class="item">💢 Manga / Anime</a>
            <a href="/recettes/categorie/5" class="item">💬 Comics</a>
            <a href="/recettes/categorie/6" class="item">🃏 Jeux de cartes</a>
            <a href="/recettes/categorie/7" class="item">📚 Livres</a>
        </div>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">CONNEXION</a></li>
            <li><a href="{{ url('/register') }}">S'INSCRIRE</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    </ul>


</nav>

