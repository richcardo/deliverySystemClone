<div>
<form wire:submit="create">
    <h2>Crea utente</h2>
    <div class="mb-2">
        <label class="label-form" for="name">Name</label>
        <input class="form-control" type="text" wire:model.blur="name">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label class="label-form" for="email">Email</label>
        <input class="form-control" type="email" wire:model.blur="email">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <label class="label-form" for="password">password</label>
        <input class="form-control" type="password" wire:model.blur="password">
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button class="btn-orange" type="submit">Crea</button>
    
                    
</form>
</div>
