<x-layout2>
    <div class="container-fluid">
        <div class="row justify-content-start px-0">
            <div class="col-12 col-sm-6 col-md-6 m-5">
                <div class="card px-4 shadow-lg text-orange ">
                    <div class="text-center">
                        <img class="img-fluid img-style-form ms-5"
                            src="https://sustampupizzeria.com/wp-content/uploads/2023/12/rider-su-stampu.svg"
                            class="card-img-top" alt="...">
                    </div>

                    <h3>Crea Rider</h3>
                    <form class="w-50" action="{{ route('riders.store') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label class="form-label" for="name">Nome</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="surname">Cognome</label>
                            <input class="form-control" type="text" name="surname" value="{{ old('surname') }}">
                            @error('surname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="number" class="form-label">Numero</label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}">
                            @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label for="transport">Mezzo di trasporto</label>
                            <select class="form-select" name="transport" id="transport">
                                <option value="">Seleziona</option>
                                <option value="Scooter Azienda">Scooter Aziendale</option>
                                <option value="Scooter Personale">Scooter Personale</option>
                                <option value="Auto Personale">Auto Personale</option>
                            </select>
                            @error('transport') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="fuel">Rimborso</label>
                            <input type="number" class="form-control" min="0" name="fuel" value="{{ old('fuel') }}">
                            @error('fuel') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-2">
                            <button class="btn-orange" type="submit">Crea Rider</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</x-layout2>