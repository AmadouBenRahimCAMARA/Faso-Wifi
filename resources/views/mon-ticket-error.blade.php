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
                                Nous n'avons pas trouvé de ticket correspondant à la transaction ID que vous avez fournie
                            </div>

                            <div class="card-body">
                                Nous vous prions de reprendre le processus de récupération en vérifiant attentivement la
                                transaction ID que vous avez saisie. Sinon, veuillez contacter notre service client au
                                numéro +226 xx xx xx xx.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
