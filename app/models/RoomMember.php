<?php
class RoomMember{
    private $db;
   

    public function __construct() {
        $this->db = new Database;
    }
    public function insertMember($data){
        $this->db->query("INSERT INTO `room_member` (idroom, iduser) VALUES (:idroom, :iduser)");
        $this->db->bind(':idroom', $data['idroom']);
        $this->db->bind(':iduser', $data['id_user']); 
        $this->db->execute();
    }
}