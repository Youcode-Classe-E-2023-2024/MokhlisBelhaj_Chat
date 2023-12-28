<?php
class Message extends Controller
{
    private $message;
    public function __construct()
    {
        $this->message = $this->model('Messages');
    }
    public function messageRoom()
    {
        $id = $_POST['roomId'];
       $res= $this->message->getMessages($id);
       print_r(json_encode($res));
    }
    public function sendMessage()
    {
        $data = [
            'userid' => $_SESSION['userid'],
            'idroom' => $_POST['idroom'],
            'content' => $_POST['content'],

        ];
        $this->message->insertMessage($data);
    }
}
