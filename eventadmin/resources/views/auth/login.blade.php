@extends('login')

@section('content')

<div class="card">
    <div class="card-body text-center">
        <h2>Se connecter</h2>
        <p>Identifiez-vous pour accéder à votre espace.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="floating-input form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label class="form-label" for="email">Adresse Email</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="floating-input form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                <label class="form-label" for="password">Mot de passe</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Se souvenir de moi</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>

            @if (Route::has('password.request'))
                <p class="mt-3">
                    <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                </p>
            @endif
        </form>
    </div>
</div>
@endsection
