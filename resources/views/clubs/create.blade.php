<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('leagues.store') }}" method="POST">
        @csrf
        <h1>Crear liga</h1>

        @include('clubs.form-create-club')
        <div class="mt-4 align-content-end">
            <a href="{{route('clubs.index')}}"  class="btn btn-outline-secondary" >Cancel</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>
