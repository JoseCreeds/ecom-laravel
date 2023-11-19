@extends('layout')

@section('content')
    <div class="container">

        <form method="post" action="">
            @csrf
            <fieldset>
                <legend style="text-align: center;"> Ajouter une catégorie</legend>

                {{-- <label for="IdCat">ID</label>
                <input type="text" name="idCat" id="idCat"> --}}
                    <label for="Libelle">Libellé</label>
                    <input type="text" name="libelleCat" id="libelleCat" value="{{$cat->libelleCat}}">

                <button type="submit">Ajouter</button>

            </fieldset>
        </form>
    </div>
@endsection
