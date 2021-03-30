<?php


namespace app\engine;


class Controller
{
    public string $partial = 'main';

    public function setPartial($partial): void
    {
        $this->partial = $partial;
    }

    public function render($view, $params = []): string
    {
        return Application::$app->router->renderHtml($view, $params);
    }


}