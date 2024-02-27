<?php
spl_autoload_register(function ($class_name) {
    $filepath = __DIR__ . "/../api/v1/controller/" . $class_name . '.php';

    try {
        if (file_exists($filepath)) {
            include $filepath;
        }
    } catch (Exception $e) {
        // Handle autoload exceptions here
        http_response_code(500);
        echo json_encode($e->getMessage());
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


    /**
     * List of error message
     * 
     * @var
     */
    private $errmsg = [];


    /**
     * List of accepted methods
     * 
     * @var
     */

    private $list_method = ["GET", "POST", "DELETE", "PUT"];


    private $requestMethod;

    private $URIpattern;

    function __construct($requestMethod, $URIpattern)
    {
        $this->requestMethod = $requestMethod;
        $this->URIpattern = $URIpattern;
    }
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

        if (!in_array(strtoupper($method), $this->list_method)) {
            $this->err(404, "Invalid method");
        }
        $this->routes[$method][$URI] = $callback;
    }


    /**
     * 
     * 
     * @param string $method
     * 
     * @param string $URI
     */

    public function run()
    {
        $callback = $this->match($this->requestMethod, $this->URIpattern);

        $http = explode('@', $callback);

        if (count($http) < 2) {
            $this->err(404, "Invalid Callback Format");
        }

        $class = $http[0];
        $method = $http[1];

        if (!class_exists($class)) {
            $this->err(404, "Class $class is not found");
        }

        $controller = new $class();
        $callable = [$controller, $method];

        if (!is_callable($callable)) {
            $this->err(404, "Callback $method is not callable");
        }

        switch ($this->requestMethod) {
            case "POST":
                $data = json_decode(file_get_contents("php://input"));
                $controller->$method($data);
                break;
            case "GET":
                $controller->$method();
                break;
        }
    }


    /**
     * 
     * 
     * @param string $method
     * 
     * @param string $URI
     */
    private function match($method, $URI)
    {
        $callback = $this->routes[$method][$URI];
        if (isset($callback)) {
            if (empty($callback)) {
                $this->err(404, "No Callback found");
            }
            return $this->routes[$method][$URI];
        } else {
            array_push($this->errmsg, "Path doesn't exist");
        }
    }

    /**
     * 
     * @param int $code
     * 
     * @param string $message
     */
    private function err($code, $message)
    {
        http_response_code($code);
        array_push($this->errmsg, $message);
        echo json_encode([
            "Status" => "error",
            "Message" => $this->errmsg
        ]);

        $this->errmsg = [];
        exit();
    }
}
