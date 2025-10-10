@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center @if($status == 'success') card-border-success @else border-danger @endif">
                <div class="card-header @if($status == 'success') bg-success @else bg-danger @endif text-white">
                    <h3 class="mb-0">Statut du Paiement</h3>
                </div>

                <div class="card-body card-body-custom">
                    @if($status == 'success')
                        <i class="bi bi-check-circle-fill display-1 text-success mb-3"></i>
                        <h4 class="card-title text-success">Paiement Réussi !</h4>
                        <p class="card-text lead">Votre transaction a été effectuée avec succès.</p>
                        <p class="card-text"><strong>ID de Transaction:</strong> {{ $transactionId }}</p>
                        <hr>
                        <p>Vous pouvez maintenant voir votre reçu ou retourner à la page d'accueil.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">Retour à l'accueil</a>
                        <a href="#" class="btn btn-success">Voir mon reçu</a> <!-- Placeholder for receipt route -->
                    @else
                        <i class="bi bi-x-circle-fill display-1 text-danger mb-3"></i>
                        <h4 class="card-title text-danger">Paiement Échoué</h4>
                        <p class="card-text lead">Une erreur est survenue lors de votre transaction.</p>
                        <p class="card-text"><strong>ID de Transaction:</strong> {{ $transactionId }}</p>
                        <hr>
                        <p>Veuillez réessayer ou contacter le support si le problème persiste.</p>
                        <a href="{{ route('tarifs.index') }}" class="btn btn-primary me-2">Réessayer</a>
                        <a href="#" class="btn btn-outline-primary">Contacter le Support</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
