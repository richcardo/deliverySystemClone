<x-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 mt-5">
                <div class="card shadow-sm p-3">
                    <div class="mb-2">
                        <a class="btn btn-sm btn-secondary w-25"
                            href="{{ route('rider.profile', $rider) }}">Indietro</a>
                    </div>

                    <h4>Stai chiudendo il conto di <span class="text-orange">{{ $rider->name }}
                            {{ $rider->surname }}</span></h4>
                    <div class="my-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Indirizzo</th>
                                    <th>Nome</th>
                                    <th>Prezzo</th>
                                    <th>Pos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rider->deliveries as $delivery)
                                    <tr>
                                        <td>{{ $delivery->address }}</td>
                                        <td>{{ $delivery->name }}</td>
                                        <td>{{ $delivery->price }}</td>
                                        <td>
                                            @if($delivery->pos)
                                                <span class="badge text-bg-success ">SI</span>
                                            @else
                                                <span class="badge text-bg-danger">No</span>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <div class="card p-3">
                                <p>Numero consegne : <span class="text-orange">{{ $rider->deliveries->count() }}</span></p>
                                <p >Totale : <span class="text-orange">{{ Number::currency($rider->total, in: 'EUR', locale: 'de') }}</span></p>
                                <p>Totale pos : <span class="text-orange">{{ Number::currency($pos, in: 'EUR', locale: 'de') }}</span> </p>
                                <p>Distanza percorsa : <span class="text-orange">{{ round($rider->total_distance,1)}} km</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>