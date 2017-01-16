<?php

class Router
{
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        require '/../bootstrap/Routes.php';
        $this->routes = $this->compile(Route::get());
        $this->params = $this->resolve(Request::get('url'));
    }

    public function getParams()
    {
        return $this->params;
    }

    private function compile($definitions = [])
    {
        $routes = [];

        foreach ($definitions as $pattern => $route) {
            $url_parts  = explode('/', trim($pattern, '/'));
            $url_params = [];

            foreach ($url_parts as $i => $part) {
                if (strpos($part, ':') === 0) {
                    $name              = trim(substr($part, 1), '?');
                    $type              = (strpos(trim($part, ':'), '?') === 0) ? true : false;
                    $reset_part        = (strpos(trim($part, ':'), '?') === 0) ? '?(?P<' . $name . '>[^/]+)?' : '(?P<' . $name . '>[^/]+)';
                    $url_parts[$i]     = $reset_part;
                    $url_params[$name] = $type;
                }
            }
            $pattern = implode('/', $url_parts);

            $route = explode('@', $route);

            $params['controller'] = $route[0];
            $params['method']     = $route[1];
            $params['params']     = $url_params;

            $routes[$pattern] = $params;
        }
        return $routes;
    }

    private function resolve($url)
    {
        $url = filter_var(trim($url, '/'), FILTER_SANITIZE_URL);

        foreach ($this->routes as $pattern => $params) {
            if (preg_match('~^' . $pattern . '$~', $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (array_key_exists($key, $params['params'])) {
                        $params['params'][$key] = $value;
                    }
                }
                return $params;
            }
        }
        return false;
    }
}
