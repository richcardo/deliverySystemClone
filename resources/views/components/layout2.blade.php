<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar/>
    @auth
     <x-navbar2/>
    @endauth
   
    <div class="container">
        {{ $slot }}
    </div>

<script>
        var dropdownMenu = document.getElementById('dropdownMenu')
        console.log(dropdownMenu)
        window.addEventListener('load', () => {
            if (document.getElementById('title')?.innerHTML == 'I tuoi Rider') {
                document.getElementById('riders').classList.add('fixed-hover')
                document.getElementById('deliveries').classList.remove('fixed-hover')
            } else if (document.getElementById('title')?.innerHTML == 'Elenco consegne') {
                document.getElementById('deliveries').classList.add('fixed-hover')
                document.getElementById('riders').classList.remove('fixed-hover')
            }
        })

        function FixHover($value) {
            if ($value == 'riders') {
                document.getElementById('riders').classList.add('fixed-hover')
                document.getElementById('deliveries').classList.remove('fixed-hover')
                console.log('riders')
            } else if ($value == 'deliveries') {
                document.getElementById('deliveries').classList.add('fixed-hover')
                document.getElementById('riders').classList.remove('fixed-hover')
            }
        }

        function toggleMenu() {
            if (dropdownMenu.style.display == 'none') {
                dropdownMenu.style.display = 'block'
            }
            else {
                dropdownMenu.style.display = 'none'
            }
        }

        var modale = document.getElementById('modale')
        function displayModale() {
            if (modale.style.display == 'none') {
                modale.style.display = 'block';
            } else {
                modale.style.display = 'none'
            }
        }


        var btnsDelete = document.querySelectorAll('#btn-delete')
        var deleteForm = document.getElementById('form-delete')

        if (btnsDelete) {
            for (let btnDelete of btnsDelete) {
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

        const originInput = document.getElementById('origin-input');
        console.log(originInput)
        initMap();

        function success(position) {
            const crd = position.coords;
            console.log(`Your current Position is Latitude : ${crd.latitude}, Longitude : ${crd.longitude}`)
            let position2 = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${crd.latitude},${crd.longitude}&key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY`
            console.log(position2)
            async function logMovies() {
                const response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${crd.latitude},${crd.longitude}&key=AIzaSyCFulwjF58N_YdFzIQJ6Dx-xySIkT_ZTXY`);
                const address = await response.json();
                console.log(address['results'][0]['formatted_address']);
                originInput.value = address['results'][0]['formatted_address']
            }
            logMovies()

        }

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        navigator.geolocation.getCurrentPosition(success, error);



    </script>
</body>
</html>