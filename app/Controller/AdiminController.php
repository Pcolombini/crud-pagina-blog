<?php

class AdiminController
{
    public function index()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('adimin.html');

            $objPostagens = Postagem::selecionaTodos();
            
            $parametros = [];
            $parametros ['postagens'] = $objPostagens;

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
        try {
            Postagem::insert($_POST);
            echo '<script>
                alert("Publicação inserida com sucesso!");
            </script>';
            // echo '<script>
            // location.href"localhost/crud/?pagina=adimin&metodo=index"
            // </script>';
            // header('location
            // : localhost/crud/?pagina=adimin&metodo=index');
            
        } catch (Exception $e) {
            echo '<script>
                alert(" '.$e->getMessage().'");
            </script>';
            // echo '<script>
            //     location.href"localhost/crud/?pagina=adimin&metodo=create"
            // </script>';
            // header('location
            // : localhost/crud/?pagina=adimin&metodo=create');
        }
    }
    
}

