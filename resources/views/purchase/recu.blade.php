@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header text-center bg-success text-white">
                    <h3 class="mb-0">Votre Reçu</h3>
                </div>

                <div class="card-body card-body-custom">
                    <h4 class="text-center mb-4">Détails de l'Achat</h4>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>ID de Transaction:</strong> {{ $paiement->transaction_id }}</p>
                            <p><strong>Moyen de Paiement:</strong> {{ $paiement->moyen_de_paiement }}</p>
                            <p><strong>Date d'Achat:</strong> {{ $paiement->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Forfait:</strong> {{ $paiement->ticket->tarif->forfait }}</p>
                            <p><strong>Montant:</strong> {{ $paiement->ticket->tarif->montant }} CFA</p>
                            <p><strong>Description:</strong> {{ $paiement->ticket->tarif->description }}</p>
                        </div>
                    </div>

                    <hr>

                    <h4 class="text-center mb-4">Informations de Connexion Wi-Fi</h4>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="p-3 border rounded bg-light-gray shadow-sm">
                                <p class="lead mb-1"><strong>Nom d'utilisateur:</strong> {{ $paiement->ticket->user }}</p>
                                <p class="lead mb-0"><strong>Mot de passe:</strong> {{ $paiement->ticket->password }}</p>
                                <p class="text-muted mt-2">Durée: {{ $paiement->ticket->dure }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('telecharger-mon-recu', $paiement->slug) }}" class="btn btn-primary me-2">Télécharger le Reçu</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
