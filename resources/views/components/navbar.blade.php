<nav class="navbar navbar-expand-lg bg-nero">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 text-orange" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between align-items-center " id="navbarNav">
            <ul class="navbar-nav d-flex justify-content-center align-items-center ">
                <li class="nav-item m-0 fs-6">
                    <a class="nav-link" href="{{ route('delivery.index') }}">Deliveries</a>
                </li>
                <li class="nav-item m-0 fs-6">
                    <a class="nav-link" href="{{ route('riders.index') }}">riders</a>
                </li>
            </ul>
            @auth
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ auth()->user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end  ">
                    @if(auth()->user()->is_admin)
                    <li class="li-hover fs-6"><a class="text-decoration-none" href="{{ route('user.create') }}">aggiungi user</a></li>
                    <li class="li-hover fs-6"><a class="text-decoration-none" href="{{ route('user.index') }}">users</a></li>
                    @endif
                    <li class="li-hover fs-6" ><a class="text-decoration-none " href="{{ route('delivery.create') }}">Aggiungi consegna</a></li>
                    <li class="li-hover fs-6"><a class="text-decoration-none" href="{{ route('riders.create') }}">Aggiungi Rider</a></li>
                    <li class="li-hover fs-6">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="btn-esci " type="submit">Esci</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <ul class="m-0 fs-6">
                <li class="m-0 p-0 fs-6"><a class="text-decoration-none" href="/login">Login</a></li>
            </ul>
            @endauth
        </div>
    </div>
</nav>