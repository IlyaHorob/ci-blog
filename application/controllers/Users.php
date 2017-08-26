<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('users_model');
        $this->load->helper('url_helper');
    
        $this->session->set_userdata('current_page', 'users');
    }
    
    public function index()
    {
        $page = $this->uri->segment(3, 0);
        $users = $this->users_model->getUsers();
        
        $this->load->library('pagination');
    
        $config['base_url'] = site_url('users/index');
        $config['total_rows'] = count($users);
        $config['per_page'] = 2;
        
        $this->pagination->initialize($config);
        
        $data['users'] = $this->users_model->getUsers(2, $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('users/list', $data);
    }
    
    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        $response = [
            'result' => false,
        ];
        
        if ($this->form_validation->run() === false) {
            $response['errors'] = validation_errors();
        } else {
            $data = array(
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
            );
            
            $userId = $this->users_model->save($data);
            
            $data['id'] = $userId;
            $response['userRow'] = $this->load->view('users/newUserRow', ['user' => $data], true);
            $response['result'] = true;
        }
        echo json_encode($response);
    }

    public function edit($userId)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
    
        $response = [
            'result' => false,
        ];
        
        if ($this->form_validation->run() === false) {
            $response['errors'] = validation_errors();
        } else {
            $data = array(
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
            );
            
            $this->users_model->save($data, $userId);
            $data['id'] = $userId;
    
            $response['user'] = $data;
            $response['result'] = true;
        }
        echo json_encode($response);
    }
    
    public function delete($userId)
    {
        $this->users_model->delete($userId);
        
        $response['result'] = true;
        
        echo json_encode($response);
    }
    
    public function login()
    {
        $email = $this->input->post('email');
        
        $response = [
            'result' => false,
        ];
        $user = $this->users_model->getUserByEmail($email);
        if ($user) {
            $response['result'] = true;
        }
        
        echo json_encode($response);
    }
    
    public function getNewUserForm()
    {
        $this->load->helper('form');
        $data['form'] = $this->load->view('users/newUserForm', [], true);
        $data['result'] = true;
        
        echo json_encode($data);
    }
    
    public function getEditUserForm($userId)
    {
        $this->load->helper('form');
        $data['user'] = $this->users_model->getUser($userId);
        $data['form'] = $this->load->view('users/editUserForm', $data, true);
        $data['result'] = true;
    
        echo json_encode($data);
    }
}
