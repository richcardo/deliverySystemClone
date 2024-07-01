<x-layout2>
<div class="container-fluid">
    <div class="row justify-content-start px-0">
            <div class="col-6 col-sm-6 col-md-6 m-3">
                    <h1 class="m-3">Modifica Consegna</h1>
                    <div class="card text-orange font-cabin fs-4 z-0 m-3 shadow " >
                        <img class="img-fluid img-style-form ms-5" src="https://sustampupizzeria.com/wp-content/uploads/2023/12/rider-su-stampu.svg" class="card-img-top" alt="...">   
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-style-success" role="alert">
                                {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('delivery.update', ['delivery'=> $delivery, 'condition'=> $condition, 'rider2'=> $rider ] ) }}"  method="POST">
                                @csrf
                                @method('PUT')  
                                <div class="mb-3">
                                    <label class="label-form" for="name">Nome o Cognome</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $delivery->name)  }}">
                                    @error('name')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                    <input type="text" name="origin"  id="origin-input" hidden>
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="address">Indirizzo</label>
                                    <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $delivery->address) }}">
                                    @error('address')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="number">Numero di telefono</label>
                                    <input class="form-control" type="text" name="number" id="number" value="{{ old('number', $delivery->number) }}">
                                    @error('number')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="price"> Totale € </label>
                                    <input class="form-control" type="number" name="price" id="price" min="0" step="0.01" value="{{ old('price', $delivery->price) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="pos" class="label-form">Pos</label>
                                <div class="form-check">
                                    
                                    <input @if($delivery->pos == true) checked @endif class="form-check-input" type="radio" name="pos" id="pos" value="{{ true }}">
                                    <label class="form-check-label" for="pos">
                                        Si
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input @if($delivery->pos == false) checked @endif class="form-check-input" type="radio" name="pos" id="pos" value="{{ false }}">
                                    <label class="form-check-label" for="pos">
                                        No
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="rider_id" class="label-form">Modifica rider (Non obbligatorio)</label>
                                    <select class="form-select" name="rider_id" id="rider_id">
                                        @foreach($riders as $rider)
                                            <option @if(isset($delivery->rider->id)) @if($delivery->rider->id == $rider->id) selected @endif @endif value="{{ $rider->id }}">{{ $rider->name }} - {{ $rider->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn-orange fs-4" type="submit">Modifica consegna</button>
                                </div>

                            </form>
                        </div>
                    </div>
            </div>
    </div>

</div>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY&callback=initMap&v=weekly"
      defer
    ></script>

</x-layout2>

