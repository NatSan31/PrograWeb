<?php
require_once('../sistema.class.php');

class Rol extends Sistema{
    //INSERTAR A LA BASE DE DATOS
    function create($data){
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO rol (rol) VALUES (:rol);";
        $insertar = $this->conn->prepare($sql);
        //bindParam para evitar las inyecciones de SQL
        $insertar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data){
        $result = [];
        $this->conexion();
        $sql =
        "UPDATE rol SET rol=:rol where id_rol=:id_rol;";
        $modificar = $this->conn->prepare($sql);
        $modificar->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $modificar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id){
        $result = [];
        $this->conexion();
        $sql = "DELETE FROM rol WHERE id_rol=:id_rol;";
        $eliminar = $this->conn->prepare($sql);
        $eliminar->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $eliminar->execute();
        $result = $eliminar->rowcount();
        return $result;
    }

    function readOne($id){
        $result = [];
        $this->conexion();
        $sql = 'SELECT * from rol where id_rol = :id_rol;';
        $consulta = $this->conn->prepare($sql);
        $consulta->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $consulta->execute();
        $result = $consulta->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this->conexion();
        $result = [];
        $sql = 'select * from rol;';
        $consulta = $this->conn->prepare($sql);
        $consulta->execute();
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}