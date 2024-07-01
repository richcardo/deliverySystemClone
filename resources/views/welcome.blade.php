<x-layout2>
<div class="container-fluid">
    <div class="row justify-content-start px-0 w-100">
            <div class="col-12 col-sm-12 col-md-12 m-5 ">
                <div class="mb-5">
                    @guest
                       <h3 id="title">Accedi Per Iniziare</h3> 
                    @endguest
                    @auth
                        <h3>Benvenuto {{ auth()->user()->name }}</h3>
                        <p>Controlla e gestisci le tue <span class="fw-bold">consegne</span> e i tuoi <span class="fw-bold">Rider</span></p>
                    @endauth
                    
            </div>
    </div>

</div>


</x-layout2>