@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Tableau de Bord Administrateur</h1>
            <p class="lead text-center">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }} ! Gérez votre application WiLink-Tickets.</p>
        </div>
    </div>

    <div class="row">
        <!-- Solde Total -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">Solde Total</div>
                <div class="card-body card-body-custom text-center">
                    <h2 class="card-title display-4">{{ number_format($datas['solde_total'], 0, ',', ' ') }} CFA</h2>
                    <p class="card-text">Montant total de vos soldes.</p>
                </div>
            </div>
        </div>

        <!-- Solde du Jour -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-success text-white text-center">Solde du Jour</div>
                <div class="card-body card-body-custom text-center">
                    <h2 class="card-title display-4">{{ number_format($datas['solde_du_jour'], 0, ',', ' ') }} CFA</h2>
                    <p class="card-text">Revenus générés aujourd'hui.</p>
                </div>
            </div>
        </div>

        <!-- Tickets Vendus Aujourd'hui -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">Tickets Vendus Aujourd'hui</div>
                <div class="card-body card-body-custom text-center">
                    <h2 class="card-title display-4">{{ $datas['ticket_du_jour_vendu'] }}</h2>
                    <p class="card-text">Nombre de tickets vendus ce jour.</p>
                </div>
            </div>
        </div>

        <!-- Tickets Total Vendus -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-success text-white text-center">Tickets Total Vendus</div>
                <div class="card-body card-body-custom text-center">
                    <h2 class="card-title display-4">{{ $datas['ticket_total_vendu'] }}</h2>
                    <p class="card-text">Nombre total de tickets vendus.</p>
                </div>
            </div>
        </div>

        <!-- Retrait Total Estimé -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-primary text-white text-center">Retrait Total Estimé</div>
                <div class="card-body card-body-custom text-center">
                    <h2 class="card-title display-4">{{ number_format($datas['retrait_total'], 0, ',', ' ') }} CFA</h2>
                    <p class="card-text">Montant estimé disponible pour le retrait.</p>
                </div>
            </div>
        </div>

        <!-- Gestion Rapide -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-border-success">
                <div class="card-header bg-success text-white text-center">Gestion Rapide</div>
                <div class="card-body card-body-custom d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ route('admin.tarifs.index') }}" class="btn btn-primary w-75 mb-2">Gérer les Tarifs</a>
                    <a href="{{ route('wifi.index') }}" class="btn btn-outline-primary w-75 mb-2">Gérer les Wi-Fi</a>
                    <a href="{{ route('ticket.index') }}" class="btn btn-outline-primary w-75">Gérer les Tickets</a>
                    <a href="{{ route('paiement.index') }}" class="btn btn-outline-primary w-75 mb-2">Gérer les Paiements</a>
                    <a href="{{ route('retrait.index') }}" class="btn btn-outline-primary w-75">Gérer les Retraits</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4 text-center">Derniers Paiements</h3>
            @if($paiements->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover card-border-success">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID Transaction</th>
                            <th>Montant</th>
                            <th>Forfait</th>
                            <th>Moyen de Paiement</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr>
                            <td>{{ $paiement->transaction_id }}</td>
                            <td>{{ number_format($paiement->ticket->tarif->montant, 0, ',', ' ') }} CFA</td>
                            <td>{{ $paiement->ticket->tarif->forfait }}</td>
                            <td>{{ $paiement->moyen_de_paiement }}</td>
                            <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $paiements->links() }}
            </div>
            @else
            <p class="text-center lead">Aucun paiement récent.</p>
            @endif
        </div>
    </div>
</div>
@endsection