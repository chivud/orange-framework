<?php

namespace Core\Services;


class CodeGenerator
{
    private $methods = [
        [
            'name' => 'create'
        ],
        [
            'name' => 'update'
        ],
        [
            'name' => 'delete'
        ],
        [
            'name' => 'get'
        ],
    ];

    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(Config::get('installer.view_path'));
        $this->twig = new \Twig_Environment($loader);
    }

    public function generateEntity($name, $namespace, $location)
    {
        $class = [];
        $class['name'] = $name;
        $class['namespace'] = $namespace;
        foreach ($this->getMethods() as $method) {
            $class['methods'][] = $this->generateMethod($method);
        }

        $classContent = $this->generateClass($class);

        $this->writeClass($class['name'], $classContent);
    }

    private function getMethods()
    {
        $methods = [];
        foreach ($this->methods as $method) {
            $methods[] = [
                'name' => $method['name']
            ];
        }

        return $methods;
    }

    private function generateMethod($data)
    {
        return $this->twig->render('code/method.html.twig', ['method' => $data]);
    }

    private function generateClass($data)
    {
        return $this->twig->render('code/class.html.twig', ['class' => $data]);
    }

    private function writeClass($name, $content, $location = null)
    {
        file_put_contents($location . $name . '.php', $content);
    }
}