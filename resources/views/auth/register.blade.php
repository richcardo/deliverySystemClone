<x-layout title="Registrazione">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-4">
            <h1 class="text-orange">Registrati</h1>
        </div>
    </div>

    <div class="row justify-content-start ms-3">
        <div class="col-lg-3 card-style">
                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label" for="name">nome</label>
                        <input class="form-control" name="name" id="name" type="text">
                        @error('name')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control"  name="email" id="email" type="email">
                        @error('email')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="password">Inserisci la password</label>
                        <input class="form-control" name="password" id="password" type="password">
                        @error('password')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="password_confirmation">conferma password</label>
                        <input class="form-control" name="password_confirmation" id="password_confirmation" type="password">
                        @error('password_confirmation')  <span class="text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn-orange fs-4"  type="submit">registrati</button>
                    </div>
                    
                </form>
        </div>
    </div>
</div>


   

</x-layout>