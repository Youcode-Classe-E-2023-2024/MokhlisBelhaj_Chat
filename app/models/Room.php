<?php
class Room {
    private $db;
   

    public function __construct() {
        $this->db = new Database;

    }
    public function getMyRoom($id){
        try {
            $this->db->query("SELECT `idroom`, `name`, `id_creator`
            FROM `room`
            WHERE `idroom` IN (SELECT `idroom` FROM `room_member` WHERE `iduser` =:userId );
            " );
            $this->db->bind(':userId', $id);
           
            $result = $this->db->resultSet();
          
            return $result;
        } catch (Exception $e) {
            // Log or handle the exception appropriately
            return false;
        }
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
       
