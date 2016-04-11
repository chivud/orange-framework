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
     * @internal param ViewRender $viewRender
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

    /**
     * @param $view
     * @param array $params
     * @return Response
     */
    protected function view($view, array $params = [])
    {
        return $this->htmlResponse(ViewRender::render($view, $params));
    }

    /**
     * @param $name
     * @return mixed
     * @throws ModelNotExistsException
     */
    protected function model($name)
    {
        $model = self::BASE_MODEL_NAMESPACE . ucwords($name);

        if (class_exists($model)) {
            $dbClass = $this->getDatabaseClass();
            return new $model(new $dbClass());
        }

        throw new ModelNotExistsException('Model ' . $model . ' does not exists in namespace ' . self::BASE_MODEL_NAMESPACE);
    }

    /**
     * @return string
     */
    private function getDatabaseClass()
    {
        return self::DATABASE_CLASS;
    }
}
