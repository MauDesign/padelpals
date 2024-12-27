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
        <input type="number" name="courts" class="form-control" id="courts" aria-describedby="courts" min="0" value="{{old('courts', isset($challenge) ? $challenge->courts : '') }}" oninput="calculatePlayers()" />
        <label for="courts">Canchas</label>
        <div class="courtsHelp" class="form-text">
            @error('courts')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-floating form-floating-outline mt-4">
        <input type="number" name="players" class="form-control" id="players" aria-describedby="players" value="{{ old('players', isset($challenge) ? $challenge->no_players : '') }}" readonly />
        <label for="players">Jugadores</label>
        <div class="playersHelp" class="form-text">
            @error('players')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-floating form-floating-outline mt-4">

        <div class="w-full" id="combobox">
          <input
            type="text"
            id="clubInput"
            name="club"
            class="form-control"
            placeholder="Club"
            autocomplete="off"
          />
            <input id="clubInputID" name="clubInputID" style="display: none;"/>
          <ul
            id="dropdown"
            class="list-none absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto"
            style="display: none; list-style-type: none;">
          </ul>
        </div>

        <div class="clubHelp" class="form-text">
            @error('clubs')
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

    <script>
        const clubInput = document.getElementById('clubInput');
        const clubInputID = document.getElementById('clubInputID');
        const dropdown = document.getElementById('dropdown');
        let inputValue = '';
        let filteredOptions = [];
        let isOpen = false;

        clubInput.addEventListener('input', handleInputChange);

        document.addEventListener('mousedown', (event) => {
            const combobox = document.getElementById('combobox');
            if (!combobox.contains(event.target)) {
                setIsOpen(false);
            }
        });

        function handleInputChange(e) {
            const value = e.target.value;
            inputValue = value;

            // Verificamos si el valor tiene más de 3 caracteres
            if (value.length >= 2) {
                // Hacer la solicitud AJAX al backend para obtener las opciones filtradas
                fetch(`/api/clubs/list?search=${value}`)
                    .then(response => response.json())
                    .then(data => {
                        filteredOptions = data.map(option => option);  // Extraer el nombre de las opciones
                        setIsOpen(true);
                        renderDropdown();
                    })
                    .catch(error => console.error('Error fetching options:', error));
            } else {
                // Si el valor tiene 3 o menos caracteres, no mostrar el dropdown
                setIsOpen(false);
            }
        }

        function handleOptionSelect(option) {
            clubInput.value = option.name;
            clubInputID.value = option.id;
            setIsOpen(false);
            renderDropdown();
        }

        function setIsOpen(open) {
            isOpen = open;
            dropdown.style.display = open && filteredOptions.length > 0 ? 'block' : 'none';
        }

        function renderDropdown() {
            dropdown.innerHTML = '';
            filteredOptions.forEach(option => {
                const listItem = document.createElement('li');
                listItem.textContent = option.name;
                listItem.addEventListener('click', () => handleOptionSelect(option));
                listItem.classList.add('px-4', 'py-2', 'text-gray-700', 'hover:bg-blue-100', 'cursor-pointer');
                dropdown.appendChild(listItem);
            });
        }
    </script>
