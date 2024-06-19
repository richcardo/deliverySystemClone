
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-10 col-sm-10 col-md-10">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th class="col">Nome</th>
                            <th class="col">Cognome</th>
                            <th class="col">Telefono</th>
                            <th class="col">Trasporto</th>
                            <th class="col">Rimborso</th>
                            <th class="col">Consegne</th>
                            <th class="col">Totale</th>
                            <th class="col">Distanza percorsa</th>
                            <th class="col"></th>
                            <th class="col"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-orange position-relative">
                        @foreach($riders as $rider)
                        <div class="mb-3">
                                <div class="modale" id="modale-rider" style="display: none;">
                                    <div class="testo1">
                                        <p>Vuoi Davvero cancellare il Rider ?</p>
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
                        </div>
                            <tr class="text-orange\">
                                <td class="">{{ $rider->name }}</td>
                                <td class="text-orange">{{ $rider->surname }}</td>
                                <td>{{ $rider->number }}</td>
                                <td class="text-orange">{{ $rider->transport }}</td>
                                <td>{{ Number::currency($rider->fuel , in: 'EUR', locale: 'it') }}</td>
                                <td class="text-orange">
                                {{ $rider->deliveries->count() }}
                                </td>
                                <td >{{ Number::currency($rider->total , in: 'EUR', locale: 'it') }}</td>
                                <td class="text-orange">{{ round($rider->total_distance,1) }} Km</td>
                                <td class=""><a class="btn btn-sm btn-primary " href="{{ route('rider.profile', $rider) }}">Profilo</a></td>
                                <td class="w-100">
                                    <a class="btn btn-sm btn-secondary me-2" href="{{ route('rider.edit', $rider) }}">modifica</a>
                                    <button class="btn btn-sm btn-danger mt-2 mt-xxl-0  uppercased" data-action="{{ route('rider.destroy', $rider ) }}" onclick="displayModaleRider()" id="delete-rider">Elimina</button>
                                </td>
                                <td><a class="btn btn-sm btn-warning mt-xxl-0" href="{{ route('delivery.rider.create', $rider)}}">Aggiungi Consegna</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>



