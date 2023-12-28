<?php
class Rooms extends Controller {
    private $Room;
    private $room_member;
    public function __construct(){
        $this->Room = $this->model('Room');
        $this->room_member = $this->model('RoomMember');

    }
    public function getRoom(){
        $id = $_SESSION['user_id'];
        $res = $this->Room->getMyRoom($id);
        if ($res) {
            echo json_encode($res);
        } else {
            // Handle error or return an appropriate response
            echo json_encode(['error' => 'Unable to fetch user data']);
        }
    }
    public function newRoom(){
        // print_r($_POST);
        // die();
        $data=[
            "name"=>$_POST['name'],
            "id_creater"=> $_SESSION['user_id']
        ];
        $res = $this->Room->addRoom($data);
        if ($res==false){
            echo "error";

        }else{
            $data = [
                'idroom' => $res,
                'user' => $_POST['selectedUsers']
            ];
            foreach ($data['user'] as $user) {
                $dataToInsert = [
                    'idroom' => $data['idroom'],
                    'id_user' => $user
                ];

                $this->room_member->insertMember($dataToInsert);
            };
        }


    }
    
}