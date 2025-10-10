@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Gestion des Tickets Wi-Fi</h1>
            <p class="lead text-center">Visualisez, ajoutez, modifiez ou supprimez les tickets Wi-Fi.</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-10 offset-md-1 text-end">
            <a href="{{ route('ticket.create') }}" class="btn btn-success">Ajouter de Nouveaux Tickets</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white">
                    Liste des Tickets
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
                                    <th>Utilisateur</th>
                                    <th>Mot de Passe</th>
                                    <th>Durée</th>
                                    <th>État</th>
                                    <th>Tarif</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $ticket)
                                <tr>
                                    <td>{{ $ticket->user }}</td>
                                    <td>{{ $ticket->password }}</td>
                                    <td>{{ $ticket->dure }}</td>
                                    <td>{{ $ticket->etat_ticket }}</td>
                                    <td>{{ $ticket->tarif->forfait ?? 'N/A' }} ({{ $ticket->tarif->montant ?? 'N/A' }} CFA)</td>
                                    <td>
                                        <a href="{{ route('ticket.edit', $ticket->slug) }}" class="btn btn-sm btn-primary me-1">Modifier</a>
                                        <form action="{{ route('ticket.destroy', $ticket->slug) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">Supprimer</button>
                                        </form>
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
                    <p class="text-center lead">Aucun ticket n'est disponible pour le moment. <a href="{{ route('ticket.create') }}">Ajoutez-en un !</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
