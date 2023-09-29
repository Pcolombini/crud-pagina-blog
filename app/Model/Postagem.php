<?php 

class Postagem
{
    public static function selecionaTodos()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM postagem ORDER BY id DESC";

        $sql = $conn->prepare($sql);

        $sql->execute();

        $resultado = [];

        while ($row = $sql->fetchObject('Postagem')) {
                $resultado[] = $row;
        }
        
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro");
        }
        
        return $resultado;
    }

    public static function selecionarPorId($idPost)
    {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id',$idPost,PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro");
        } else {
            $resultado->comentario = Comentario::selecionarComentarios($resultado->id);
        }

        return $resultado;
    }

    public static function insert($dadosPost)
    {
        if (empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha todos os campos!");
            
        }
        
        $con = Connection::getConn();

        $sql = "INSERT INTO postagem (titulo,conteudo) VALUES (:tit,:cont)";

        $sql = $con->prepare($sql);

        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':cont', $dadosPost['conteudo']);

        $exec = $sql->execute();

        if ($exec == false) {
            throw new Exception("Preencha todos os campos!");
        } else {
            return true;
        }
    }

}

