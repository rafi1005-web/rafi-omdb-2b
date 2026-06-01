@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ __('dashboard.my_favorites') }}</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('dashboard.favorite_movies') }}</h4>
      </div>
      <div class="card-body">
        @if(count($favorites) > 0)
          <div class="row">
            @foreach($favorites as $fav)
            <div class="col-md-3 mb-4">
              <div class="card h-100">
                @php
                  $posterUrl = $fav->poster;
                  if ($posterUrl == 'N/A' || empty($posterUrl)) {
                      $posterUrl = 'https://via.placeholder.com/300x450?text=No+Poster';
                  } else {
                      $posterUrl = str_replace('http://', 'https://', $posterUrl);
                  }
                @endphp
                <img src="{{ $posterUrl }}" class="card-img-top" alt="{{ $fav->title }}" style="height: 350px; object-fit: cover; width: 100%;">
                <div class="card-body">
                  <h5 class="card-title">{{ $fav->title }}</h5>
                  <p class="card-text">
                    <strong>{{ __('dashboard.year') }}:</strong> {{ $fav->year ?? 'N/A' }}
                  </p>
                  <a href="{{ route('movies.detail', $fav->imdb_id) }}" class="btn btn-info btn-sm btn-block">
                    <i class="fas fa-info-circle"></i> {{ __('dashboard.detail') }}
                  </a>
                  <form method="POST" action="{{ route('favorites.destroy', $fav->imdb_id) }}" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('{{ app()->getLocale() == 'id' ? 'Hapus film ini dari favorit?' : 'Remove this movie from favorites?' }}')">
                      <i class="fas fa-trash"></i> {{ __('dashboard.remove') }}
                    </button>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-5">
            <i class="fas fa-heart-broken fa-4x mb-3 text-muted"></i>
            <h5 class="text-muted">{{ __('dashboard.no_favorites') }}</h5>
            <p class="mb-4">{{ __('dashboard.start_adding') }}</p>
            <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg">
              <i class="fas fa-search"></i> {{ __('dashboard.search_favorites_btn') }}
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
