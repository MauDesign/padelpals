<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('players.store') }}" method="POST">
        @csrf
        <h1>Crear Jugador</h1>

        @include('players.form-creat-players')
        <div class="mt-4 align-content-end">
            <a href="{{route('leagues.index')}}"  class="btn btn-outline-secondary" >Cancel</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>
