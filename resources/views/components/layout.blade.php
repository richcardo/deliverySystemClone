<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? config('app.name')}}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>
<body>
<div class="container-fluid" >
        <div class="row">
                <div class="col-2 col-sm-2 bg-nero menu-custom">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <h2 class="ps-2">Menu</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-end container-list p-0">
                            <ul class="ul-menu pt-5">
                                <li onclick="FixHover('riders')" class="hover-li riders" id="riders"><a class="text-decoration-none" href="{{ route('riders.index') }}">Riders</a></li>
                                <li onclick="FixHover('deliveries')" class="hover-li deliveries" id="deliveries"><a class="text-decoration-none" href="{{ route('delivery.index') }}">Deliveries</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-10 p-0 ">

                        <nav class="nav">
                            <div>
                                 <h2>Su Stampu delivery system</h2>
                            </div>
                            @auth
                            <ul class="ul-user">
                                <li class="li-register" onclick="toggleMenu()">
                                    @if(auth()->check())
                                    {{ auth()->user()->name }} <span class="material-symbols-outlined">
                                                                arrow_drop_down
                                                                </span>
                                    @endif
                                 </li>
                                 
                                <ul class="ul-dropdown" style="display:none" id="dropdownMenu">
                                    <li class="dropdown-item-custom ">
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button type="submit">Esci</button>
                                        </form>
                                    </li>
                                    @if(auth()->check() && auth()->user()->is_admin)
                                    <li class="dropdown-item-custom menu-admin-item "><a clasS="text-decoration-none" href="{{ route('user.index') }}">Menu admin</a></li>
                                    <li class="dropdown-item-custom menu-admin-item "><a clasS="text-decoration-none" href="{{ route('user.create') }}">Crea User</a></li>
                                    @endif
                                </ul>
                            </ul>
                            @else
                            <ul class="ul-register">
                                <li class="li-register hover "><a class="text-decoration-none" href="/login">Login</a></li>
                            </ul>
                            @endauth
                        </nav>
                        <div class="nav-2">
                            <a href="{{ route('riders.create') }}" class="nav-2-a">Crea un Rider</a>
                            <a href="{{ route('delivery.create') }}" class="nav-2-a">Crea una Consegna</a>
                            <a href="{{ route('delivery.search') }}" class="nav-2-a">Cerca Consegne</a>
                        </div>
                        <div class="padding-custom container">
                            {{ $slot }}
                        </div>
                        

                </div>
        </div>
</div>
    <script>
        var dropdownMenu= document.getElementById('dropdownMenu')
        console.log(dropdownMenu)
        window.addEventListener('load',()=>{
            if(document.getElementById('title')?.innerHTML=='I tuoi Rider'){
                document.getElementById('riders').classList.add('fixed-hover')
                document.getElementById('deliveries').classList.remove('fixed-hover')
            } else if(document.getElementById('title')?.innerHTML=='Elenco consegne'){
                document.getElementById('deliveries').classList.add('fixed-hover')
                document.getElementById('riders').classList.remove('fixed-hover')
            }
        })

        function FixHover($value){
            if($value=='riders'){
                document.getElementById('riders').classList.add('fixed-hover')
                document.getElementById('deliveries').classList.remove('fixed-hover')
                console.log('riders')
            }else if ($value=='deliveries'){
                document.getElementById('deliveries').classList.add('fixed-hover')
                document.getElementById('riders').classList.remove('fixed-hover')
            }
        }

        function toggleMenu(){
            if(dropdownMenu.style.display=='none'){
                dropdownMenu.style.display='block'
            }
            else{
                dropdownMenu.style.display='none'
            }
        }

var modale= document.getElementById('modale')
function displayModale(){
  if(modale.style.display=='none'){
    modale.style.display='block';
  }else {
    modale.style.display='none'
  }
}


var btnsDelete = document.querySelectorAll('#btn-delete')
var deleteForm = document.getElementById('form-delete')

if(btnsDelete){
  for (let btnDelete of btnsDelete){
    //console.log(btnDelete)
  btnDelete.addEventListener('click', e => {
    const action = e.target.getAttribute('data-action');

    deleteForm.setAttribute('action', action)
    
  })
}  
}

let map;

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

const originInput=document.getElementById('origin-input');
console.log(originInput)
initMap();

function success(position){
  const crd =position.coords;
  console.log(`Your current Position is Latitude : ${crd.latitude}, Longitude : ${crd.longitude}`)
  let position2 = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${crd.latitude},${crd.longitude}&key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY`
    console.log(position2)
    async function logMovies() {
  const response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${crd.latitude},${crd.longitude}&key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY`);
  const address = await response.json();
  console.log(address['results'][0]['formatted_address']);
  originInput.value=address['results'][0]['formatted_address']
}
logMovies()
    
}

function error(err){
  console.warn(`ERROR(${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error);



    </script>
</body>
</html>
