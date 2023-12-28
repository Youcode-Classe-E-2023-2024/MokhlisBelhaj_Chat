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
       $data=[
        'message'=>$res,
        'user'=>$_SESSION['user_id']
       ];
       print_r(json_encode($data));
      

    }
    public function sendMessage()
    {
        $data = [
            'userid' => $_SESSION['user_id'],
            'idroom' => $_POST['idroom'],
            'content' => $_POST['content'],

        ];
        $this->message->insertMessage($data);
    }
}
