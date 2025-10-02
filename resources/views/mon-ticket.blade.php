@extends('layouts.faso')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('index') }}">Accueil</a></li>
                    <li>Récupérer mon ticket</li>
                </ol>
                <!--h2>Connexion</h2-->

            </div>
        </section><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-dark py-4 text-white text-center">
                                <h4 class="text-center fw-bold text-primary">Récupérer mon ticket</h4>
                                Renseignez l'id de votre ticket afin de pouvoir récupérer votre ticket
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('recuperationPost') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="monTicket"
                                            class="col-md-12 col-form-label">{{ __('Transaction ID') }}</label>

                                        <div class="col-md-12">
                                            <input id="monTicket" type="text"
                                                class="form-control @error('monTicket') is-invalid @enderror"
                                                name="monTicket" value="{{ old('monTicket') }}" required
                                                autocomplete="monTicket" autofocus>

                                            @error('monTicket')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-primary btn-xl">Continuer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
