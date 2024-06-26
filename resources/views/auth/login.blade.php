<x-layout2 title="Login">
<div class="container">
    <div class="row justify-content-start">
            <div class="col-lg-10 ms-3 mt-4">
                <h1 class="text-orange">Accedi con le tue credenziali</h1>
            </div>
        </div>

        <div class="row justify-content-start">
            <div class="col-lg-3 ms-3 card-style">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="my-3">
                            <label class="form-label" for="name">Inserisci la mail</label>
                            <input class="form-control" name="email" id="email" type="email" value="{{ old('email') }}">
                            @error('email')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="my-3">
                            <label class="form-label" for="password">Inserisci la password</label>
                            <input class="form-control" name="password" id="password" type="password">
                            @error('password')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn-orange fs-4"  type="submit">Login</button>
                        </div>
                        
                    </form>
            </div>
        </div>
</div>
    

</x-layout2>