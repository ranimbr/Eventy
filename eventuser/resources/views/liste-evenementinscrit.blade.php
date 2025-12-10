@extends('theme')

@section('contenu')
<div class="container-fluid">
    <!-- Titre de page -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Mes Inscriptions</h4>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Affichage des événements en cartes -->
    <div class="row">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($event->image)
                <img src="{{ asset('images/events/' . $event->image) }}"
                     class="card-img-top"
                     alt="Affiche de {{ $event->titre }}"
                     style="height: 200px; object-fit: cover;">
                @else
                <div class="bg-secondary text-white text-center py-5">
                    <small>Pas d'image disponible</small>
                </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $event->titre }}</h5>
                    <p class="card-text mb-2 text-muted">
                        <strong>Début :</strong> {{ \Carbon\Carbon::parse($event->date_debut)->format('d/m/Y H:i') }}<br>
                        <strong>Fin :</strong> {{ \Carbon\Carbon::parse($event->date_fin)->format('d/m/Y H:i') }}
                    </p>
                    <p class="card-text">
                        {{ Str::limit($event->description, 100) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
