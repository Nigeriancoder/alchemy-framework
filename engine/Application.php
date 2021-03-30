<?php

namespace app\engine;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public string $partial = 'default';
    public Render $view;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new Render();
    }

    public function run()
    {
        try {
            echo $this->router->resolveRequest();
        } catch (\Exception $e) {
            echo $this->router->renderHtml('_error', [
                'exception' => $e,
            ]);
        }
    }
}