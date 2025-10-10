@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    Ajouter de Nouveaux Tickets (Import CSV/TXT)
                </div>
                <div class="card-body card-body-custom">
                    <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="tarif_id" class="form-label">Tarif Associé</label>
                            <select class="form-select @error('tarif_id') is-invalid @enderror" id="tarif_id" name="tarif_id" required>
                                <option value="">Sélectionnez un Tarif</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id }}" {{ old('tarif_id') == $tarif->id ? 'selected' : '' }}>{{ $tarif->forfait }} ({{ $tarif->montant }} CFA)</option>
                                @endforeach
                            </select>
                            @error('tarif_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fichier" class="form-label">Fichier CSV/TXT des Tickets</label>
                            <input type="file" class="form-control @error('fichier') is-invalid @enderror" id="fichier" name="fichier" required>
                            @error('fichier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Veuillez uploader un fichier CSV ou TXT contenant les tickets (un ticket par ligne, format: utilisateur,motdepasse,duree,etat_ticket).</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Importer les Tickets</button>
                            <a href="{{ route('ticket.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
