<script>
    document.addEventListener('DOMContentLoaded', function() {
        var flatpickrDate = document.querySelector("#flatpickr-date");
            flatpickrDate.flatpickr({
                monthSelectorType: "static"
            });
        })
   </script>

    <div class="form-floating form-floating-outline">
        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{old('name', $league->name)}}" />
        <label for="name">Nombre</label>
        <div class="nameHelp" class="form-text">
            @error('name')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="courts" class="form-control" id="courts" aria-describedby="courts" value="{{old('courts', $league->courts)}}" oninput="calculatePlayers()" />
        <label for="courts">Canchas</label>
        <div class="courtsHelp" class="form-text">
            @error('courts')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="players" class="form-control" id="players" aria-describedby="players" value="{{ old('players', $league->players) }}" readonly />
        <label for="players">Jugadores</label>
        <div class="playersHelp" class="form-text">
            @error('players')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <script>
    function calculatePlayers() {
        const courtsInput = document.getElementById('courts');
        const courtsValue = parseInt(courtsInput.value) || 0;

        const playersValue = courtsValue * 4;

        const playersInput = document.getElementById('players');
        playersInput.value = playersValue;
    }
</script>

    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="rounds" class="form-control" id="rounds" aria-describedby="rounds" value="{{old('rounds', $league->rounds)}}" />
        <label for="rounds">Jornadas</label>
        <div class="roundsHelp" class="form-text">
            @error('rounds')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input  id="flatpickr-date" name="start_date" class="form-control" type="text" value="{{old('start_date', $league->start_date)}}" style="z-index: 1110;"  > </input>
        <label for="flatpickr-date"> Fecha Inicio</label>
        <div id="flatpickr-dateHelp" class="form-text">
            @error('start_date')
            <small style="color:red;">{{ $message }}</small>
             @enderror
        </div>
    </div>

