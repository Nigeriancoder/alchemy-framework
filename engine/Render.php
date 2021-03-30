<?php


namespace app\engine;


class Render
{
    public function renderPartialWithView($view, array $params)
    {
        $partial = Application::$app->partial;
        if (Application::$app->controller) {
            $partial = Application::$app->controller->partial;
        }
        $viewContent = $this->renderViewOnly($view, $params);
        ob_start();
        include_once __DIR__."/../public/renders/partials/$partial.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderViewOnly($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__."/../public/renders/$view.php";
        return ob_get_clean();
    }
}