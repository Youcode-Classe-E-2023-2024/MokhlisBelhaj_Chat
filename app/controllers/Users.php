<?php 
class Users extends Controller{
    private $User;
    public function __construct(){
     $this->User = $this->model('User');
    }
    public function getUser() {
        $res = $this->User->getUser();
        if ($res) {
            echo json_encode($res);
        } else {
            // Handle error or return an appropriate response
            echo json_encode(['error' => 'Unable to fetch user data']);
        }
    }

}