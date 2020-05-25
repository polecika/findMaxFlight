<?php


class Routes
{
    private $routes = [];

    public function maxLongRoute() {
        $maxRoute = [];
        usort($this->routes, function ($x,$y) {
            {
                return $x->getDepart() > $y->getDepart() ? 1
                    : ($x->getDepart() < $y->getDepart() ? -1
                    : ($x->getFlightTime() > $y->getFlightTime() ? 1
                    : ($x->getFlightTime() < $y->getFlightTime() ? -1
                    :0)));

            }
        });
        array_push($maxRoute, $this->routes[0]);
        foreach($this->routes as $route) {
            if($maxRoute[count($maxRoute)-1]->getTo() === $route->getFrom() &&
                strtotime($maxRoute[count($maxRoute)-1]->getArrival()) < strtotime($route->getDepart())) {
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
            echo '<p>Откуда: '.$route->getFrom().'</p>'.
                '<p>Куда: '.$route->getTo().'</p>'.
                '<p>Дата вылета:'.$route->getDepart().'</p>'.
                '<p>Дата прилета: '.$route->getArrival().PHP_EOL.'</p><hr>';
        }
    }

}