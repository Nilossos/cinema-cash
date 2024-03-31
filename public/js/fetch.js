document.addEventListener('DOMContentLoaded', function () {
    const selectSeatsButton = document.getElementById('select-seats-btn');
    const selectedSeats = new Set();
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    function handleSeatClick(event) {
        const seatNumber = event.target.dataset.seatNumber;
        if (selectedSeats.has(seatNumber)) {
            selectedSeats.delete(seatNumber);
            event.target.classList.remove('selected');
        } else {
            selectedSeats.add(seatNumber);
            event.target.classList.add('selected');
        }
    }

    const seatElements = document.querySelectorAll('.seat');
    seatElements.forEach(function (seatElement) {
        seatElement.addEventListener('click', handleSeatClick);
    });

    selectSeatsButton.addEventListener('click', function () {
        const selectedSeatsArray = Array.from(selectedSeats);
        fetch('/book-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({selectedSeats: selectedSeatsArray})
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                seatElements.forEach(function (seatElement) {
                    if(seatElement.classList.contains('selected')) {
                        seatElement.classList.add('booked');
                        seatElement.classList.remove('selected');
                    }
                });
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    });
});
