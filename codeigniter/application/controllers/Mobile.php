<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Mobile extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->model('mobile_model');
    }

    public function login() {
      $email = $this->input->post('email', TRUE);
      $password = $this->input->post('password', TRUE);

      $user = array('email' => $email);
      $users = $this->mobile_model->get('users', $user);

      if (!$users) {
         echo json_encode(array('success' => FALSE, 'error' => 'Invalid emailvnklsnvlks or password!',
        'email' => $email));
         exit;
      }
      $user = $users[0];
      $hashed_password = $user['password'];

      $password_correct = password_verify($password, $hashed_password);

      if (!$password_correct) {
        echo json_encode(array('success' => FALSE, 'error' => 'Invalid e;DMQ;mail or password!'));
        exit;
      }

      if ($user['status'] != 1) {
        echo json_encode(array('success' => FALSE, 'error' => 'This account has been suspended!'));
        exit;
      }
      echo json_encode(array('success' => TRUE, 'user' => $user));
    }

    public function index() {
        $data = array("fname" => ucwords($this->input->post('fname', TRUE)),
        'lname' => ucwords($this->input->post('lname', TRUE)),
        'gender' => $this->input->post('gender', TRUE),
        'birthdate' => $this->input->post('birthdate', TRUE),
        'mobile_number' => $this->input->post('mobile_number', TRUE),
        'city' => ucwords($this->input->post('city', TRUE)),
        'street' => ucwords($this->input->post('street', TRUE)),
        'postal_code' => $this->input->post('postal_code', TRUE),
        'height' => $this->input->post('height', TRUE),
        'weight' => $this->input->post('weight', TRUE),
        'email' => $this->input->post('email', TRUE),
        'password' => $this->input->post('password', TRUE));
  
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['gender'] = ($data['gender'] == "Male" ? 'm' : 'f');
  
        if($this->mobile_model->insert($table, $data))
          echo json_encode(array('status' => 'success'));
        else
          echo json_encode(array('status' => 'failed'));
      }
  }
?>