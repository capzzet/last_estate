<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estate-kg</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body>
<div class="container">
    @include('partials.header')
    <div class="reviews-section">
        <div class="review-form-container">
            <h2>Оставить отзыв</h2>
            @if(session('success'))
                <div class="success-message" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <form class="review-form" action="{{ route('reviews.store') }}" method="post">
                @csrf
                <div class="top-review">
                    <input type="text" name="name" placeholder="Введите ваше имя">
                    <input type="text" name="email" placeholder="Введите вашу почту">
                </div>
                <textarea name="review" placeholder="Напишите ваш отзыв"></textarea>

                <div class="button-container">
                    <button type="submit">Отправить</button>
                    <button type="button" class="clear-button" onclick="document.querySelector('.review-form').reset();">Очистить</button>
                </div>
            </form>
        </div>

        <ul class="reviews-list">
            @foreach($reviews as $review)
                <li class="review-item">
                    <h3>{{ $review->name }}</h3>
                    <p>{{ $review->review }}</p>
                    <div class="review-date">{{ $review->created_at->format('d F Y') }}</div>
                </li>
            @endforeach
        </ul>
    </div>

    @include('partials.footer')
</div>
</body>
</html>
