@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 text-center">
            <h1 class="display-4 mb-3">Nos Services</h1>
            <p class="lead">Découvrez la gamme complète de services Wi-Fi offerts par WiLink-Tickets.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="my-0 font-weight-normal">Accès Wi-Fi Public</h4>
                </div>
                <div class="card-body card-body-custom">
                    <p class="card-text">Profitez d'un accès internet rapide et sécurisé dans nos zones de couverture publiques. Idéal pour les voyageurs et les utilisateurs occasionnels.</p>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Connexion haut débit</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Sécurité renforcée</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Forfaits flexibles</li>
                    </ul>
                    <a href="{{ route('tarifs.index') }}" class="btn btn-success">Voir les Tarifs</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="my-0 font-weight-normal">Support Client 24/7</h4>
                </div>
                <div class="card-body card-body-custom">
                    <p class="card-text">Notre équipe de support est disponible 24 heures sur 24, 7 jours sur 7, pour répondre à toutes vos questions et résoudre vos problèmes.</p>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Assistance technique</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Conseils personnalisés</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Résolution rapide des problèmes</li>
                    </ul>
                    <a href="#" class="btn btn-success">Contacter le Support</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="my-0 font-weight-normal">Solutions Entreprises</h4>
                </div>
                <div class="card-body card-body-custom">
                    <p class="card-text">Des solutions Wi-Fi sur mesure pour les entreprises, garantissant une connectivité optimale pour vos employés et clients.</p>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Réseaux dédiés</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Gestion de bande passante</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Installation et maintenance</li>
                    </ul>
                    <a href="#" class="btn btn-success">Demander un Devis</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="my-0 font-weight-normal">Hotspots Personnalisés</h4>
                </div>
                <div class="card-body card-body-custom">
                    <p class="card-text">Créez des hotspots Wi-Fi personnalisés pour vos événements, cafés, hôtels ou tout autre lieu public.</p>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Branding personnalisé</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Statistiques d'utilisation</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>Gestion facile</li>
                    </ul>
                    <a href="#" class="btn btn-success">En savoir plus</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
