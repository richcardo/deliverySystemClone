<x-layout>

<div class="container-fluid">
    <div class="row justify-content-start px-0">
            <div class="col-12 col-sm-8 col-md-8 m-3 mt-5">
                    <h1 class="">Aggiungi una nuova Consegna</h1>
                    <div class="card text-orange font-cabin z-0 m-3 shadow " >
                        <div class="text-center w-100">
                            <img class="img-fluid img-style-form ms-5" src="https://sustampupizzeria.com/wp-content/uploads/2023/12/rider-su-stampu.svg" class="card-img-top" alt="...">
                        </div>

                        
                        
                        <div id="loadingMessage" hidden="">⌛ Loading video...</div>
                        <canvas hidden id="canvas" height="480" width="640"></canvas>
                        <div id="output">
                            <div id="outputMessage">No QR code detected.</div>
                            <div hidden="true"><b>Data:</b> <span id="outputData"></span></div>
                        </div>
                        <div class="card-body">
                            @if(session()->has('success'))
                                <div class="alert alert-style-success" role="alert">
                                {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('delivery.store', 'deliveries') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="label-form" for="name">Nome o Cognome</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                                    @error('name')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="address">Indirizzo</label>
                                    <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
                                    @error('address')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="number">Numero di telefono</label>
                                    <input class="form-control" type="text" name="number" id="number" value="{{ old('number') }}">
                                    @error('number')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="label-form" for="price"> Totale € </label>
                                    <input class="form-control" type="number" name="price" id="price" min="0" step="0.01" value="{{ old('price') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="pos" class="label-form">Pos</label>
                                </div>
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="pos" id="pos" value="{{ true }}">
                                    <label class="form-check-label" for="pos">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pos" id="pos" value="{{ false }}">
                                    <label class="form-check-label" for="pos">
                                        No
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="rider_id" class="label-form">Scegli rider (Non obbligatorio)</label>
                                    <select class="form-select" name="rider_id" id="rider_id">
                                        <option value="">Scegli Rider</option>
                                        @foreach($riders as $rider)
                                            <option value="{{ $rider->id }}">{{ $rider->name }} - {{ $rider->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn-orange fs-4" type="submit">Aggiungi consegna</button>
                                </div>

                            </form>
                        </div>
                    </div>
            </div>
    </div>
</div>


</x-layout>
