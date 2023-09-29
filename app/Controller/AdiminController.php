<?php

class AdiminController
{
    public function index()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('adimin.html');

            $parametros = [];

            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = [];

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert()
    {
        var_dump($_POST);
    }
    
}
