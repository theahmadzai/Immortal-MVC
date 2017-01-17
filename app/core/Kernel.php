<?php

abstract class Kernel
{
    private $router;

    public function __construct()
    {
        $this->runApp(Router::getInstance()->getParams());
    }

    private function runApp($params = [])
    {
        try {
            if ($params !== false) {

                extract($params);

                $controller = $this->runController($controller);

                if ($controller !== false) {

                    $method = $this->runMethod($controller, $method, $params);

                    if ($method !== false) {

                        if (is_array($method)) {

                            Response::render($method[0], $method[1]);
                        }

                    } else {
                        throw new HttpException($method . ' ==> Method not found.');
                    }
                } else {
                    throw new HttpException($controller . ' ==> Controller not found.');
                }
            } else {
                throw new HttpException(Request::get('url') . ' ==> URL not found.');
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
            return call_user_func_array([$controller, $method], $params);
        }
        return false;
    }
}
