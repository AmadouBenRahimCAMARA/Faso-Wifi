@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    Modifier le Ticket
                </div>
                <div class="card-body card-body-custom">
                    <form method="POST" action="{{ route('ticket.update', $data->slug) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control @error('user') is-invalid @enderror" id="user" name="user" value="{{ old('user', $data->user) }}" required autofocus>
                            @error('user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password', $data->password) }}" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dure" class="form-label">Durée</label>
                            <input type="text" class="form-control @error('dure') is-invalid @enderror" id="dure" name="dure" value="{{ old('dure', $data->dure) }}" required>
                            @error('dure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="etat_ticket" class="form-label">État du Ticket</label>
                            <select class="form-select @error('etat_ticket') is-invalid @enderror" id="etat_ticket" name="etat_ticket" required>
                                <option value="EN_VENTE" {{ old('etat_ticket', $data->etat_ticket) == 'EN_VENTE' ? 'selected' : '' }}>EN VENTE</option>
                                <option value="VENDU" {{ old('etat_ticket', $data->etat_ticket) == 'VENDU' ? 'selected' : '' }}>VENDU</option>
                                <option value="EXPIRE" {{ old('etat_ticket', $data->etat_ticket) == 'EXPIRE' ? 'selected' : '' }}>EXPIRE</option>
                            </select>
                            @error('etat_ticket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tarif_id" class="form-label">Tarif Associé</label>
                            <select class="form-select @error('tarif_id') is-invalid @enderror" id="tarif_id" name="tarif_id" required>
                                <option value="">Sélectionnez un Tarif</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id }}" {{ old('tarif_id', $data->tarif_id) == $tarif->id ? 'selected' : '' }}>{{ $tarif->forfait }} ({{ $tarif->montant }} CFA)</option>
                                @endforeach
                            </select>
                            @error('tarif_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Mettre à Jour le Ticket</button>
                            <a href="{{ route('ticket.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
