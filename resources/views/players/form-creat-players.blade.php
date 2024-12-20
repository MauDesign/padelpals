<div class="form-floating form-floating-outline">
        <input type="text" name="Name" class="form-control" id="Name" aria-describedby="Name" value="{{ old('Name', isset($player) ? $player->Name : '') }}" />
        <label for="Name">Nombre</label>
        <div class="NameHelp" class="form-text">
            @error('Name')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Surname" class="form-control" id="Surname" aria-describedby="Surname" value="{{old('Surname', isset($player) ? $player->Surname : '')}}" />
        <label for="Surname">Apellido</label>
        <div class="SurnameHelp" class="form-text">
            @error('Surname')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline">
        <input type="text" name="Alias" class="form-control" id="Alias" aria-describedby="Alias" value="{{old('Alias', isset($player) ? $player->Alias : '' )}}" />
        <label for="Alias">Alias</label>
        <div class="AliasHelp" class="form-text">
            @error('Alias')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Email" class="form-control" id="Email" aria-describedby="Email" value="{{old('Email', isset($player) ? $player->Email : '' )}}" />
        <label for="Email">Correo</label>
        <div class="EmailHelp" class="form-text">
            @error('Email')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-floating form-floating-outline mt-4">
        <input type="text" name="Phone" class="form-control" id="Phone" aria-describedby="Phone" value="{{old('Phone', isset($player) ? $player->Phone : '' )}}" />
        <label for="Phone">Celular</label>
        <div class="PhoneHelp" class="form-text">
            @error('Phone')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
