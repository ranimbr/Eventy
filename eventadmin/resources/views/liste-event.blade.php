@extends('theme')

@section('contenu')
<div class="container-fluid">
    <!-- Titre de la page -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste des évènements</h4>
            </div>
        </div>
    </div>

    <!-- Message d'alerte -->
    @if(session('deleted_message'))
    <div class="alert {{ session('alert_class', 'alert-success') }} alert-dismissible fade show" role="alert">
        {{ session('deleted_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
    @endif

    <!-- Liste des événements -->
    <div class="row">
        @foreach($data as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($item->image)
                    <a href="{{ asset('images/events/'.$item->image) }}" data-lightbox="event-images" data-title="{{ $item->titre }}">
                        <img src="{{ asset('images/events/'.$item->image) }}"
                             class="card-img-top"
                             alt="Affiche de {{ $item->titre }}"
                             style="height: 200px; object-fit: cover;">
                    </a>
                @else
                    <div class="bg-secondary text-white text-center d-flex align-items-center justify-content-center" style="height: 200px;">
                        <small>Pas d'image disponible</small>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->titre }}</h5>
                    <p class="card-text mb-2">
                        <span class="badge bg-info text-dark">{{ ucfirst($item->categorie) }}</span><br>
                        <strong>Lieu :</strong> {{ $item->location }}<br>
                        <strong>Début :</strong> {{ \Carbon\Carbon::parse($item->date_debut)->format('d/m/Y H:i') }}<br>
                        <strong>Fin :</strong> {{ \Carbon\Carbon::parse($item->date_fin)->format('d/m/Y H:i') }}
                    </p>

                    <p class="card-text text-muted" title="{{ $item->description }}">
                        {{ \Illuminate\Support\Str::limit($item->description, 100) }}
                    </p>

                    <p class="card-text">
                        <small class="text-muted"><strong>Créé par :</strong> {{ $item->Cree_par }}</small>
                    </p>

                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ url('/update-event/'.$item->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil me-1"></i> Modifier
                        </a>

                        <form action="{{ url('/suppEvent/'.$item->id) }}" method="POST" onsubmit="return confirm('Supprimer « {{ $item->titre }} » ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
        @endforeach
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection
