<div class="card text-orange font-cabin z-0  shadow " >
  <img class="img-fluid img-style-form ms-5" src="https://sustampupizzeria.com/wp-content/uploads/2023/12/rider-su-stampu.svg" class="card-img-top" alt="...">   
  <div class="card-body">
    @if(session()->has('success'))
        <div class="alert alert-style-success" role="alert">
           {{ session('success') }}
        </div>
    @endif
    <form wire:submit="create()">  
        <div class="mb-3">
            <label class="label-form" for="name">Nome</label>
            <input wire:model.live="name" class="form-control" type="text">
            @error('name')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="label-form" for="surname">Cognome</label>
            <input wire:model.live="surname" class="form-control" type="text">
            @error('surname')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="label-form" for="number">Numero di telefono</label>
            <input wire:model.live="number" class="form-control" type="text">
        </div>
        <div class="mb-3">
            <label class="label-form" for="transport">Mezzo di trasporto</label>
            <select wire:model.live="transport" class="form-control" name="transport" id="transport">
                <option @if($rider_Id) @if($rider->transport == 'Scooter azienda') selected @endif @endif value="Scooter azienda">Scooter Aziendale</option>
                <option @if($rider_Id) @if($rider->transport == 'Scooter personale') selected @endif @endif value="Scooter personale">Scooter personale</option>
                <option @if($rider_Id) @if($rider->transport == 'Auto personale') selected @endif @endif value="Auto personale">Auto personale</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="label-form" for="fuel">Rimborso benzina</label>
            <input wire:model.live="fuel" class="form-control" type="number" min="0" step="1">
        </div>
        <div class="mb-3">
            <button class="btn-orange fs-4" type="submit">Aggiungi Rider</button>
        </div>

    </form>
  </div>
</div>