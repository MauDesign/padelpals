<x-app-layout>
<div class="container card">
@csrf @method('PATCH')
    //Show the league name and information and under the info de form to add players and the list of the player alredy added
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Agregar jugadores a la liga {{ $league->Name }}
    </h2>
    <div class="filters align-content-end">
        <div class="col-m6"></div>
        <a href="{{route('leagues.index')}}" class="btn btn-primary" >Regresar</a>
    </div>
    <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
        <table class="datatables-basic table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player )
                <tr>
                    <td>{{ $player->id }}</td>
                    <td>{{ $player->Nome }}</td>
                    <td>{{ $player->Surname }}</td>
                    <td>{{ $player->Email }}</td>
                    <td>{{ $player->Phone }}</td>
                    <td><div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><span class="material-symbols-outlined">more_vert</span></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('players.edit', $player) }}"><span class="material-symbols-outlined">edit</span>Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="material-symbols-outlined">delete</span> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
</x-app-layout>
