@extends('layouts.app')

@section('content')
    <form id="filters-form" method="GET" action="{{ route('catalog.index') }}">
        <div class="filter-container">
            <div class="filters">
                <div class="filter">
                    <label for="property-type">Тип недвижимости</label>
                    <select id="property-type" name="property_type">
                        <option value="">Любой</option>
                        <option value="flat">Квартира</option>
                        <option value="house">Дом</option>
                        <option value="land">Участок</option>
                    </select>
                </div>
                <div class="filter">
                    <label for="deal-type">Купить/Снять</label>
                    <select id="deal-type" name="deal_type">
                        <option value="">Любой</option>
                        <option value="buy">Купить</option>
                        <option value="rent">Снять</option>
                    </select>
                </div>
                <div class="filter">
                    <label for="city">Город</label>
                    <input type="text" id="city" name="city" value="{{ request('city') }}">
                </div>
                <div class="filter">
                    <label for="min-price">Минимальная цена</label>
                    <input type="number" id="min-price" name="min_price" value="{{ request('min_price') }}">
                </div>
                <div class="filter">
                    <label for="max-price">Максимальная цена</label>
                    <input type="number" id="max-price" name="max_price" value="{{ request('max_price') }}">
                </div>
                <div class="filter">
                    <label for="address">Введите адрес</label>
                    <input type="text" id="address" name="address" placeholder="Поиск...">
                </div>

                <div class="filter">
                    <label for="min-area">Минимальная площадь</label>
                    <input type="number" id="min-area" name="min_area" value="{{ request('min_area') }}">
                </div>
                <div class="filter">
                    <label for="max-area">Максимальная площадь</label>
                    <input type="number" id="max-area" name="max_area" value="{{ request('max_area') }}">
                </div>

            </div>
            <button type="submit" class="search-button">Найти</button>
            <button type="button" class="search-button advanced-search">
                Расширенный поиск
                <span class="filter-count">(0)</span>
            </button>
        </div>
        <div class="advanced-search-form">
            <div class="filters">
                <div class="filter">
                    <label for="rooms">Количество комнат</label>
                    <input type="number" id="rooms" name="rooms" value="{{ request('rooms') }}">
                </div>
                <div class="filter">
                    <label for="floor">Этаж</label>
                    <input type="number" id="floor" name="floor" value="{{ request('floor') }}">
                </div>
                <div class="buttons">
                    <button type="button" class="search-button" id="apply-filters">Поиск</button>
                    <button type="button" class="search-button" id="reset-filters">Очистить</button>
                </div>

            </div>
            </div>
    </form>

    @foreach ($advertisements as $advertisement)
        <div class="advertisement">
            <div class="advertisement-image">
                <div class="slider">
                    @foreach ($advertisement->images as $image)
                        <div class="slide">
                            <img src="{{ asset($image->image_path) }}" alt="Недвижимость {{ $loop->iteration }}">
                        </div>
                    @endforeach
                    <button class="slider-button prev">&#10094;</button>
                    <button class="slider-button next">&#10095;</button>
                    <div class="slider-indicators">
                        @foreach ($advertisement->images as $image)
                            <span class="slider-indicator {{ $loop->first ? 'active' : '' }}"></span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="advertisement-details">
                <h2>{{ $advertisement->area }}м², {{ $propertyTypes[$advertisement->property_type] ?? $advertisement->property_type }}, {{ $advertisement->floor }}/{{ $advertisement->total_floors }} этаж</h2>
                <div class="price-details">
                    <div class="agent-price">
                        {{ number_format($advertisement->price, 0, '', ' ') }} ⃀
                    </div>
                    <div class="agent-price-per-meter">
                        {{ number_format($advertisement->price / $advertisement->area, 0, '', ' ') }} ⃀/м²
                    </div>
                </div>
                <div class="descrip">
                    <p>{{ $advertisement->city }}, {{ $advertisement->address }}</p>
                    <p>{{ $advertisement->description }}</p>
                </div>
                @if ($advertisement->agent)
                    <div class="advertisement-agent">
                        <div class="agent-image">
                            <img src="{{ asset('storage/' . $advertisement->agent->photo) }}" alt="Агент">
                        </div>
                        <div class="agent-info">
                            <div class="agent-name">{{ $advertisement->agent->name }}</div>
                            <div class="agent-description">Агент</div>
                        </div>
                    </div>
                    <div class="agent-price-options">
                        <div class="agent-contact">
                            <button id="show-phone" class="contact-button">
                                Показать телефон
                            </button>
                            <button id="phone-number" class="contact-button" style="display: none;">
                                {{ $advertisement->agent->phone }}
                            </button>
                            <div class="icons">
                                <a href="{{ $advertisement->agent->telegram_link }}" target="_blank">
                                    <img src="{{ asset('images/telegram.svg') }}" alt="Telegram">
                                </a>
                                <a href="{{ $advertisement->agent->whatsapp_link }}" target="_blank">
                                    <img src="{{ asset('images/whatsapp.svg') }}" alt="Whatsapp">
                                </a>
                            </div>
                        </div>
                        <button>Подробнее</button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach






    <script src="{{ asset('js/catalog.js') }}"></script>
@endsection
