@extends('layouts.app')

@section('page_title')Accueil @endsection






@section('content')

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

                <span class="cdg_intro">Cuisine De Geek</span>
                <br />
                <div class="headline">Bienvenue sur CDG !<br />
                    Vous êtes sur un site de cuisine qui met à votre disposition des recettes tirés
                    d\'univers différents : <br />films, séries, jeux, animes, mangas, etc ... </div>



                <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>


            </div>
        </div>



@endsection

