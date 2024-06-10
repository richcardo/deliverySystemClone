<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? config('app.name')}}</title>
    @vite(['resources/css/app.css','resources/js/app.js', 'resources/js/jsQR.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
<div >
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
                                 <h2>Su stampu delivery system</h2>
                            </div>
                            @auth
                            <ul class="ul-user">
                                <li class="li-register" onclick="toggleMenu()">
                                    @if(auth()->check())
                                    {{ auth()->user()->name }}
                                    @endif
                                 </li>
                                 
                                <ul class="ul-dropdown" style="display:none" id="dropdownMenu">
                                    <li class="dropdown-item-custom ">
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button type="submit">Esci</button>
                                        </form>
                                    </li>
                                </ul>
                            </ul>
                            @else
                            <ul class="ul-register">
                                <li class="li-register"><a class="text-decoration-none" href="/register">Registrati</a></li>
                                <li class="li-register"><a class="text-decoration-none" href="/login">Login</a></li>
                            </ul>
                            @endauth
                        </nav>
                        <div class="nav-2">
                            <a href="{{ route('riders.create') }}" class="nav-2-a">Crea un Rider</a>
                            <a href="{{ route('delivery.create') }}" class="nav-2-a">Crea una Consegna</a>
                            <a href="{{ route('delivery.search') }}" class="nav-2-a">Cerca Consegne</a>
                        </div>
                        <div class="padding-custom">
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
                console.log('im in')
                dropdownMenu.style.display='block'
            }
            else{
                dropdownMenu.style.display='none'
            }
        }



    </script>
</body>
</html>
