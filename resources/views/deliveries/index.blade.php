<x-layout>
<div class="container-fluid">
        <div class="row justify-content-start px-0">
                <div class="col-10 col-sm-10 col-md-10 m-5">
                        <div class="container">
                                <div class="row justify-content-start">
                                        <div class="mb-3">
                                                <h3 id="title">Elenco consegne</h3>
                                                @if(session()->has('success'))
                                                <div class="alert alert-style-success" role="alert">
                                                {{ session('success') }}
                                                </div>
                                                @endif  
                                        </div>
                                        <table class="table table-custom">
                                        <thead>
                                                <tr>
                                                <th class="col">Indirizzo</th>
                                                <th class="col">Nome</th>
                                                <th class="col">Totale</th>
                                                <th class="col">Pos</th>
                                                <th class="col">Rider</th>
                                                <th class="col">telefono</th>
                                                <th class="col"></th>
                                                </tr>
                                        </thead>
                                        <tbody class="text-orange">
                                                @foreach($deliveries as $delivery)
                                                <tr class="text-orange">
                                                        <td class="text-orange">{{ $delivery->address}}</td>
                                                        <td>{{ $delivery->name }}</td>
                                                        <td>{{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</td>
                                                        <td>
                                                                @if($delivery->pos)
                                                                        <span class="badge text-bg-success">Si</span>
                                                                @else
                                                                <span class="badge text-bg-danger">No</span>
                                                                @endif
                                                        </td>
                                                        <td class="text-orange "><a class="text-decoration-none text-orange" href="{{ route('rider.profile', $delivery->rider->id) }}">{{ $delivery->rider->name }} {{ $delivery->rider->surname }}</a></td>

                                                        
                                                        <td>{{ $delivery->number }}</td>
                                                        <td class="w-50 text-end">
                                                                <a class="btn btn-sm btn-secondary" href="{{ route('delivery.edit', [ 'delivery' => $delivery , 'condition'=>'delivery', 'rider'=> 0]) }}">modifica</a>
                                                                <form class="d-inline" action="{{ route('delivery.destroy', $delivery ) }}" method="POST">
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
</div>


</x-layout>