@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header text-center">
                    {{ __('Acheter un Ticket Wi-Fi') }}
                </div>

                <div class="card-body card-body-custom">
                    <h3 class="text-center mb-4">Détails du Forfait Sélectionné</h3>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="p-3 border rounded bg-white shadow-sm">
                                <h4 class="text-primary">{{ $tarif->forfait }}</h4>
                                <p class="lead">{{ $tarif->montant }} CFA</p>
                                <p>{{ $tarif->description }}</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center mt-5 mb-4">Confirmer l'Achat</h3>
                    <p class="text-center lead">Vous êtes sur le point d'acheter le forfait <strong>{{ $tarif->forfait }}</strong> pour <strong>{{ $tarif->montant }} CFA</strong>.</p>
                    <p class="text-center">Veuillez cliquer sur le bouton ci-dessous pour procéder au paiement.</p>

                    <div class="text-center mt-4">
                        <form action="{{ route('apiPaiement') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tarif_id" value="{{ $tarif->id }}">
                            <button type="submit" class="btn btn-success btn-lg">Procéder au Paiement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
