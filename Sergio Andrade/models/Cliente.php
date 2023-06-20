<?php
    require_once "connection/Connection.php";

    class Cliente {

        public static function getAll() {
            $db = new Connection();
            $query = "SELECT *FROM clientes";
            $resultado = $db->query($query);
            $datos = [];
            if($resultado->num_rows) {
                while($row = $resultado->fetch_assoc()) {
                    $datos[] = [
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'ap' => $row['ap'],
                        'am' => $row['am'],
                        'fn' => $row['fn'],
                        'genero' => $row['genero']
                    ];
                }//end while
                return $datos;
            }//end if
            return $datos;
        }//end getAll

        public static function getWhere($id_cliente) {
            $db = new Connection();
            $query = "SELECT *FROM clientes WHERE id=$id_cliente";
            $resultado = $db->query($query);
            $datos = [];
            if($resultado->num_rows) {
                while($row = $resultado->fetch_assoc()) {
                    $datos[] = [
                        'id' => $row['id'],
                        'nombre' => $row['nombre'],
                        'ap' => $row['ap'],
                        'am' => $row['am'],
                        'fn' => $row['fn'],
                        'genero' => $row['genero']
                    ];
                }//end while
                return $datos;
            }//end if
            return $datos;
        }//end getWhere

        public static function insert($nombre, $ap, $am, $fn, $genero) {
            $db = new Connection();
            $query = "INSERT INTO clientes (nombre, ap, am, fn, genero)
            VALUES('".$nombre."', '".$ap."', '".$am."', '".$fn."', '".$genero."')";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end insert

        public static function update($id_cliente, $nombre, $ap, $am, $fn, $genero) {
            $db = new Connection();
            $query = "UPDATE clientes SET
            nombre='".$nombre."', ap='".$ap."', am='".$am."', fn='".$fn."', genero='".$genero."' 
            WHERE id=$id_cliente";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end update

        public static function delete($id_cliente) {
            $db = new Connection();
            $query = "DELETE FROM clientes WHERE id=$id_cliente";
            $db->query($query);
            if($db->affected_rows) {
                return TRUE;
            }//end if
            return FALSE;
        }//end delete

    }//end class Cliente
    require_once "models/Cliente.php";

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(isset($_GET['id'])) {
                echo json_encode(Cliente::getWhere($_GET['id']));
            }//end if
            else {
                echo json_encode(Cliente::getAll());
            }//end else
            break;
        case 'POST':
            $datos = json_decode(file_get_contents('php://input'));
            if($datos != NULL) {
                if(Cliente::insert($datos->nombre, $datos->ap, $datos->am, $datos->fn, $datos->genero)) {
                    http_response_code(200);
                }//end if
                else {
                    http_response_code(400);
                }//end else
            }//end if
            else {
                http_response_code(405);
            }//end else
            break;

        case 'PUT':
            $datos = json_decode(file_get_contents('php://input'));
            if($datos != NULL) {
                if(Cliente::update($datos->id, $datos->nombre, $datos->ap, $datos->am, $datos->fn, $datos->genero)) {
                    http_response_code(200);
                }//end if
                else {
                    http_response_code(400);
                }//end else
            }//end if
            else {
                http_response_code(405);
            }//end else
            break;
        case 'DELETE':
            if(isset($_GET['id'])){
                if(Cliente::delete($_GET['id'])) {
                    http_response_code(200);
                }//end if
                else {
                    http_response_code(400);
                }//end else
            }//end if 
            else {
                http_response_code(405);
            }//end else
            break;
        
        default:
            http_response_code(405);
            break;
    }//end while