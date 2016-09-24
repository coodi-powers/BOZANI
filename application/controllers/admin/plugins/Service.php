<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Service extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'services';
        $this->load->model('service_m');
        $this->data['page_title'] = 'services';
    }

    public function index()
    {

        $this->data['services'] = $this->service_m->get();
        $this->data['subview'] = 'admin/plugins/service/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a service or set a new one
        if ($id) {
            $this->data['service'] = $this->service_m->get($id);
            if(count($this->data['service']) == NULL)
            {
                $this->data['errors'] = 'service werd niet gevonden';
            }
        }
        else {
            $this->data['service'] = $this->service_m->get_new();
        }



        if($_POST)
        {
            $data = $this->service_m->array_from_post(array('naam', 'titel', 'icon_1', 'titel_1', 'inhoud_1', 'icon_2', 'titel_2', 'inhoud_2', 'icon_3', 'titel_3', 'inhoud_3'));

            $data['inhoud'] = $_POST['inhoud'];

            $this->service_m->save($data, $id);
            redirect('admin/plugins/service');
        }

        //load the form
        $this->data['subview'] = 'admin/plugins/service/edit';
        $this->load->view('admin/_layout_main', $this->data);


    }
}