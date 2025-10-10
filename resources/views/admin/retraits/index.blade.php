@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Gestion des Retraits</h1>
            <p class="lead text-center">Visualisez et gérez les demandes de retrait.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white">
                    Liste des Demandes de Retrait
                </div>
                <div class="card-body card-body-custom">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($datas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>ID Transaction</th>
                                    <th>Numéro Paiement</th>
                                    <th>Moyen de Paiement</th>
                                    <th>Statut</th>
                                    <th>Demandé par</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $retrait)
                                <tr>
                                    <td>{{ number_format($retrait->montant, 0, ',', ' ') }} CFA</td>
                                    <td>{{ $retrait->transaction_id ?? 'N/A' }}</td>
                                    <td>{{ $retrait->numero_paiement ?? 'N/A' }}</td>
                                    <td>{{ $retrait->moyen_de_paiement ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $retrait->statut == 'approuvé' ? 'success' : ($retrait->statut == 'rejeté' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($retrait->statut) }}
                                        </span>
                                    </td>
                                    <td>{{ $retrait->user->nom ?? 'N/A' }} {{ $retrait->user->prenom ?? '' }}</td>
                                    <td>{{ $retrait->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('retrait.edit', $retrait->slug) }}" class="btn btn-sm btn-primary me-1">Modifier Statut</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $datas->links() }}
                    </div>
                    @else
                    <p class="text-center lead">Aucune demande de retrait n'est disponible pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
