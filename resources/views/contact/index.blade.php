@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 text-center">
            <h1 class="display-4 mb-3">Contactez-Nous</h1>
            <p class="lead">Nous sommes là pour répondre à toutes vos questions et vous aider.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-border-success mb-4">
                <div class="card-header bg-primary text-white text-center">
                    Informations de Contact
                </div>
                <div class="card-body card-body-custom text-center">
                    <p class="lead mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i>Email: info@fasowifi.com</p>
                    <p class="lead mb-2"><i class="bi bi-phone-fill text-success me-2"></i>Téléphone: +226 00 00 00 00</p>
                    <p class="lead mb-0"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Adresse: 123 Rue Principale, Ouagadougou</p>
                </div>
            </div>

            <div class="card card-border-success">
                <div class="card-header bg-primary text-white text-center">
                    Envoyez-nous un Message
                </div>
                <div class="card-body card-body-custom">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Votre Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Votre Adresse E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Votre Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Envoyer le Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
