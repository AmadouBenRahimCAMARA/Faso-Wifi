@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <h1 class="display-5 text-center">Gestion des Réseaux Wi-Fi</h1>
            <p class="lead text-center">Visualisez, ajoutez, modifiez ou supprimez les réseaux Wi-Fi disponibles.</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-10 offset-md-1 text-end">
            <a href="{{ route('wifi.create') }}" class="btn btn-success">Ajouter un Nouveau Réseau Wi-Fi</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white">
                    Liste des Réseaux Wi-Fi
                </div>
                <div class="card-body card-body-custom">
                    @if($datas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $wifi)
                                <tr>
                                    <td>{{ $wifi->nom }}</td>
                                    <td>{{ Str::limit($wifi->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('wifi.edit', $wifi->slug) }}" class="btn btn-sm btn-primary me-1">Modifier</a>
                                        <form action="{{ route('wifi.destroy', $wifi->slug) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce réseau Wi-Fi ?')">Supprimer</button>
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
                    <p class="text-center lead">Aucun réseau Wi-Fi n'est disponible pour le moment. <a href="{{ route('wifi.create') }}">Ajoutez-en un !</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
