<x-app-layout>
<div class="container card pb-3">
    <form action="{{ route('challenges.store') }}" method="POST">
        @csrf
        <h1>Create Challenge</h1>

        @include('challenges.form-create-challenges')
        <div class="mt-4 align-content-end">
            <a href="{{route('challenges.index')}}"  class="btn btn-outline-secondary" >Cancel</a>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
</x-app-layout>
