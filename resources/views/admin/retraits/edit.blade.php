@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    Modifier le Statut du Retrait
                </div>
                <div class="card-body card-body-custom">
                    <form method="POST" action="{{ route('retrait.update', $data->slug) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant du Retrait</label>
                            <input type="text" class="form-control" id="montant" value="{{ number_format($data->montant, 0, ',', ' ') }} CFA" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="user" class="form-label">Demandé par</label>
                            <input type="text" class="form-control" id="user" value="{{ $data->user->nom ?? 'N/A' }} {{ $data->user->prenom ?? '' }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                <option value="en attente" {{ old('statut', $data->statut) == 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="approuvé" {{ old('statut', $data->statut) == 'approuvé' ? 'selected' : '' }}>Approuvé</option>
                                <option value="rejeté" {{ old('statut', $data->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Mettre à Jour le Statut</button>
                            <a href="{{ route('retrait.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
