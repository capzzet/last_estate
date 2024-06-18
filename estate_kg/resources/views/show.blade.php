<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estate-kg</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
<div class="container">
    @include('partials.header')
    <div class="details-container">
        <div class="images-section">
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
        <div class="agent-details">
            <div class="agent-image">
                <img src="{{ asset('storage/' . $advertisement->agent->photo) }}" alt="Агент">
            </div>
            <div class="agent-info">
                <h2 style="margin:20px 0">{{ $advertisement->agent->name }}</h2>
                <h2 style="margin:20px 0">Номер агента: {{ $advertisement->agent->phone }}</h2>

                <div class="consultation-form" style="margin: 0">
                    <h2 style="margin-bottom: 20px">Консультация</h2>
                    <form id="consultationForm" @submit.prevent="submitConsultationForm">
                        @csrf
                        <input type="text" name="name" placeholder="Ваше имя" required>
                        <input type="tel" name="phone" placeholder="Ваш телефон" required>
                        <button type="submit">Получить консультацию</button>
                    </form>
                    <div id="consultationSuccessMessage" class="success-message">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="details-sections">
        <div class="main-filters">
            <h3>Параметры</h3>
            <ul>
                <li>Тип недвижимости: {{ $propertyTypes[$advertisement->property_type] ?? $advertisement->property_type }}</li>
                <li>Цена: {{ number_format($advertisement->price, 0, '', ' ') }} ⃀ </li>
                <li>Город: {{ $advertisement->city }}</li>
                <li>Адрес: {{ $advertisement->address }}</li>
            </ul>
        </div>
        <div class="additional-details">
            <h3>Дополнительные параметры</h3>
            <ul>
                <li>Этаж:  {{ $propertyTypes[$advertisement->floor] ?? $advertisement->floor }}</li>
                <li>Этажей в доме:  {{ $propertyTypes[$advertisement->total_floors] ?? $advertisement->total_floors }}</li>
                <li>Площадь: {{  $propertyTypes[$advertisement->area ] ?? $advertisement->area }}м² </li>
                <li>Комнат: {{  $propertyTypes[$advertisement->rooms ] ?? $advertisement->rooms }}</li>
                <li>Балкон: {{ $propertyTypes[$advertisement->balcony] ?? $advertisement->balcony }}</li>
                <li>Санузел: {{  $propertyTypes[$advertisement->bathroom ] ?? $advertisement->bathroom }}</li>
                <li>Вид из окон: {{  $propertyTypes[$advertisement->view] ?? $advertisement->view }}</li>
                <li>Ремонт: {{  $propertyTypes[$advertisement->renovation ] ?? $advertisement->renovation }}</li>
                <li>Тип дома: {{  $propertyTypes[$advertisement->house_type] ?? $advertisement->house_type}}</li>
            </ul>
        </div>
    </div>

        <script src="{{ asset('js/catalog.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('consultationForm');
            const successMessage = document.getElementById('consultationSuccessMessage');

            console.log('Script loaded');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                console.log('Form submitted');

                const formData = new FormData(form);
                const data = {
                    name: formData.get('name'),
                    phone: formData.get('phone')
                };

                console.log('Data:', data);

                fetch('/consultation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        console.log('Response received');
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data:', data);
                        if (data.success) {
                            successMessage.textContent = 'Форма успешно отправлена!';
                            successMessage.style.display = 'block';
                            successMessage.style.color = 'green';
                            form.reset();


                            setTimeout(() => {
                                successMessage.style.display = 'none';
                            }, 3000);
                        } else {
                            alert('Ошибка при отправке формы: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        alert('Произошла ошибка при отправке формы.');
                    });
            });
        });

    </script>
    @include('partials.footer')
</div>
</body>
</html>
