<?php

namespace Core\Controller;

use Core\Exceptions\ModelNotExistsException;
use Core\Http\JsonResponse;
use Core\Http\RequestInterface;
use Core\Http\Response;
use Core\Services\Config;

/**
 * This is the base controller class.
 * All controllers must extend this class
 * @package Core\Controller
 */
class Controller
{
    const BASE_MODEL_NAMESPACE = 'App\Models\\';
    const DATABASE_CLASS = 'Core\Database\PDOConnection';
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Controller constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Return the RequestInterface object for retrieving the request data
     * @return RequestInterface
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Resturn a json response
     * @param $response
     * @return JsonResponse
     */
    protected function jsonResponse($response)
    {
        return new JsonResponse($response);
    }

    /**
     * Return a html response
     * @param $html
     * @return Response
     */
    protected function htmlResponse($html)
    {
        return new Response($html);
    }

    protected function view($view, array $params = [])
    {

        $basePath = Config::get('app.view_path');

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

        return $this->htmlResponse($html);
    }

    protected function model($name)
    {
        $model = self::BASE_MODEL_NAMESPACE . ucwords($name);

        if (class_exists($model)) {
            $dbClass = $this->getDatabaseClass();
            return new $model(new $dbClass());
        }

        throw new ModelNotExistsException('Model ' . $model . ' does not exists in namespace ' . self::BASE_MODEL_NAMESPACE);
    }

    private function getDatabaseClass()
    {
        return self::DATABASE_CLASS;
    }
}
