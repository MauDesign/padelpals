<x-app-layout>
    <div class="container card">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Challenges
        </h2>
        <div class="filters align-content-end">
            <div class="col-m6"></div>
            <a href="{{route('challenges.create')}}" class="btn btn-primary" >Agregar</a>
        </div>
        <div class="card-datatable table-responsive pt-0 mt-4 mb-4">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Fecha</td>
                        <td>Hora</td>
                        <td>Canchas</td>
                        <td>Jugadores</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($challenges as $challenge )
                    <tr>
                        <td>{{ $challenge->id }}</td>
                        <td>{{ $challenge->name }}</td>
                        <td>{{ $challenge->date }}</td>
                        <td>{{ $challenge->time }}</td>
                        <td>{{ $challenge->courts }}</td>
                        <td>{{ $challenge->no_players }}</td>
                        <td><div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><span class="material-symbols-outlined">more_vert</span></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('challenges.show', $challenge) }}"><span class="material-symbols-outlined">edit</span>Agregar jugadores</a>
                                <a class="dropdown-item" href="{{route('challenges.edit', $challenge) }}"><span class="material-symbols-outlined">edit</span>Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><span class="material-symbols-outlined">delete</span> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
