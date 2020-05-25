<?php


class Routes
{
    private $routes = [];

    public function maxLongRoute() {
        $maxRoute = [];
        usort($this->routes, function ($x,$y) {
            {
                return $x->getArrival() > $y->getArrival() ? 1
                    : ($x->getArrival() < $y->getArrival() ? -1
                    : ($x->getFlightTime() > $y->getFlightTime() ? 1
                    : ($x->getFlightTime() < $y->getFlightTime() ? -1
                    :0)));

            }
        });
        array_push($maxRoute, $this->routes[0]);
        foreach($this->routes as $route) {
            if($maxRoute[count($maxRoute)-1]->getFrom() === $route->getTo() &&
                $maxRoute[count($maxRoute)-1]->getArrival() < $route->getDepart()) {
                array_push($maxRoute, $route);
            }
        }
        return $maxRoute;
    }

   public function addRoute($route) {
        array_push($this->routes, $route);
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
            echo 'Откуда: '.$route->getFrom().PHP_EOL.
                'Куда: '.$route->getTo().PHP_EOL.
                'Дата вылета:'.$route->getDepart().PHP_EOL.
                'Дата прилета: '.$route->getArrival().PHP_EOL;
        }
    }

}