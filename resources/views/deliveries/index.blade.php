<x-layout2>
<div class="container">
        <div class="row justify-content-start ">
                <div class="col-9 col-sm-10 col-md-10 m-5">
                        <div class="container">
                                <div class="row d-none d-lg-block justify-content-start">
                                        <div class="mb-3">
                                                <h3 id="title">Elenco consegne</h3>
                                                @if(session()->has('success'))
                                                        <div class="alert alert-style-success text-orange" role="alert">
                                                        {{ session('success') }}
                                                        </div>
                                                @endif  
                                        </div>
                                        <table class="table-custom table">
                                        <thead class="ps-5">
                                                <tr>
                                                <th class="col">Indirizzo</th>
                                                <th class="col">Nome</th>
                                                <th class="col">Totale</th>
                                                <th class="col">Pos</th>
                                                <th class="col">Rider</th>
                                                <th class="col">telefono</th>
                                                <th class="col">distanza[km]</th>
                                                <th class="col"></th>
                                                </tr>
                                        </thead>
                                        <tbody class="ps-5">
                                                @foreach($deliveries as $delivery)
                                                <tr class="text-orange ">
                                                        <td class="text-orange pe-5">{{ $delivery->address}}</td>
                                                        <td>{{ $delivery->name }}</td>
                                                        <td>{{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</td>
                                                        <td>
                                                                @if($delivery->pos)
                                                                        <span class="badge text-bg-success">Si</span>
                                                                @else
                                                                <span class="badge text-bg-danger">No</span>
                                                                @endif
                                                        </td>
                                                        @if(isset($delivery->rider))
                                                        <td class="text-orange "><a class="text-decoration-none text-orange" href="{{ route('rider.profile', $delivery->rider->id) }}">{{ $delivery->rider->name }} {{ $delivery->rider->surname }} </a></td>
                                                        @else
                                                        <td>Da Assegnare</td>
                                                        @endif

                                                        
                                                        <td>{{ $delivery->number }}</td>
                                                        <td>{{ round($delivery->distance,1) }}</td>
                                                        <td class="w-50 text-end">
                                                                <a class="btn btn-sm btn-secondary" href="{{ route('delivery.edit', [ 'delivery' => $delivery , 'condition'=>'delivery', 'rider'=> 0]) }}">modifica</a>
                                                                <form class="d-inline" action="{{ route('delivery.destroy', $delivery ) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-sm btn-danger uppercased mt-2 mt-xxl-0" type="submit">elimina</button>
                                                                </form>
                                                        </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                        </table>
                                        <div class="mb-3">
                                                <form action="{{ route('delivery.destroy.all') }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Elimina tutte le consegne</button>
                                                </form>
                                                
                                        </div>
                                </div>
                                <div class="row d-block d-lg-none justify-content-start">
                                        @foreach($deliveries as $delivery)
                                                <div class="card shadow-sm p-3 my-3">
                                                        <h5>{{ $delivery->address }}</h5> 
                                                        <p>{{ $delivery->number }}</p>
                                                       <div class="mb-3">
                                                                <p>{{ Number::currency($delivery->price , in: 'EUR', locale: 'it') }}</p>
                                                                @if($delivery->rider)
                                                                        <p>{{ $delivery->rider->name }}</p>
                                                                @else
                                                                        <p>Rider Non assegnato</p>
                                                                @endif

                                                                <div id="pos" class="border p-2">
                                                                                <p class="d-inline me-3">Pos:  </p>
                                                                        @if($delivery->pos)
                                                                                <span class="badge text-bg-success m-0">Si</span>
                                                                        @else
                                                                                <span class="badge text-bg-danger mb-2">No</span>
                                                                        @endif

                                                                                <p>Distanza : {{ round($delivery->distance,2) }} Km</p>
                                                                </div>
                                                                <div class="my-2">
                                                                        <a class="btn btn-sm btn-secondary" href="{{ route('delivery.edit', ['delivery' => $delivery , 'condition'=>'delivery', 'rider'=> 0]) }}">Modifica</a>
                                                                <form class="d-inline" action="{{ route('delivery.destroy', $delivery) }}" method="post">
                                                                 @csrf
                                                                 @method('DELETE')
                                                                 <button class="btn btn-sm btn-danger m-0 " type="submit">Elimina</button>       
                                                                
                                                                </form>
                                                                </div>
                                                                
                                                        </div>
                                                </div>
                                        @endforeach
                                </div>
                        </div>
                </div>
                <div class="col-12 m-5">

                <div class="mb-2 w-25">
                                <div class="mb-2">
                                        <label for="" class="form-label">Indirizzo</label>
                                        <input class="form-control d-inline" type="text" id="address">
                                </div>
                                
                                <div class="mb-2">
                                <button onclick="search()" class=" d-inline btn-orange">Cerca</button>  
                                </div>
                </div>
        
                <iframe
                id="map"
                width="800"
                height="500"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY
                &q=Via+Randaccio+18+Cagliari/+/Via+Antonio+Fais+14+Cagliari">
                </iframe>
                </div>
        </div>
</div>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY&loading=async&callback=initMap">
</script>
<script>
        const iframe = document.getElementById('map')
        let destination = document.getElementById('address');
        console.log(iframe.src)
        function search(){
                let address = destination.value;
                iframe.src=`https://www.google.com/maps/embed/v1/place?key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY
                &q=${address}`
        }
</script>
</x-layout2>