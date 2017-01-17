<?php

abstract class Kernel
{
    abstract protected function config();

    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->runApp($this->router->getParams());
    }

    private function runApp($params = [])
    {
        try {
            if ($params === false) {
                throw new HttpException(Request::get('url') . ' ==> URL not found.');
            }

            $controller = $params['controller'];
            $method     = $params['method'];
            $params     = $params['params'];

            $controller = $this->runController($controller);

            if ($controller !== false) {

                $method = $this->runMethod($controller, $method, $params);

                if ($method !== false) {

                    Response::render($method[0], $method[1]);

                } else {
                    throw new HttpException($method . ' ==> Method is not found.');
                }
            } else {
                throw new HttpException($controller . ' ==> Controller is not found.');
            }
        } catch (HttpException $e) {
            echo ($e);
        }
    }

    private function runController($controller)
    {
        if (!class_exists($controller)) {

            $file = __DIR__ . '/../controllers/' . $controller . '.php';

            if (file_exists($file) && is_readable($file)) {

                require_once $file;

                if (class_exists($controller)) {

                    return new $controller($this);
                }
                return false;
            }
            return false;
        }
        return false;
    }

    private function runMethod($controller, $method, $params)
    {
        if (method_exists($controller, $method)) {
            return $controller->$method($params);
        }
        return false;
    }
}
