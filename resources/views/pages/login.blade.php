@extends('layout')

@section('content')
    <form action="" method="post" class="connexion">
        <fieldset>
            <h1>Connexion</h1>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">

            <label for="password">Mot de passe</label>
            <input type="password" name="passwords" id="password">

            <p>Avez-vous déjà un compte? <a href="{{route('register')}}">Créer un compte</a></p>

            <button type="submit">Connexion</button>
        </fieldset>
    </form>
@endsection




