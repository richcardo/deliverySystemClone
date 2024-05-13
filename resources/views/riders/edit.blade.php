<x-layout>

<div class="row justify-content-start px-0">
        <x-menu-rider/>
        <div class="col-6 col-sm-6 col-md-6 m-5">
        <div class="card text-orange font-cabin fs-4 z-0 m-5 shadow " >
  <img class="img-fluid img-style-form ms-5" src="https://sustampupizzeria.com/wp-content/uploads/2023/12/rider-su-stampu.svg" class="card-img-top" alt="...">   
  <div class="card-body">
    @if(session()->has('success'))
        <div class="alert alert-style-success" role="alert">
           {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('rider.update', $rider) }}" method="POST">  
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="label-form" for="name">Nome</label>
            <input class="form-control" id="name" name="name" type="text" value="{{ $rider->name }}">
            @error('name') <span class="text-danger fs-6">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="label-form" for="surname">Cognome</label>
            <input class="form-control" id="surname" name="surname"  type="text" value="{{ $rider->surname }}">
            @error('surname')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="label-form" for="number">Numero di telefono</label>
            <input class="form-control"  id="number" name="number"  type="text" value="{{ $rider->number }}">
        </div>
        <div class="mb-3">
            <label class="label-form" for="transport">Mezzo di trasporto</label>
            <select  id="transport" name="transport"  class="form-control" name="transport" id="transport">
                <option @if($rider->transport == 'Scooter azienda') selected @endif value="Scooter azienda">Scooter Aziendale</option>
                <option  @if($rider->transport == 'Scooter personale') selected @endif value="Scooter personale">Scooter personale</option>
                <option @if($rider->transport == 'Auto personale') selected @endif value="Auto personale">Auto personale</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="label-form" for="fuel">Rimborso benzina</label>
            <input id="fuel" name="fuel" class="form-control" type="number" min="0" step="1" value="{{ $rider->fuel }}">
        </div>
        <div class="mb-3">
            <button class="btn-orange fs-4" type="submit">Modifica Rider</button>
        </div>

    </form>
  </div>
</div>
        </div>
</div>

</x-layout>