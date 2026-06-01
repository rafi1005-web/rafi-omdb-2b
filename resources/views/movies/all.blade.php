@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ __('dashboard.all_movies') }}</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>{{ __('dashboard.poster') }}</th>
                <th>{{ __('dashboard.title') }}</th>
                <th>{{ __('dashboard.year') }}</th>
                <th>{{ __('dashboard.type') }}</th>
                <th>{{ __('dashboard.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse($movies as $movie)
              <tr>
                <td>
                  @php
                    $posterUrl = $movie['Poster'];
                    if ($posterUrl == 'N/A' || empty($posterUrl)) {
                        $posterUrl = 'https://via.placeholder.com/50x70?text=No+Poster';
                    } else {
                        $posterUrl = str_replace('http://', 'https://', $posterUrl);
                    }
                  @endphp
                  <img src="{{ $posterUrl }}" width="50" height="70" style="object-fit: cover;" alt="Poster">
                </td>
                <td>{{ $movie['Title'] }}</td>
                <td>{{ $movie['Year'] }}</td>
                <td>{{ ucfirst($movie['Type']) }}</td>
                <td>
                  <a href="{{ route('movies.detail', $movie['imdbID']) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-info-circle"></i> {{ __('dashboard.detail') }}
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">{{ __('dashboard.no_movies_found') }}</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
