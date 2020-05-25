<?php


class Routes
{
    private $routes = [];
    private $flightTime = 0;

    public function maxLongRoute($routes) {
        $maxRoutes = [];
        $maxRoute = [];
        array_push($maxRoute, $routes[0]);
        while(!empty($routes)){
            foreach($routes as $route) {
                if($maxRoute[count($maxRoute)-1]->getTo() === $route->getFrom() &&
                    strtotime($maxRoute[count($maxRoute)-1]->getArrival()) < strtotime($route->getDepart())) {
                    array_push($maxRoute, $route);
                }
            }
            array_shift($routes);
            array_push($maxRoutes, [$maxRoute, $this->calcFlightTime($maxRoute)]);
        }
        if(!empty($maxRoutes)) {
            $maxRoute = $maxRoutes[0][0];
            foreach($maxRoutes as $route) {
                if($route[1] > $this->calcFlightTime($maxRoute)) {
                    $maxRoute = $route[0];
                }
            }
        }

        return $maxRoute;
    }

    public function sortRoutes() {
        usort($this->routes, function ($x,$y) {
            {
                return $x->getDepart() > $y->getDepart() ? 1
                    : ($x->getDepart() < $y->getDepart() ? -1
                        : ($x->getFlightTime() > $y->getFlightTime() ? 1
                            : ($x->getFlightTime() < $y->getFlightTime() ? -1
                                :0)));
            }
        });
    }

   public function addRoute($route) {
        array_push($this->routes, $route);
        $this->flightTime += $route->getFlightTime();
   }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function printRoutes() {
        foreach($this->routes as $route) {
            echo '<p>Откуда: '.$route->getFrom().'</p>'.
                '<p>Куда: '.$route->getTo().'</p>'.
                '<p>Дата вылета:'.$route->getDepart().'</p>'.
                '<p>Дата прилета: '.$route->getArrival().PHP_EOL.'</p><hr>';
        }
        echo "<h4>Общее время полета</h4>".$this->calcFlightTime($this->routes);
    }

    /**
     * @return int
     */
    public function getFlightTime()
    {
        return $this->flightTime;
    }

    public function calcFlightTime($routes) {
        $sum = 0;
        if(!empty($routes)) {
            foreach($routes as $route) {
                $sum += $route->getFlightTime();
            }
        }
        return $sum;

    }




}