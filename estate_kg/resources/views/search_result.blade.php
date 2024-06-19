@extends('layouts.app')

@section('content')
    <div class="search-results-page">
        <h1>Результаты поиска для "{{ $query }}"</h1>
        <div class="search-results-container">
            @if($advertisements->isEmpty())
                <p>Ничего не найдено.</p>
            @else
                @foreach($advertisements as $advertisement)
                    <div class="advertisement">
                        <div class="advertisement-image">
                            @if($advertisement->images->isNotEmpty())
                                <img src="{{ asset($advertisement->images->first()->image_path) }}" alt="Изображение недвижимости">
                            @endif
                        </div>
                        <div class="advertisement-info">
                            <h2>{{ $advertisement->title }}</h2>
                            <p>{{ $advertisement->description }}</p>
                            <a href="{{ route('catalog.show', ['id' => $advertisement->id]) }}">
                                <button>Подробнее</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
