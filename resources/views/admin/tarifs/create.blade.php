@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    Ajouter un Nouveau Tarif
                </div>
                <div class="card-body card-body-custom">
                    <form method="POST" action="{{ route('admin.tarifs.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="forfait" class="form-label">Forfait</label>
                            <input type="text" class="form-control @error('forfait') is-invalid @enderror" id="forfait" name="forfait" value="{{ old('forfait') }}" required>
                            @error('forfait')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant (CFA)</label>
                            <input type="number" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" value="{{ old('montant') }}" required>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="wifi_id" class="form-label">Wi-Fi Associé</label>
                            <select class="form-select @error('wifi_id') is-invalid @enderror" id="wifi_id" name="wifi_id" required>
                                <option value="">Sélectionnez un réseau Wi-Fi</option>
                                @foreach($wifi as $w)
                                    <option value="{{ $w->id }}" {{ old('wifi_id') == $w->id ? 'selected' : '' }}>{{ $w->nom }}</option>
                                @endforeach
                            </select>
                            @error('wifi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ajouter le Tarif</button>
                            <a href="{{ route('admin.tarifs.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
