@extends('layouts.app')

@section('page_title')Liste des recettes @endsection

@section('content')


    <div class="ui main container segment">
        <h1>Liste des recettes</h1>

        <a href='/recette/ajouter'>
            <button class="ui primary basic labeled icon button">
                <i class="plus icon"></i>  Ajouter une recette
            </button> </a>

        <img src="{{ $img }}" />





    </div>

@endsection