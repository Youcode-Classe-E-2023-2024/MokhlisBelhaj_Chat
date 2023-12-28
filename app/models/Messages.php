<?php
class Messages {
    private $db;
   

    public function __construct() {
        $this->db = new Database;

    }
    public function getMessages($id){
        try {
            $this->db->query("SELECT `idmessage`, `idroom`, `from_user`, `content`, `timestamp` FROM `message` WHERE idroom=:idroom

            " );
            $this->db->bind(':idroom', $id);
           
            $result = $this->db->resultSet();
          
            return $result;
        } catch (Exception $e) {
            // Log or handle the exception appropriately
            return false;
        }
    }
    public function insertMessage($data){
        $this->db->query(
            "INSERT INTO `message`( `idroom`, `from_user`, `content`) VALUES (:idroom,:from_user,:content)"
        );
    //    bind values
        $this->db->bind(':idroom', $data['idroom']);
        $this->db->bind(':from_user', $data['userid']);
        $this->db->bind(':content', $data['content']);
    
        $this->db->execute();
    }
    }