@extends('layouts.admin')

@section('content')
    <div id="content">
        <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop"
                    type="button"><i class="fas fa-bars"></i></button>
                <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                            placeholder="Rechercher ..."><button class="btn btn-primary py-0" type="button"><i
                                class="fas fa-search"></i></button></div>
                </form>
            </div>
        </nav>
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Ajout de tickets</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="d-flex">
                        <p class="text-primary m-0 fw-bold me-auto">Enregistrement d'une nouvelle liste de ticket</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="tarif_id" class="col-12 col-form-label">{{ __('Tarif') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-select" id="tarif_id" type="text"
                                            class="form-control @error('tarif_id') is-invalid @enderror" name="tarif_id"
                                            value="{{ old('tarif_id') }}" required autocomplete="tarif_id" autofocus>
                                            <option value="">Sélectionnez un tarif</option>
                                            @foreach ($tarifs as $item)
                                                <option value="{{$item->id}}">{{$item->forfait}} - {{App\Models\Wifi::find($item->wifi_id)->nom}}</option>
                                            @endforeach

                                        </select>

                                        @error('tarif_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fichier" class="col-12 col-form-label">{{ __('Fichier') }}</label>
                                    <div class="col-md-6">
                                        <input id="fichier" type="file"
                                            class="form-control @error('fichier') is-invalid @enderror" name="fichier"
                                            value="{{ old('fichier') }}" required autocomplete="fichier" autofocus>

                                        @error('fichier')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enregistrer') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
