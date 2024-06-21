<x-layout>
    <div class="container-fluid m-0">

        <div class="modale" id="modale-rider" style="display: none;">
            <div class="testo1">
                <p class="text-orange">Vuoi Davvero cancellare il Rider ?</p>
            </div>
            <div class="options">
                <button onclick="displayModaleRider()" class="btn btn-sm btn-primary">No!</button>
                <form action="" method="POST" id="form-delete">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-start px-0">
            <div class="col-12 col-sm-12 col-md-12 m-3">

                <div class="container">
                    <div class="row justify-content-start m-3">
                        <div class="col-12">
                            <div class="mb-3">

                                <h1>{{ $rider->name }} {{ $rider->surname }}</h1>

                            </div>
                            <div class="card text-orange font-cabin fs-4 z-0 m-2 shadow container p-2 ">
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-11">
                                            <div class="m-3">
                                                @if(session()->has('success'))
                                                    <div class="alert alert-style-success" role="alert">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                                <h4>Consegne</h4>
                                                <a class="btn btn-warning"
                                                    href="{{ route('delivery.rider.create', $rider) }}">Aggiungi
                                                    consegna</a>
                                            </div>
                                            <table class="table table-custom">
                                                <thead>
                                                    <tr>
                                                        <th class="col">Indirizzo</th>
                                                        <th class="col">Nome</th>
                                                        <th class="col">Totale</th>
                                                        <th class="col">Pos</th>
                                                        <th>Distanza</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rider->deliveries as $delivery)

                                                        <tr class="position-relative
                                                        ">
                                                            <div class="modale" id="modale" style="display: none;">
                                                                <div class="testo1">
                                                                    <p class="text-orange">Vuoi Davvero cancellare la
                                                                        consegna?
                                                                    </p>
                                                                </div>
                                                                <div class="options">
                                                                    <button onclick="displayModale()"
                                                                        class="btn btn-sm btn-primary">No!</button>
                                                                    <form action="" method="POST" id="form-delete">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-sm btn-danger"
                                                                            type="submit">Elimina</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <td class="text-orange">{{ $delivery->address }}</td>
                                                            <td>{{ $delivery->name }}</td>
                                                            <td class="text-orange">
                                                                {{  Number::currency($delivery->price, in: 'EUR', locale: 'it') }}
                                                            </td>

                                                            <td>
                                                                @if($delivery->pos)
                                                                    <span class="badge text-bg-success">Si</span>
                                                                @else
                                                                    <span class="badge text-bg-danger">No</span>
                                                                @endif

                                                            </td>
                                                            <td>{{ round($delivery->distance, 1) }}</td>
                                                            <td class="w-50 text-end">
                                                                <a class="btn btn-secondary btn-sm "
                                                                    href="{{ route('delivery.edit', ['delivery' => $delivery, 'condition' => 'rider', 'rider' => $rider]) }}">Modifica</a>
                                                                <button onclick="displayModale()"
                                                                    class="btn btn-danger btn-sm d-inline "
                                                                    data-action="{{ route('delivery.destroy', $delivery) }}"
                                                                    id="btn-delete">ELIMINA</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-12">
                                            <div class="card p-3 text-orange shadow m-3">
                                                <h2 class=>Totale da rendere : <h2 class="text-black">
                                                        {{ Number::currency($total, in: 'EUR', locale: 'it') }}
                                                    </h2>
                                                </h2>
                                                <h3>Distanza totale percorsa : <p class="text-black">
                                                        {{ round($rider->total_distance, 1) }} Km
                                                    </p>
                                                </h3>
                                            </div>
                                            <div class="containerr">
                                                <div class="row justify-content-between">
                                                    <div class="col-6">
                                                        <div class="mb-2">
                                                            <a class="btn btn-danger"
                                                                href="{{ route('count.closing', $rider) }}">Chiudi il
                                                                conto</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>


</x-layout>