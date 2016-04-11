<?php

namespace Core\Controller;

use Core\Services\Config;

class ViewRender
{

    public static function render($view, array $params = [], $viewsPath = 'app.view_path')
    {
        $basePath = Config::get($viewsPath);

        $explodedView = explode('.', $view);

        if (count($explodedView) > 1) {

            $viewPage = $basePath . $explodedView[0] . '/' . $explodedView[1] . '.php';
        } else {
            $viewPage = $basePath . $explodedView[0] . '.php';
        }

        ob_start();
        if (!empty($params)) {
            extract($params);
        }

        include $viewPage;

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }
}