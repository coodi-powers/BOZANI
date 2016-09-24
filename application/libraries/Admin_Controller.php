<?php

class Admin_Controller extends MY_controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['meta_title'] = "My awesome CMS";
        $this->data['extra_js'] = "";
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_m');

        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'assets_admin/ckeditor/';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../../assets_admin/ckfinder/');

        // Login check
        $exception_uris = array(
            'admin/user/login',
            'admin/user/logout'
        );
        if(in_array(uri_string(), $exception_uris) == FALSE)
        {
            if($this->user_m->loggedin() == FALSE)
            {
                redirect('admin/user/login');
            }
        }
    }
}