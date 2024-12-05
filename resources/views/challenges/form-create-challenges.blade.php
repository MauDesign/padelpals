<script>
    document.addEventListener('DOMContentLoaded', function() {
    var flatpickrDate = document.querySelector("#flatpickr-date");
    flatpickrDate.flatpickr({
        monthSelectorType: "static"
    });

    var flatpickrTime = document.querySelector("#flatpickr-time");
    flatpickrTime.flatpickr({ 
        enableTime: true,
        noCalendar: true
    });
});
   </script>

    <div class="form-floating form-floating-outline">
        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{old('name', isset($challenge) ? $challenge->name : '') }}" />
        <label for="name">Nombre</label>
        <div class="nameHelp" class="form-text">
            @error('name')
            <small style="color:red;">{{ $message }}</small>
            @enderror 
        </div> 
    </div>
    <div class="form-floating form-floating-    outline mt-4">
        <input  id="flatpickr-date" name="date" class="form-control" type="text" value="{{old('date', isset($challenge) ? $challenge->date : '')}}" style="z-index: 1110;"  > </input>
        <label for="flatpickr-date"> Fecha</label>
        <div id="flatpickr-dateHelp" class="form-text">
            @error('date')
            <small style="color:red;">{{ $message }}</small>
             @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input  id="flatpickr-time" name="time"  placeholder="HH:MM" class="form-control" type="text" value="{{old('time', isset($challenge) ? $challenge->time : '') }}" style="z-index: 1110;"  > </input>
        <label for="flatpickr-time"> Hora</label>
        <div id="flatpickr-timeHelp" class="form-text">
            @error('time')
            <small style="color:red;">{{ $message }}</small>
             @enderror
        </div>
    </div>

    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="courts" class="form-control" id="courts" aria-describedby="courts" value="{{old('courts', isset($challenge) ? $challenge->courts : '') }}" oninput="calculatePlayers()" />
        <label for="courts">Canchas</label>
        <div class="courtsHelp" class="form-text">
            @error('courts')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="players" class="form-control" id="players" aria-describedby="players" value="{{ old('players', isset($challenge) ? $challenge->no_players : '') }}" readonly />
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


    

