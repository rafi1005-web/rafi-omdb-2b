@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('dashboard.dashboard') }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('dashboard.search_movies') }}</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('movies.index') }}" class="btn btn-primary">{{ __('dashboard.search_now') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('dashboard.my_favorites') }}</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('movies.favorite') }}" class="btn btn-danger">{{ __('dashboard.view_favorites') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
