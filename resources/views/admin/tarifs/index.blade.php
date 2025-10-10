@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Gestion des Tarifs</h1>
            <p class="lead text-center">Visualisez, ajoutez, modifiez ou supprimez les forfaits Wi-Fi.</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-10 offset-md-1 text-end">
            <a href="{{ route('admin.tarifs.create') }}" class="btn btn-success">Ajouter un Nouveau Tarif</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white">
                    Liste des Tarifs
                </div>
                <div class="card-body card-body-custom">
                    @if($datas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Forfait</th>
                                    <th>Montant</th>
                                    <th>Description</th>
                                    <th>Wi-Fi Associé</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $tarif)
                                <tr>
                                    <td>{{ $tarif->forfait }}</td>
                                    <td>{{ number_format($tarif->montant, 0, ',', ' ') }} CFA</td>
                                    <td>{{ Str::limit($tarif->description, 50) }}</td>
                                    <td>{{ $tarif->wifi->nom ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.tarifs.edit', $tarif->slug) }}" class="btn btn-sm btn-primary me-1">Modifier</a>
                                        <form action="{{ route('admin.tarifs.destroy', $tarif->slug) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif ?')">Supprimer</button>
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
                    <p class="text-center lead">Aucun tarif n'est disponible pour le moment. <a href="{{ route('admin.tarifs.create') }}">Ajoutez-en un !</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
