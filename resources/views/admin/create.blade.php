<x-layout 
:user="$user"
:title="$title"                        
>
    <div class="container">
        <div class="row justify-content-start pt-3">
            <div class="col-6">
                <livewire:user-form :user="$user" :title="$title"/>
            </div>
        </div>
    </div>
</x-layout>