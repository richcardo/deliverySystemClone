<x-layout>

<div class="container">
    <div class="row justify-content-start px-0 w-100">
        <div class="col-12 col-sm-12 col-md-12 m-5 ">
            <div class="mb-5">
                <h3 id="title">I tuoi Rider</h3>
                @if(session()->has('success'))
                    <div class="alert alert-style-success" role="alert">
                    {{ session('success') }}
                    </div>
                @endif
            </div>
            <livewire:riders-list/>
        </div>
    </div>
</div>

</x-layout>