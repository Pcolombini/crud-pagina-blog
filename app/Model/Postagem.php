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

}
