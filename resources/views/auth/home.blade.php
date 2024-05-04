<x-layout :title="auth()->user()->name">
    <div class="row justify-content-center m-4">
        <div class="col-lg-6 m-4">
            <h1>benvenuto {{ auth()->user()->name }}</h1>
            <div class="m-5">
                <h2>ora puoi controllare e gestire portapizze e consegne in modo semplice ed efficace!</h2>
                <div class="text-center">
                    <h2>inizia subito</h2>
                </div>
            </div>
        </div>

        
    </div>
</x-layout>