// Set arrival time based on destination continent
    $arrivalDateTime = new DateTime($departure_time);

    switch ($destination) {
        case 'India':
            // Domestic flights within India arrive 1 hour after departure time
            $arrivalDateTime->add(new DateInterval('PT1H'));
            break;

        case 'Asia':
            // Flights within Asia arrive 4 hours after departure time
            $arrivalDateTime->add(new DateInterval('PT4H'));
            break;

        case 'North America':
        case 'South America':
            // Flights to North/South America arrive 16 hours after departure time
            $arrivalDateTime->add(new DateInterval('PT16H'));
            break;

        case 'Europe':
            // Flights to Europe arrive 12 hours after departure time
            $arrivalDateTime->add(new DateInterval('PT12H'));
            break;

        case 'Australia':
            // Flights to Australia arrive 8 hours after departure time
            $arrivalDateTime->add(new DateInterval('PT8H'));
            break;

        default:
            // Default case, use 4 hours as a fallback
            $arrivalDateTime->add(new DateInterval('PT4H'));
            break;
    }

    $arrival_time = $arrivalDateTime->format('Y-m-d H:i:s');