
<div class="container">
    <div class="row justify-content-start">
        <table class="table">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Nome</th>
                    <th class="col">Cognome</th>
                    <th class="col">Numero di telefono</th>
                    <th class="col">Mezzo di trasporto</th>
                    <th class="col">Rimborso</th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody class="text-orange">
                @foreach($riders as $rider)
                    <tr class="text-orange">
                        <td class="text-orange">{{ $rider->id }}</td>
                        <td>{{ $rider->name }}</td>
                        <td class="text-orange">{{ $rider->surname }}</td>
                        <td>{{ $rider->number }}</td>
                        <td class="text-orange">{{ $rider->transport }}</td>
                        <td>{{ Number::currency($rider->fuel , in: 'EUR', locale: 'it') }}</td>
                        <td>
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



