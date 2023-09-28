<?php

class PostController
{
    public function index($params)
    {    
        try {
            $postagem = Postagem::selecionarPorId($params);
            
            // echo "<pre>";
            // print_r($postagem);
            // echo "</pre>";

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = [];
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['comentario'] = $postagem->comentario;


            $conteudo = $template->render($parametros);
            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
