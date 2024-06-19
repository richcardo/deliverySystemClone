<x-layout>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="card">
                    <h3>Distanze</h3>
                    <p>Maggiore distanza percorsa : {{ $distance }} Km</p>
                    <p>Rider con maggior distanza : {{ $rider }}</p>
                </div>
                <div class="card mt-3">
                    <h3>Consegne</h3>
                    <p>Maggior numero di consegne : {{ $most_deliveries }}</p>
                    <p>Rider con maggior numero di consegne : {{ $rider_most_deliveries }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>