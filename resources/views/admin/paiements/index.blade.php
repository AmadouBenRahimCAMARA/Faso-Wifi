@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Gestion des Paiements</h1>
            <p class="lead text-center">Visualisez l'historique des paiements effectués.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white">
                    Liste des Paiements
                </div>
                <div class="card-body card-body-custom">
                    @if($datas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Transaction</th>
                                    <th>Numéro</th>
                                    <th>Moyen de Paiement</th>
                                    <th>Forfait</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $paiement)
                                <tr>
                                    <td>{{ $paiement->transaction_id }}</td>
                                    <td>{{ $paiement->numero ?? 'N/A' }}</td>
                                    <td>{{ $paiement->moyen_de_paiement }}</td>
                                    <td>{{ $paiement->ticket->tarif->forfait ?? 'N/A' }}</td>
                                    <td>{{ number_format($paiement->ticket->tarif->montant ?? 0, 0, ',', ' ') }} CFA</td>
                                    <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $datas->links() }}
                    </div>
                    @else
                    <p class="text-center lead">Aucun paiement n'a été enregistré pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
