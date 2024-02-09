<?php
spl_autoload_register(function ($class_name) {
    include  __DIR__ . "/../api/v1/controller/" . $class_name . '.php';

    // Check to see whether the include declared the class
    if (!class_exists($class_name, false)) {
        throw new LogicException("Unable to load class: $class_name");
    }
});
// require "./dummy.php";
class Router
{
    /**
     * Route paths array
     * 
     * @var
     */
    private $routes = [];

    private $errmsg = [];
    /**
     * URI Path
     * @param string $URI
     * 
     * Callback function
     * @param mixed $callback
     * 
     */


    public function get($URI, $callback)
    {
        $this->addRoutes("GET", $URI, $callback);
    }


    /**
     * URI Path
     * @param string $URI
     * 
     * Callback function
     * @param mixed $callback
     * 
     */

    public function post($URI, $callback)
    {
        $this->addRoutes("POST", $URI, $callback);
    }

    /**
     * URI Path
     * @param string $URI
     * 
     * Callback function
     * @param mixed $callback
     * 
     */
    public function put($URI, $callback)
    {
        $this->addRoutes("PUT", $URI, $callback);
    }

    /**
     * URI Path
     * @param string $URI
     * 
     * Callback function
     * @param mixed $callback
     * 
     */
    public function delete($URI, $callback)
    {
        $this->addRoutes("DELETE", $URI, $callback);
    }

    /**
     * 
     * HTTP Method
     * @param string $method
     * 
     * URI Path
     * @param string $URI
     * 
     * Callback function
     * @param mixed $callback
     * 
     */
    private function addRoutes($method, $URI, $callback)
    {
        $this->routes[$method][$URI] = $callback;
    }

    public function run($method, $URI)
    {
        $callback = $this->match($method, $URI);

        if ($callback !== null) {
            $request = explode('@', $callback);

            if (count($request) === 2) {
                $class = $request[0];
                $method = $request[1];

                if (class_exists($class)) {
                    $obj = new $class();

                    if (method_exists($obj, $method)) {
                        $obj->$method();
                    } else {
                        echo "Method $method does not exist in class $class.";
                    }
                } else {
                    echo "Class $class does not exist.";
                }
            } else {
                echo "Invalid callback format.";
            }
        } else {
            echo json_encode($this->errmsg);
        }
    }

    private function handle($callback)
    {
    }
    private function match($method, $URI)
    {
        if (isset($this->routes[$method][$URI])) {
            return $this->routes[$method][$URI];
        } else {
            array_push($this->errmsg, "Path doesn't exist");
        }
    }
    private function clean($URI)
    {
    }
}
