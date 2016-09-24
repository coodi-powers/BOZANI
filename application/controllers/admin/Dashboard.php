<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Dashboard';
    }

    public function index()
    {
        $this->data['page_title'] = 'COODI Dashboard';

        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }
}