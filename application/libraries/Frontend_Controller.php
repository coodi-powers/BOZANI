<?php

class Frontend_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        //load stuff
        $this->load->model('page_m');
        $this->load->helper('form');

        //fetch navigation
        //$this->data['menu'] = $this->page_m->get_nested(1);
    }
}