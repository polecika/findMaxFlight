<?php
    ini_set('display_errors', 1);
    require_once "Route.php";
    require_once "Routes.php";
    $airportArr = [
        'DME',
        'JFK',
        'HTK',
        'AAS',
        'ABD',
        'AFS',
        'BOO',
        'BPU'
    ];
    $routes = new Routes();
    $routesCount = 20;
    for($i = 0; $i < $routesCount; $i++) {
        $from = $airportArr[mt_rand(0, count($airportArr)-1)];
        $to = $airportArr[mt_rand(0, count($airportArr)-1)];
        while ($from == $to) {
            $to = $airportArr[mt_rand(0, count($airportArr)-1)];
        }
        $int1 = mt_rand(1262055681, strtotime("now"));
        $int2 = mt_rand($int1, strtotime("now"));
        $depart = date("d-m-Y H:i", $int1);
        $arrival = date("d-m-Y H:i", $int2);
        $routes->addRoute(new Route($from, $to, $depart, $arrival));
    }
    echo "<h4>Все вылеты:<h4> ".PHP_EOL;
    $routes->printRoutes();
    echo "_______________".PHP_EOL.
        "Самый долгий";
    $maxRoute = new Routes();
    $maxRoute->setRoutes($routes->maxLongRoute());
    $maxRoute ->printRoutes();




