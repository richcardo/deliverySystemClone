<x-layout2>

    <div class="row justify-content-start w-100">

        <div class="col-12 col-sm-9 col-md-9 mt-5 ">

            <div class="mb-2">
                <h3 id="title">I tuoi Rider</h3>
                @if(session()->has('success'))
                    <div class="alert alert-style-success text-orange" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="d-none d-lg-block">
                <livewire:riders-list />
            </div>
            <div class="d-block d-lg-none">
                @foreach($riders as $rider)
                    <div class="card shadow-lg p-3 my-4">
                        <h5>{{ $rider->name }} {{ $rider->surname }}</h5>
                        <p>{{ $rider->number }}</p>
                        <div class="mb-3">
                            <p>Trasporto : <span class="text-orange">{{ $rider->transport }}</span></p>
                            <p>Rimborso : <span class="text-orange">{{ Number::currency($rider->fuel, in: 'EUR', locale: 'de') }}</span></p>
                            <p>Totale : <span class="text-orange">{{ Number::currency($rider->total, in: 'EUR', locale: 'de') }}</span></p>
                            <p>Consegne : {{ $rider->deliveries->count() }}</p>
                            <p>Distanza percorsa : {{ $rider->total_distance }} Km</p>
                        </div>
                        <div class="my-2">
                            <a class="btn btn-sm btn-secondary" href="{{ route('rider.edit', $rider)}}">Modifica</a>
                            <form class="d-inline" action="{{ route('rider.destroy', $rider) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger uppercased" type="submit">Elimina</button>
                            </form>
                        </div>
                        <div class="my-2">
                            <a class="btn btn-primary" href="{{ route('rider.profile', $rider) }}">Account</a>
                            <a class="btn btn-warning" href="{{ route('delivery.rider.create', $rider) }}">Aggiungi consegna</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <script>
        var modaleRider = document.getElementById('modale-rider')
        var btnsDeleteRider = document.querySelectorAll('#delete-rider')
        var deleteForm = document.getElementById('form-delete')

        console.log(btnsDeleteRider)
        function displayModaleRider() {

            if (modaleRider.style.display == 'none') {
                modaleRider.style.display = 'block'
            } else {
                modaleRider.style.display = 'none'
            }

        }

        for (btn of btnsDeleteRider) {
            btn.addEventListener('click', e => {
                const action = e.target.getAttribute('data-action');
                deleteForm.setAttribute('action', action)
            })
        }

    </script>
</x-layout2>