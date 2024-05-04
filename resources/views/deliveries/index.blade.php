<x-layout>

<div class="row justify-content-start px-0">
        <x-menu-delivery/>
        <div class="col-6 col-sm-6 col-md-6 m-5">
                <div class="container">
                        <div class="row justify-content-start">
                                <div class="mb-3">
                                        <h1>Elenco consegne</h1>
                                        <div class="d-flex m-2 justify-content-center">
                                                <button class="btn-orange me-3">Aggiungi Consegna</button>
                                                <button class="btn-orange me-3">Cerca Consegna</button>
                                        </div>    
                                </div>
                                <table class="table">
                                <thead>
                                        <tr>
                                        <th class="col">#</th>
                                        <th class="col">Nome</th>
                                        <th class="col">Indirizzo</th>
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
                                                <td class="text-orange">{{ $delivery->id }}</td>
                                                <td>{{ $delivery->name }}</td>
                                                <td class="text-orange">{{ $delivery->address}}</td>
                                                <td>{{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</td>
                                                <td>
                                                        @if($delivery->pos)
                                                                <span class="badge text-bg-success">Si</span>
                                                        @else
                                                        <span class="badge text-bg-danger">No</span>
                                                        @endif
                                                </td>
                                                <td class="text-orange fs-5">{{ $delivery->rider->name }} {{ $delivery->rider->surname }}</td>

                                                
                                                <td>{{ $delivery->number }}</td>
                                                <td>
                                                        <a class="btn btn-sm btn-secondary" href="">modifica</a>
                                                        <form class="d-inline" action="" method="POST">
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
</div>

</x-layout>