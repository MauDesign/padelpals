<script>
    document.addEventListener('DOMContentLoaded', function() {
        var flatpickrDate = document.querySelector("#flatpickr-date");
            flatpickrDate.flatpickr({
                monthSelectorType: "static"
            });
        })
   </script>

    <div class="form-floating form-floating-outline">
        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" value="{{old('name', $club->name)}}" />
        <label for="name">Nombre</label>
        <div class="nameHelp" class="form-text">
            @error('name')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    div class="form-floating form-floating-outline">
        <input type="text" name="city" class="form-control" id="city" aria-describedby="city" value="{{old('city', $club->city)}}" />
        <label for="city">Ciudad</label>
        <div class="cityHelp" class="form-text">
            @error('city')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline">
        <input type="text" name="email" class="form-control" id="country" aria-describedby="email" value="{{old('email', $club->email)}}" />
        <label for="email">correo</label>
        <div class="emailHelp" class="form-text">
            @error('email')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline">
        <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="{{old('phone', $club->phone)}}" />
        <label for="phone">Teléfono</label>
        <div class="phoneHelp" class="form-text">
            @error('phone')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline">
        <input type="text" name="website" class="form-control" id="website" aria-describedby="website" value="{{old('website', $club->website)}}" />
        <label for="website">Página</label>
        <div class="websiteHelp" class="form-text">
            @error('website')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-floating form-floating-outline">
        <input type="text" name="address" class="form-control" id="address" aria-describedby="address" value="{{old('address', $club->address)}}" />
        <label for="address">Dirección</label>
        <div class="addressHelp" class="form-text">
            @error('address')
            <small style="color:red;">{{ $message }}</small>
            @enderror
        </div>
    </div>
    
    

    

