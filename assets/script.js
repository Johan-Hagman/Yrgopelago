// Markera alla element med klassen "cal-day-box booked-date"
    document.querySelectorAll('.cal-day-box.booked-date').forEach(date => {
        date.style.backgroundColor = 'red'; // Ändra bakgrundsfärgen till röd
        date.style.color = 'white';        // Ändra textfärgen till vit
        date.style.fontWeight = 'bold';    // Gör texten fet
    });
