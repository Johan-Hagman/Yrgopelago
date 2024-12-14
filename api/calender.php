<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../api/database.php';

use benhall14\phpCalendar\Calendar;

// Hämta bokade datum från databasen
$stmt = $pdo->query("
    SELECT check_in_date, check_out_date 
    FROM bookings 
    WHERE check_in_date >= '2025-01-01' AND check_out_date <= '2025-01-31'
");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Skapa en lista med bokade datum
$bookedDates = [];
foreach ($bookings as $booking) {
    $start = new DateTime($booking['check_in_date']);
    $end = new DateTime($booking['check_out_date']);
    while ($start <= $end) {
        $bookedDates[] = $start->format('Y-m-d');
        $start->modify('+1 day');
    }
}

// Generera kalender för januari 2025
$calendar = new Calendar(2025, 1);

// Lägg till bokade datum utan CSS
foreach ($bookings as $booking) {
    $calendar->addEvent(
        $booking['check_in_date'],
        $booking['check_out_date'],
        'Bokad' // Namnet på evenemanget
    );
}

// Generera HTML för kalendern
$calendarHTML = $calendar->draw();

// Lägg till CSS-klasser för bokade datum i den genererade HTML-koden
foreach ($bookedDates as $date) {
    $calendarHTML = str_replace(
        ">$date<",
        " class='booked-date'>$date<",
        $calendarHTML
    );
}

// Visa kalender med markerade datum
echo $calendarHTML;