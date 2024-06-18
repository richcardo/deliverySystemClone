<x-layout>
    <div class="container">
        <div class="row justify-content-start pt-4">
            <div class="col-6">
                <h3>Modifica Utente</h3>
                @if(session()->has('success'))
                    <div class="alert alert-style-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('user.update', $user) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="name" class="form-label">Nome</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password"
                            value="{{ old('password') }}">
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <button class="btn-orange" type="submit">
                            Aggiungi utente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>