<?php


namespace app\engine;



class Router
{

    private Request $request;
    private Response $response;
    private array $routeMap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routeMap['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routeMap['post'][$url] = $callback;
    }

    public function resolveRequest()
    {
        $method = $this->request->getRequestMethod();
        $url = $this->request->getUrl();
        $callback = $this->routeMap[$method][$url] ?? false;

        if (!$callback) {

            var_dump("Exception");
            exit(500);

        }
        if (is_string($callback)) {
            return $this->renderHtml($callback);
        }

        if (is_array($callback)){
            $callback[0] = new $callback[0];
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderHtml($view, $params = [])
    {
        return Application::$app->view->renderPartialWithView($view, $params);
    }

    public function renderViewOnly($view, $params = [])
    {
        return Application::$app->view->renderViewOnly($view, $params);
    }

}