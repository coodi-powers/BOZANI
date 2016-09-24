<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 4/05/15
 * Time: 19:52
 */

class User extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Gebruikers';
        $this->data['page_title'] = 'Gebruikers';
    }

    public function index()
    {
        //fetch all users
        $this->data['users'] = $this->user_m->get();

        //load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a user or set a new one
        if ($id) {
            $this->data['user'] = $this->user_m->get($id);
            if(count($this->data['user']) == NULL)
            {
                $this->data['errors'] = 'User could not be found';
            }
        }
        else {
            $this->data['user'] = $this->user_m->get_new();
        }

        // set up the form
        $rules = $this->user_m->_rules_admin;
        if($id)
        {

        }
        else
        {
            $rules['wachtwoord']['rules'] .= '|required';
        }
        $this->form_validation->set_rules($rules);

        //process the form
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->user_m->array_from_post(array('username', 'email', 'wachtwoord'));
            if($data['wachtwoord'] != '')
            {
                $data['wachtwoord'] = $this->user_m->hash($data['wachtwoord']);
            }
            else
            {
                $data['wachtwoord'] = $this->data['user']->wachtwoord;
            }
            $data['role'] = '1';
            $this->user_m->save($data, $id);
            redirect('admin/user');
        }

        //load the form
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id)
    {
        $this->user_m->delete($id);
        redirect('admin/user');
    }

    public function login()
    {
        //redirect a user if he is already loggedin
        $dashboard = 'admin/dashboard';
        $this->user_m->loggedin() == FALSE || redirect($dashboard);

        $rules = $this->user_m->_rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == TRUE)
        {
            if($this->user_m->login() == TRUE)
            {
                redirect($dashboard);
            }
            else
            {
                $this->session->set_flashdata('error', 'That email/password combination does not exist');
                redirect('admin/user/login', 'refresh');
            }
        }

        //load the view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_login', $this->data);
    }

    public function logout()
    {
        $this->user_m->logout();
        redirect('admin/user/login');
    }

    public function _unique_email($str)
    {
        // do not validate if email already excists
        // unless it's the email for the current user
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('user_id !=', $id);
        $user = $this->user_m->get();

        if(count($user))
        {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }
}