<?php
    require_once "connection/Connection.php";

    class producto {

        public static function getAll() {
            $db = new Connection();
            $query = "SELECT *FROM producto";
            $resultado = $db->query($query);
            $datos = [];
            if($resultado->num_rows) {
                while($row = $resultado->fetch_assoc()) {
                    $datos[] = [
                        'id' => $row['id'],
                        'producto' => $row['producto'],
                        'precio' => $row['precio']
                    ];
                }//end while
                return $datos;
            }//end if
            return $datos;
        }//end getAll

        public static function getWhere($id_producto) {
            $db = new Connection();
            $query = "SELECT *FROM producto WHERE id=$id_producto";
            $resultado = $db->query($query);
            $datos = [];
            if($resultado->num_rows) {
                while($row = $resultado->fetch_assoc()) {
                    $datos[] = [
                    'id' => $row['id'],
                    'producto' => $row['producto'],
                    'precio' => $row['precio']
                    ];
                }//end while
                return $datos;
            }//end if
            return $datos;
        }//end getWhere

        public static function insert($producto, $precio) {
            $db = new Connection();
            $query = "INSERT INTO producto (producto, precio)
            VALUES('".$producto."','".$precio."')";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end insert

        public static function update($id_producto, $producto, $precio) {
            $db = new Connection();
            $query = "UPDATE producto SET
            producto='".$producto."', precio='".$precio."' 
            WHERE id=$id_producto";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end update

        public static function delete($id_producto) {
            $db = new Connection();
            $query = "DELETE FROM producto WHERE id=$id_producto";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end delete

    }
