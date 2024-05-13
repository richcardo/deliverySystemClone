<x-layout>

    @auth
    <div class="row justify-content-start">
        <div class="col-lg-6 m-5">
            <h1>Ciao {{ auth()->user()->name }}</h1>
        </div>
    </div>
    @endauth

    <header>
        <img src="{{ asset('/img')}}" alt="">
    </header>


</x-layout>