<?php
class Home extends Controller {
private $User;
public function __construct()
{
    if (!isLoggedIn()) {
        redirect('authentication/login');
    }
    $this->User = $this->model('user');
}
public function index(){
$users = $this->User->getUser();
$data=[
    'users'=>$users
];
   $this->view('home/index',$data);

}




}