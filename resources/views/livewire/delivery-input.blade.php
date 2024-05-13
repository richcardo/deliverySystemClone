<div>
    <div class="mb-4 w-50">
            <label class="form-label" for="">Cerca per Indirizzo o Nome</label>
            <input class="form-control" wire:model.live="input" type="text">
    </div>

    <table class="table fs-5">
                                <thead>
                                        <tr>
                                        <th class="col">Indirizzo</th>
                                        <th class="col">Nome</th>
                                        <th class="col">Totale</th>
                                        <th class="col">Pos</th>
                                        <th class="col">Rider</th>
                                        <th class="col">Numero di telefono</th>
                                        <th class="col"></th>
                                        </tr>
                                </thead>
                                <tbody class="text-orange">
                                        @foreach($deliveries as $delivery)
                                        <tr class="text-orange">
                                                <td class="text-orange">{{ $delivery->address}}</td>
                                                <td>{{ $delivery->name }}</td>
                                                <td class="text-orange">{{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</td>
                                                <td>
                                                        @if($delivery->pos)
                                                                <span class="badge text-bg-success">Si</span>
                                                        @else
                                                        <span class="badge text-bg-danger">No</span>
                                                        @endif
                                                </td>
                                                <td class="text-orange fs-5"><a class="text-decoration-none text-orange" href="{{ route('rider.profile', $delivery->rider->id) }}">{{ $delivery->rider->name }} {{ $delivery->rider->surname }}</a></td>

                                                
                                                <td>{{ $delivery->number }}</td>
                                                <td>
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('delivery.edit', $delivery)}}">modifica</a>
                                                        <form class="d-inline" action="{{ route('delivery.destroy', $delivery) }}" method="POST">
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
