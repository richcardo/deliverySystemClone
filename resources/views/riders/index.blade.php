<x-layout>

<div class="row justify-content-start px-0">
            <x-menu-rider/>
        <div class="col-12 col-sm-4 col-md-5 m-5">
            <div class="mb-5">
                <h1>I tuoi Rider Preferiti</h1>
                @if(session()->has('success'))
                    <div class="alert alert-style-success" role="alert">
                    {{ session('success') }}
                    </div>
                @endif
            </div>
            <livewire:riders-list/>
        </div>
</div>

</x-layout>