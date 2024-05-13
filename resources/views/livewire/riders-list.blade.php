
<div class="container">
    <div class="row justify-content-start">
        <div class="col-12">
                <table class="table fs-4">
                    <thead>
                        <tr>
                            <th class="col">Nome</th>
                            <th class="col">Cognome</th>
                            <th class="col">Numero di telefono</th>
                            <th class="col">Mezzo di trasporto</th>
                            <th class="col">Rimborso</th>
                            <th class="col">Consegne</th>
                            <th class="col">Totale</th>
                            <th class="col"></th>
                            <th class="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-orange">
                        @foreach($riders as $rider)
                            <tr class="text-orange">
                                <td>{{ $rider->name }}</td>
                                <td class="text-orange">{{ $rider->surname }}</td>
                                <td>{{ $rider->number }}</td>
                                <td class="text-orange">{{ $rider->transport }}</td>
                                <td>{{ Number::currency($rider->fuel , in: 'EUR', locale: 'it') }}</td>
                                <td class="w-50 fs-6">
                                    <ul class="list-group">
                                        @foreach($rider->deliveries as $delivery)
                                            <li class="list-group-item">{{ $delivery->address }} {{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}<a class="btn btn-secondary btn-sm m-2 " href="{{ route('delivery.edit', [ 'delivery' => $delivery , 'condition'=>'rider', 'rider'=> 0 ]) }}"> Modifica </a></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-orange">{{ Number::currency($rider->total , in: 'EUR', locale: 'it') }}</td>
                                <td class=""><a class="btn btn-sm btn-primary " href="{{ route('rider.profile', $rider) }}">Profilo</a></td>
                                <td class="w-75">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('rider.edit', $rider) }}">modifica</a>
                                    <form class="d-inline" action="{{ route('rider.destroy', $rider) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger uppercased" type="submit">elimina</button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>



