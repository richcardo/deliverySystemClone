<x-layout>

<div class="row justify-content-start px-0">
        <x-menu-rider/>
        <div class="col-8 col-sm-8 col-md-8 m-3">

            <div class="container">
                <div class="row justify-content-start m-3">
                    <div class="col-8">
                        <div class="mb-3">
                            <div class="text-start mb-3 d-flex w-75 justify-content-between">
                                <a class="btn-orange text-decoration-none p-2" href="{{ route('riders.index') }}">Riders</a>
                                <a class="btn-orange text-decoration-none p-2" href="{{ route('delivery.index') }}">Consegne</a>
                            </div>
                            <h1>{{ $rider->name }} {{ $rider->surname }}</h1>
                        </div>
                        <div class="card text-orange font-cabin fs-4 z-0 m-2 shadow container p-2 " >
                                <div class="row justify-content-start">
                                    <div class="col-11">
                                        <div class="m-3">
                                            <h4>Consegne</h4>
                                        </div>
                                        
                                        <table class="table m-3">
                                            <thead>
                                                <tr>
                                                    <th class="col">Indirizzo</th>
                                                    <th class="col">Nome</th>
                                                    <th class="col">Totale</th>
                                                    <th class="col">Pos</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rider->deliveries as $delivery)
                                                    <tr>
                                                        <td class="text-orange">{{ $delivery->address }}</td>
                                                        <td>{{ $delivery->name }}</td>
                                                        <td class="text-orange">{{  Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</td>
                                                        <td>
                                                            @if($delivery->pos)
                                                                <span class="badge text-bg-success">Si</span>
                                                            @else
                                                                <span class="badge text-bg-danger">No</span>
                                                            @endif
                                                           
                                                        </td>
                                                        <td><a class="btn btn-secondary btn-sm" href="{{ route('delivery.edit', ['delivery'=> $delivery, 'condition'=>'rider', 'rider' => $rider]) }}">Modifica</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                     <div class="col-4">
                                        <div class="card p-3 text-orange shadow m-3">
                                            <h2 class="fs-4">Totale da rendere : <h2 class="fs-3">{{ Number::currency($total , in: 'EUR', locale: 'it') }}</h2></h2>
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