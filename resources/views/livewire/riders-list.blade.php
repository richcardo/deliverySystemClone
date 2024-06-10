
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-12">
                <table class="table table-custom">
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
                            <tr class="text-orange\">
                                <td class="">{{ $rider->name }}</td>
                                <td class="text-orange">{{ $rider->surname }}</td>
                                <td>{{ $rider->number }}</td>
                                <td class="text-orange">{{ $rider->transport }}</td>
                                <td>{{ Number::currency($rider->fuel , in: 'EUR', locale: 'it') }}</td>
                                <td class="">
                                {{ $rider->deliveries->count() }}
                                </td>
                                <td class="text-orange">{{ Number::currency($rider->total , in: 'EUR', locale: 'it') }}</td>
                                <td class=""><a class="btn btn-sm btn-primary " href="{{ route('rider.profile', $rider) }}">Profilo</a></td>
                                <td class="w-100">
                                    <a class="btn btn-sm btn-secondary me-2" href="{{ route('rider.edit', $rider) }}">modifica</a>
                                    <form class="d-inline " action="{{ route('rider.destroy', $rider) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger uppercased" type="submit">elimina</button>
                                    </form>
                                    <a class="btn btn-sm btn-warning mt-2 mt-xxl-0" href="{{ route('delivery.rider.create', $rider)}}">Aggiungi consegna</a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>



