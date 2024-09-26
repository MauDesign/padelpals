<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Liga {{ $league->name }}
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{route('leagues.create')}}" class="btn btn-primary" >Agregar</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Canchas</td>
                        <td>Jugadores</td>
                        <td>Jornadas</td>
                        <td>Fecha de inicio</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($players as $player )
                    <tr>
                        <td>{{ $player->id }}</td>
                        <td>{{ $player->name }}</td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
