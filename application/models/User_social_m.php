<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 4/05/15
 * Time: 20:03
 */

class User_Social_M extends MY_Model
{
    protected $_table_name      = "users";
    protected $_oder_by         = "name";
    public $_rules           = array(
        'email' => array(
            'field'     => 'email',
            'label'     => 'Email',
            'rules'     => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field'     => 'password',
            'label'     => 'Password',
            'rules'     => 'trim|required'
        )
    );

    public $_rules_admin      = array(
        'name' => array(
            'field'     => 'name',
            'label'     => 'Name',
            'rules'     => 'trim|required|xss_clean'
        ),
        'email' => array(
            'field'     => 'email',
            'label'     => 'Email',
            'rules'     => 'trim|required|valid_email|callback__unique_email|xss_clean'
        ),
        'password' => array(
            'field'     => 'password',
            'label'     => 'Password',
            'rules'     => 'trim|matches[password_confirm]'
        ),
        'password_confirm' => array(
            'field'     => 'password_confirm',
            'label'     => 'Confirm Password',
            'rules'     => 'trim|matches[password]'
        ),
    );

    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $user = $this->get_by_original(array(
            'email'     => $this->input->post('email'),
            'password'  => $this->hash($this->input->post('password')),
            ), TRUE);

        if(count($user))
        {
            $data = array(
                'name'      => $user->name,
                'email'     => $user->email,
                'id'        => $user->id,
                'loggedin'  => TRUE,
            );

            $this->session->set_userdata($data);
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
    }

    public function loggedin()
    {
        $arr_roles = array('1', '2');

        $user = $this->get_by_original(array(
            'email'     => $this->session->userdata('email'),
            'name'  => $this->session->userdata('name'),
            'id'  => $this->session->userdata('id'),
        ), TRUE);

        if(count($user))
        {
            if(in_array($user->role, $arr_roles))
            {
                return (bool) $this->session->userdata('loggedin');
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function get_new(){
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->password = '';
        return $user;
    }

    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}