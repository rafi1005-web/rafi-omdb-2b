@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ __('dashboard.my_favorites') }}</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header"><h4>{{ __('dashboard.favorite_movies') }}</h4></div>
      <div class="card-body">
        @if(count($favorites) > 0)
          <div class="row">
            @foreach($favorites as $fav)
            <div class="col-md-3 mb-3">
              <div class="card">
                <img src="{{ $fav->poster != 'N/A' ? $fav->poster : 'https://via.placeholder.com/300' }}" class="card-img-top">
                <div class="card-body">
                  <h5>{{ $fav->title }}</h5>
                  <p><strong>{{ __('dashboard.year') }}:</strong> {{ $fav->year ?? 'N/A' }}</p>
                  <a href="{{ route('movies.detail', $fav->imdb_id) }}" class="btn btn-info btn-sm">{{ __('dashboard.detail') }}</a>
                  <form method="POST" action="{{ route('favorites.destroy', $fav->imdb_id) }}" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">{{ __('dashboard.remove') }}</button>
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
            <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg">{{ __('dashboard.search_favorites_btn') }}</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection
