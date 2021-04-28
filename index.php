<?php

class DevSalsaTest{
  function __construct() {
    $this->get_page();
  }

  function get_page(){
    $select = '';
    $select = filter_input(INPUT_GET,'go');
    error_log($select);
    switch($select){
      case 'signin':
        $section = $this->get_signin_section();
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
}

$dev_salsa_test = new DevSalsaTest();
?>
