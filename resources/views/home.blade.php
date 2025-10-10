@extends('layouts.app')

@section('content')
<div class="hero-section text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 mb-3">Wi-Fi Rapide, Fiable et Abordable</h1>
        <p class="lead mb-4">Connectez-vous à internet en toute confiance avec WiLink-Tickets. Découvrez la vitesse et la stabilité.</p>
        <a href="#services" class="btn btn-primary btn-lg me-2">Nos Services</a>
        <a href="#tarifs" class="btn btn-outline-light btn-lg">Voir les Tarifs</a>
    </div>
</div>

<div class="container py-5">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 class="mb-3">Pourquoi Choisir WiLink-Tickets ?</h2>
            <p class="lead">Nous offrons une expérience internet inégalée, adaptée à vos besoins.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-speedometer2 display-4 text-primary mb-3"></i> <!-- Icône de remplacement -->
                    <h5 class="card-title">Vitesses Fulgurantes</h5>
                    <p class="card-text">Profitez d'internet haut débit pour toutes vos navigations, streaming et jeux.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-shield-check display-4 text-success mb-3"></i> <!-- Icône de remplacement -->
                    <h5 class="card-title">Sécurisé et Fiable</h5>
                    <p class="card-text">Notre réseau est conçu pour la sécurité et la fiabilité, vous assurant une tranquillité d'esprit.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-wallet2 display-4 text-success mb-3"></i> <!-- Icône de remplacement -->
                    <h5 class="card-title">Plans Abordables</h5>
                    <p class="card-text">Choisissez parmi une variété de plans flexibles et abordables qui correspondent à votre budget.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-section {
        background-color: #28a745; /* Green background */
        background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)); /* Subtle dark overlay for text readability */
        background-size: cover;
        padding: 8rem 0;
    }
    .hero-section h1 {
        font-weight: 700;
    }
    .hero-section .btn-outline-light {
        border-color: white;
        color: white;
    }
    .hero-section .btn-outline-light:hover {
        background-color: white;
        color: #007bff; /* Primary blue */
    }
</style>
@endsection
