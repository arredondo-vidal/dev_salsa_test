<?php

include 'model/db.php';

class DevSalsaTest{
  function __construct() {
    $this->db_model = new Mysql();
    $this->authorized();
    $this->get_page();
  }

  function authorized()
  {
    //$select = filter_input(INPUT_POST,'signin');
    if (!empty($_POST)){
        error_log(var_export($_POST,1));
        $this->get_post_data($_POST);
    }
    return true;
  }

  function get_post_data($data){
    if (isset($data['signin'])){
      error_log('Prueba');
      $data = array('email'=>'email','password'=>'password');
      $response = $this->get_access($data);
      error_log($response);

    }
    elseif(isset($data['register'])){
      error_log('register');
      $data = array('name'=>'admin','email'=>'email','password'=>'password');
      $this->set_user($data);
    }
  }

  function get_access($data)
  {
    error_log('get_access');
    $this->db_model->dbConnect();
    $this->db_model->getUser($data);
    $this->db_model->dbDisconnect();
  }

  function set_user($data){
    $this->db_model->dbConnect();
    $this->db_model->insertUser($data);
    $this->db_model->dbDisconnect();
  }

  function get_page(){
    $select = '';
    $select = filter_input(INPUT_GET,'go');
    //error_log($select);
    switch($select){
      case 'signin':
        $section = $this->get_signin_section();
        break;
      case 'register':
        $section = $this->get_register_section();
        break;

      default:
        $section = $this->get_home_section();
      }
      $main_page = file_get_contents('static/html/main.html');
      $home_page = str_replace('{SECTION}',$section,$main_page);
      echo($home_page);
  }

  function get_home_section(){
    $section = file_get_contents('static/html/home.html');
    return $section;
  }

  function get_signin_section(){
    $section = file_get_contents('static/html/signin.html');
    return $section;
  }

  function get_register_section(){
    $section = file_get_contents('static/html/register.html');
    return $section;
  }
}

$dev_salsa_test = new DevSalsaTest();
?>
