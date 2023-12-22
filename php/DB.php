<?php 
    class DB{
        private $connect = '';
        function __construct()
        {
            $this->connect = mysqli_connect("localhost", "root", "","webd");
            if (!$this->connect){
                die('Error connect to DataBase');
            }
        }
        public function select($sql): array {
            $res = $this->connect->query($sql);
            return $res->fetch_all(MYSQLI_ASSOC);
        }
        public function delete($table, $id){
            $stmt = $this->connect->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function insert($table, $data) {
            $keys = implode(', ', array_keys($data));
            $values = "'" . implode("', '", array_values($data)) . "'";
            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            return $this->connect->query($sql);
        }
    }
?>