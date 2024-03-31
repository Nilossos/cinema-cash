document.addEventListener('DOMContentLoaded', function () {
    const bookSeatsButton = document.getElementById('book-seats-btn');
    const releaseSeatsButton = document.getElementById('release-seats-btn');
    const selectedSeats = new Set();
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    function handleSeatClick(event) {
        const seatNumber = event.target.dataset.seatNumber;
        if (event.target.dataset.isBooked) {
            if (selectedSeats.has(seatNumber)) {
                selectedSeats.delete(seatNumber);
            } else {
                selectedSeats.add(seatNumber);
            }
            event.target.classList.toggle('selected');
        } else {
            if (selectedSeats.has(seatNumber)) {
                selectedSeats.delete(seatNumber);
                event.target.classList.remove('selected');
            } else {
                selectedSeats.add(seatNumber);
                event.target.classList.add('selected');
            }
        }
    }

    const seatElements = document.querySelectorAll('.seat');
    seatElements.forEach(function (seatElement) {
        seatElement.addEventListener('click', handleSeatClick);
    });

    bookSeatsButton.addEventListener('click', function () {
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
                refreshSeats(data.bookedSeats, 'book');
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    });

    releaseSeatsButton.addEventListener('click', function () {
        const selectedSeatsArray = Array.from(selectedSeats);
        fetch('/release-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({selectedSeats: selectedSeatsArray})
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка ответа сети');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                refreshSeats(data.releasedSeats, 'release');
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    });

    function refreshSeats(responeSeats, mode) {
        seatElements.forEach(function (seatElement) {
            const seatNumber = seatElement.dataset.seatNumber;

            const isSeatBooked = responeSeats.some(function (seat) {
                return seat.id == seatNumber;
            });

            if (mode === 'book' && isSeatBooked) {
                seatElement.dataset.isBooked = true;
            }

            if (mode === 'release' && isSeatBooked) {
                seatElement.dataset.isBooked = false;
            }
            if (seatElement.dataset.isBooked == "true" || seatElement.dataset.isBooked == true) {
                seatElement.classList.add('booked');
            } else {
                seatElement.classList.remove('booked')
            }
            seatElement.classList.remove('selected');
            selectedSeats.clear()
        });
    }
});
