@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 text-center">
            <h1 class="display-4 mb-3">Nos Tarifs Wi-Fi</h1>
            <p class="lead">Découvrez nos forfaits internet flexibles et choisissez celui qui vous convient le mieux.</p>
        </div>
    </div>

    <div class="row">
        @forelse($tarifs as $tarif)
            <div class="col-md-4 mb-4">
                <div class="card h-100 card-border-success">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="my-0 font-weight-normal">{{ $tarif->forfait }}</h4>
                    </div>
                    <div class="card-body card-body-custom text-center">
                        <h1 class="card-title pricing-card-title">{{ $tarif->montant }} <small class="text-muted">CFA</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>{{ $tarif->description }}</li>
                            <li>Accès Wi-Fi {{ $tarif->dure }}</li>
                            <li>Connectivité fiable</li>
                            <li>Support 24/7</li>
                        </ul>
                        <a href="{{ route('acheter', $tarif->slug) }}" class="btn btn-lg btn-block btn-success">Acheter</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="lead">Aucun tarif disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
