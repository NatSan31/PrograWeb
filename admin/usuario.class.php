<?php
require_once('../sistema.class.php');

class Usuario extends Sistema{
    //INSERTAR A LA BASE DE DATOS
    function create($data){       
        $this->conexion();
        $rol = $data['data'];
        $data = $data['data'];
        //iniciar una transaccion
        $this->conn->beginTransaction();
        try
        $sql = "INSERT INTO usuario (correo, contraseña) VALUES (:correo,:contrasena);";
        $insertar = $this->conn->prepare($sql);
        $contraEncrip= md5($data['contrasena']);
        //bindParam para evitar las inyecciones de SQL
        $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $insertar->bindParam(':contrasena', $contraEncrip, PDO::PARAM_STR);
        $insertar->execute();
        $sql ="SELECT id_usuario from usuario where correo = :correo";
        $consulta = $this->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $consulta->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_ASSOC);
        $id_usuario = isset($datos['id_usuario']); $datos['id_usuario'],
        if(is null(4id_usuario)){
            foreach($rol as $r -> $k){
                $sql = "INSERT INTO usuario_rol(id_usuario, id_rol) values(:id_usuario, :id_rol)";
                $insertar_rol = $this -> con->prepare($sql);
                $insertar_rol->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                $insertar_rol->bindParam(':id_rol', $k, PDO::PARAM_STR);
                $insertar_rol->execute();
                )
            }
        }


        $this->conn->commit(); //terminar la transaccion
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data){
        //$result = [];
        $this->conexion();
        $rol = $data['rol'];
        $this->con->con->beginTransaction();
        try;
        $sql = "UPDATE usuario SET correo=:correo,contraseña=:contrasena where id_usuario=:id_usuario;";
        $modificar = $this->conn->prepare($sql);
        $contraEncrip = md5($data['contrasena']);
        $modificar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $modificar->bindParam(':contrasena', $contraEncrip, PDO::PARAM_STR);
        $modificar->execute();

        $result = $modificar->rowCount();
        $this->con->commit;
        return $result;
        $this->con->rollback();
    }
    return false;
    }

    function delete($id){
        $result = [];
        $this->conexion();
        $sql = "DELETE FROM usuario WHERE id_usuario=:id_usuario;";
        $eliminar = $this->conn->prepare($sql);
        $eliminar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $eliminar->execute();
        $result = $eliminar->rowcount();
        return $result;
    }

    function readOne($id){
        $result = [];
        $this->conexion();
        $sql = 'SELECT * from usuario where id_usuario = :id_usuario;';
        $update = $this->conn->prepare($sql);
        $update->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $update->execute();
        $result = $update->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'select * from usuario;';
        $sql = $this->conn->prepare($consulta);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAllRoles($id){
        $this->conexion();
        $sql ="SELECT u. , r.rol from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario= :id_usuario;";
        foreach ($roles as $rol){
            array_push($data, $rol, ['id.rol'])

        }
       // return $consulta->fetchAll
        

    }
}
