<x-layout>

<div class="row justify-content-start px-0">
            <x-menu-rider/>
        <div class="col-8 col-sm-6 col-md-8 m-5">
            <div class="mb-5">
                <h1>{{ __('messages.favourite') }}</h1>
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