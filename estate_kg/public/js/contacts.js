document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");
    const successMessage = document.createElement('div');
    successMessage.id = 'successMessage';
    successMessage.style.display = 'none';
    contactForm.parentNode.appendChild(successMessage);

    contactForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(contactForm);

        fetch(contactForm.action, {
            method: contactForm.method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Успешно!') {
                    successMessage.textContent = 'Сообщение успешно отправлено!';
                    successMessage.style.display = 'block';
                    contactForm.reset();
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 3000);
                } else {
                    alert('Ошибка при отправке формы.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при отправке формы.');
            });
    });
});
