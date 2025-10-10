@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-border-success">
                <div class="card-header text-center">
                    {{ __('Inscription') }}
                </div>

                <div class="card-body card-body-custom">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nom" class="col-md-12 col-form-label">{{ __('Nom') }}</label>

                            <div class="col-md-12">
                                <input id="nom" type="text"
                                    class="form-control @error('nom') is-invalid @enderror" name="nom"
                                    value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prenom" class="col-md-12 col-form-label">{{ __('Prénom') }}</label>

                            <div class="col-md-12">
                                <input id="prenom" type="text"
                                    class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                    value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Adresse E-mail') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone"
                                class="col-md-12 col-form-label">{{ __('Téléphone') }}</label>

                            <div class="col-md-12">
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pays" class="col-md-12 col-form-label">{{ __('Pays') }}</label>

                            <div class="col-md-12">
                                <select id="pays"
                                    class="form-select @error('pays') is-invalid @enderror" name="pays"
                                    value="{{ old('pays') }}" required autocomplete="pays">
                                    <option value="">Sélectionnez votre pays</option>
                                    <option value="burkina_faso">BURKINA FASO</option>
                                    <option value="mali">MALI</option>
                                    <option value="cote_divoire">COTE D'IVOIRE</option>
                                    <option value="senegal">SENEGAL</option>
                                    <option value="benin">BENIN</option>
                                    <option value="togo">TOGO</option>
                                </select>

                                @error('pays')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-12 col-form-label">{{ __('Mot de passe') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-12 col-form-label">{{ __('Confirmer le mot de passe') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("S'inscrire") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection