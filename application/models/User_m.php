<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 4/05/15
 * Time: 20:03
 */

class User_M extends MY_Model
{
    protected $_table_name      = "tbl_users";
    protected $_oder_by         = "username";
    protected $_primary_key     = "user_id";
    public $_rules           = array(
        'email' => array(
            'field'     => 'email',
            'label'     => 'Email',
            'rules'     => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field'     => 'password',
            'label'     => 'Wachtwoord',
            'rules'     => 'trim|required'
        )
    );

    public $_rules_admin      = array(
        'username' => array(
            'field'     => 'username',
            'label'     => 'Naam',
            'rules'     => 'trim|required|xss_clean'
        ),
        'email' => array(
            'field'     => 'email',
            'label'     => 'Email',
            'rules'     => 'trim|required|valid_email|callback__unique_email|xss_clean'
        ),
        'wachtwoord' => array(
            'field'     => 'wachtwoord',
            'label'     => 'Wachtwoord',
            'rules'     => 'trim'
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
            'wachtwoord'  => $this->hash($this->input->post('password')),
            'role'      => '1'
            ), TRUE);

        if(count($user))
        {
            $data = array(
                'username'      => $user->username,
                'email'         => $user->email,
                'user_id'       => $user->user_id,
                'loggedin'      => TRUE,
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
        return (bool) $this->session->userdata('loggedin');
    }

    public function get_new(){
        $user = new stdClass();
        $user->username = '';
        $user->email = '';
        $user->wachtwoord = '';
        return $user;
    }

    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}