<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorize extends CI_Controller
{
    const LINK_SOLD = 'ILLIA';
    
    /**
     * Authorize constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('users_model');
    
        $this->session->set_userdata('current_page', 'authorize');
    }
    
    protected function _isUserConfirmed($user)
    {
        return $user['confirmed'] === 0;
    }
    
    protected function _sendConfirmationEmail($user)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'hibestaukro@gmail.com', // change it to yours
            //            'smtp_pass' => 'Cbnybxtyrj12345', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true,
        );
        $options = [
            'email' => $user['email'],
            'confirm_phrase' => $user['confirm_phrase'],
        ];
        $user['confirmation_link'] = base_url('authorize/confirm') . '?' . http_build_query($options);
        
        // load email library
        $this->load->library('email', $config);
        
        $body = $this->load->view('emails/register', ['user' => $user], true);
        // prepare email
        $this->email
            ->from('hibestaukro@gmail.com')
            ->to($user['email'])
            ->subject('Registration on cilessons')
            ->message($body)
            ->set_mailtype('html');
        
        // send email
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            print_r($this->email->print_debugger());
        }
    }
    
    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation
            ->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation
            ->set_rules('password', 'Password', 'trim|required|min_length[6]');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('users/register');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $user = $this->users_model->getUserByEmailAndPassword($email, $password);
            if (empty($user)) {
                $error = 'User with such login or password doesn\'t exist';
                $this->session->set_flashdata('error', $error);
                
                $this->load->view('users/register');
            } elseif (!empty($user['confirm_phrase']) || empty($user['confirmed'])) {
                $error = 'Please confirm your account.';
                $this->session->set_flashdata('error', $error);
                
                $this->load->view('users/register');
            } else {
                unset($user['confirmed']);
                unset($user['confirm_phrase']);
                $user['fullname'] = $user['first_name'] . ' ' . $user['last_name'];
                //login
                $this->session->set_userdata('currentUser', $user);
                
                $success = 'Welcome to CI lessons!';
                $this->session->set_flashdata('success', $success);
                
                redirect('/');
            }
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('currentUser');
        $this->session->set_flashdata('success', 'You just logged out successfully');

        redirect('/');
    }
    
    public function register()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation
            ->set_rules('firstname', 'Firstname', 'trim|required|alpha_numeric|min_length[4]');
        $this->form_validation
            ->set_rules('lastname', 'Lastname', 'trim|required|alpha_numeric|min_length[4]');
        $this->form_validation
            ->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation
            ->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation
            ->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('users/register');
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $user = $this->users_model->getUserByEmail($email);
            if (!empty($user)) {
                throw new DuplicateEmailException('This email already exists');
            }
            $link = md5(time() . $user['email'] . self::LINK_SOLD);
            $user = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
                'confirmed' => false,
                'confirm_phrase' => $link,
            );
            
            $userId = $this->users_model->save($user);
            if (!empty($userId)) {
                $user['id'] = $userId;
                
                $this->_sendConfirmationEmail($user);
            }
        }
    }
    
    public function confirm()
    {
        $email = $this->input->get('email');
        $confirmPhrase = $this->input->get('confirm_phrase');
        $success = $error = '';
        
        if (!empty($email) && !empty($confirmPhrase)) {
            $user = $this->users_model->getUserByEmailAndPhrase($email, $confirmPhrase);
            if (!empty($user)) {
                $this->users_model->confirmUser($email);
                
                unset($user['confirmed']);
                unset($user['confirm_phrase']);
                $user['fullname'] = $user['first_name'] . ' ' . $user['last_name'];
                //login
                $this->session->set_userdata('currentUser', $user);
                
                $success = 'Congratulation, you\'ve just registered successfully!';
            } else {
                $error = sprintf(
                    "Sorry, email <strong>%s</strong> is already exist or not confirmed.",
                    $email
                );
            }
        } else {
            $error = "Sorry, your link doesn't have email or confirm phrase";
        }
        
        if (!empty($error)) {
            $this->session->set_flashdata('error', $error);
        } elseif (!empty($success)) {
            $this->session->set_flashdata('success', $success);
        }
        
        redirect('/');
    }
}
