<?php
function findLongestRoute($flights) {
    $longestRoute = [];
    $currentRoute = [];

    foreach ($flights as $flight) {
        if (empty($currentRoute)) {
            $currentRoute[] = $flight;
        } else {
            $lastFlight = end($currentRoute);

            if ($flight['from'] === $lastFlight['to'] && strtotime($flight['depart']) >= strtotime($lastFlight['arrival'])) {
                $currentRoute[] = $flight;
            } else {
                if (count($currentRoute) > count($longestRoute)) {
                    $longestRoute = $currentRoute;
                }

                $currentRoute = [$flight];
            }
        }
    }

    if (count($currentRoute) > count($longestRoute)) {
        $longestRoute = $currentRoute;
    }

    return $longestRoute;
}

$flights = [
    [
        'from'    => 'VKO',
        'to'      => 'DME',
        'depart'  => '01.01.2020 12:44',
        'arrival' => '01.01.2020 13:44',
    ],
    [
        'from'    => 'DME',
        'to'      => 'JFK',
        'depart'  => '02.01.2020 23:00',
        'arrival' => '03.01.2020 11:44',
    ],
    [
        'from'    => 'DME',
        'to'      => 'HKT',
        'depart'  => '01.01.2020 13:40',
        'arrival' => '01.01.2020 22:22',
    ],
];

$longestRoute = findLongestRoute($flights);

foreach ($longestRoute as $flight) {
    echo $flight['from'] . ' → ' . $flight['to'] . ' ' . $flight['depart'] . ' ' . $flight['arrival'] . PHP_EOL;
}