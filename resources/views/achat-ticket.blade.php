@extends('layouts.faso')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('index') }}">Accueil</a></li>
                    <li>Achat de ticket</li>
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
                                <h4 class="text-center fw-bold text-primary">Achat de ticket</h4>
                                Obtenez votre ticket et naviguez librement
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('apiPaiement') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="pays" class="col-md-12 col-form-label">{{ __('Sélectionnez un tarifs') }}</label>

                                        <div class="col-md-12">
                                            <select id="pays" class="form-select @error('pays') is-invalid @enderror"
                                                name="tarif_id" value="{{ old('pays') }}" required autocomplete="pays">
                                                @foreach ($tarifs as $item)
                                                    <option value="{{ $item->id }}">{{ $item->forfait }}</option>
                                                @endforeach
                                            </select>
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