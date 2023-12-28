<?php
class Room {
    private $db;
   

    public function __construct() {
        $this->db = new Database;

    }
    public function addRoom($data){
        $this->db->query(
            "INSERT INTO `room`( `name`, `id_creator`) VALUES (:name,:id_creater)"
        );
    //    bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':id_creater', $data['id_creater']);
        $result=$this->db->execute();
               if ($result) {
                $lastInsertedId = $this->db->lastInsertId();
                return $lastInsertedId;
            } else {
    
                return false;
            }
       }
    }
       
