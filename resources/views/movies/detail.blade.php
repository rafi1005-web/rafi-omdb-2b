@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ $movie['Title'] }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('dashboard.dashboard') }}</a></div>
      <div class="breadcrumb-item"><a href="{{ route('movies.index') }}">{{ __('dashboard.search_movies') }}</a></div>
      <div class="breadcrumb-item active">{{ $movie['Title'] }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            @php
              $posterUrl = $movie['Poster'];
              if ($posterUrl == 'N/A' || empty($posterUrl)) {
                  $posterUrl = 'https://via.placeholder.com/300x450?text=No+Poster';
              } else {
                  $posterUrl = str_replace('http://', 'https://', $posterUrl);
              }
            @endphp
            <img src="{{ $posterUrl }}" class="img-fluid rounded shadow" alt="Poster">
          </div>
          <div class="col-md-8">
            <h3>{{ $movie['Title'] }}</h3>
            <hr>

            <div class="row">
              <div class="col-md-6">
                <p><strong>{{ __('dashboard.year') }}:</strong> {{ $movie['Year'] }}</p>
                <p><strong>{{ __('dashboard.rating') }}:</strong> ⭐ {{ $movie['imdbRating'] ?? 'N/A' }}</p>
                <p><strong>{{ __('dashboard.duration') }}:</strong> {{ $movie['Runtime'] ?? 'N/A' }}</p>
                <p><strong>{{ __('dashboard.genre') }}:</strong> {{ $movie['Genre'] ?? 'N/A' }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>{{ __('dashboard.director') }}:</strong> {{ $movie['Director'] ?? 'N/A' }}</p>
                <p><strong>{{ __('dashboard.actors') }}:</strong> {{ $movie['Actors'] ?? 'N/A' }}</p>
                <p><strong>{{ __('dashboard.language') }}:</strong> {{ $movie['Language'] ?? 'N/A' }}</p>
                <p><strong>{{ __('dashboard.country') }}:</strong> {{ $movie['Country'] ?? 'N/A' }}</p>
              </div>
            </div>


            <p><strong>{{ __('dashboard.plot') }}:</strong></p>
            @if(app()->getLocale() == 'id')
              <div class="alert alert-info py-2" style="font-size: 14px;">
                <i class="fas fa-info-circle"></i> {{ __('dashboard.plot_note') }}
              </div>
            @endif
            <p class="text-justify">
              {{ $movie['Plot'] ?: __('dashboard.no_plot') }}
            </p>

            <hr>

            <div class="row mt-3">
              <div class="col-md-6">
                @if(isset($isFavorited) && $isFavorited)
                  <button class="btn btn-success btn-block" disabled>
                    <i class="fas fa-check-circle"></i> {{ __('dashboard.add_to_favorite') }}
                  </button>
                @else
                  <form method="POST" action="{{ route('movies.store_favorite') }}">
                    @csrf
                    <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                    <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                    <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                    <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                    <input type="hidden" name="type" value="{{ $movie['Type'] ?? 'movie' }}">
                    <button type="submit" class="btn btn-danger btn-block">
                      <i class="fas fa-heart"></i> {{ __('dashboard.add_to_favorite') }}
                    </button>
                  </form>
                @endif
              </div>
              <div class="col-md-6">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">
                  <i class="fas fa-arrow-left"></i> {{ __('dashboard.back_btn') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
