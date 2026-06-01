@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ __('dashboard.search_movies') }}</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header"><h4>{{ __('dashboard.search_movies') }}</h4></div>
      <div class="card-body">
        <form method="GET" class="mb-4">
          <div class="input-group">
            <input type="text" name="s" class="form-control" placeholder="{{ __('dashboard.search_placeholder') }}" value="{{ request('s') }}">
            <div class="input-group-append">
              <button class="btn btn-primary"><i class="fas fa-search"></i> {{ __('dashboard.search_movies') }}</button>
            </div>
          </div>
        </form>

        @if(request('s'))
          @if(count($movies) > 0)
            <div class="row">
              @foreach($movies as $movie)
              <div class="col-md-3 mb-3">
                <div class="card">
                  <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300' }}" class="card-img-top">
                  <div class="card-body">
                    <h5>{{ $movie['Title'] }}</h5>
                    <p><strong>{{ __('dashboard.year') }}:</strong> {{ $movie['Year'] }}</p>
                    <a href="{{ route('movies.detail', $movie['imdbID']) }}" class="btn btn-primary btn-sm">{{ __('dashboard.detail') }}</a>
                    <form method="POST" action="{{ route('movies.store_favorite') }}" class="mt-2">
                      @csrf
                      <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                      <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                      <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                      <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                      <input type="hidden" name="type" value="{{ $movie['Type'] }}">
                      <button class="btn btn-danger btn-sm">{{ __('dashboard.add_to_favorite') }}</button>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          @else
            <div class="alert alert-warning text-center">{{ __('dashboard.no_movies_found') }}</div>
          @endif
        @else
          <div class="text-center py-5">
            <i class="fas fa-film fa-4x text-muted mb-3"></i>
            <h5>{{ __('dashboard.search_movies') }}</h5>
            <p class="text-muted">{{ __('dashboard.enter_keyword') }}</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
