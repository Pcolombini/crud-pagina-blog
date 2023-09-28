<?php 

class Comentario
{
    public static function selecionarComentarios($idPost)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM comentario WHERE id_postagem = :id";

        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = [];

        while ($row = $sql->fetchObject('comentario')) {
            $resultado[] = $row;
        }
        
        return $resultado;
    }
}