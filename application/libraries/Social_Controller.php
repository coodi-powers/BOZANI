<?php

class Social_Controller extends MY_controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['meta_title'] = "My awesome CMS";
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_social_m');

        // Login check
        $exception_uris = array(
            'social/user/login',
            'social/user/logout'
        );
        if(in_array(uri_string(), $exception_uris) == FALSE)
        {
            if($this->user_social_m->loggedin() == FALSE)
            {
                redirect('admin/user/login');
            }
        }
    }
}