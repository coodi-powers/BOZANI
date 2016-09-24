<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Reportage extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Fotoreportages';
        $this->load->model('reportage_m');
        $this->data['page_title'] = 'Fotoreportages';
    }

    public function index()
    {
        $this->data['reportages'] = $this->reportage_m->get();
        $this->data['subview'] = 'admin/reportages/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'../../asset/ckeditor/';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets_admin/ckfinder/');

        
        // fetch an reportage or set a new one
        if ($id) {
            $this->data['reportage'] = $this->reportage_m->get($id);
            if(count($this->data['reportage']) == NULL)
            {
                $this->data['errors'] = 'reportage werd niet gevonden';
            }
        }
        else {
            $this->data['reportage'] = $this->reportage_m->get_new();
        }

        if($_POST)
        {
            $data = $this->reportage_m->array_from_post(array('naam', 'afbeelding', 'titel_nl', 'album', 'auteur', 'type'));
            $data['intro_nl'] = $_POST['intro_nl'];
            $data['inhoud_nl'] = $_POST['inhoud_nl'];

            $datum = new DateTime($_POST['datum']);
            $datum = $datum->format('Y-m-d');
            $data['datum'] = $datum;

            $this->reportage_m->save($data, $id);
            redirect('admin/reportage');
        }

        $this->data['arr_types'] = $this->reportage_m->get_types();

        $this->data['extra_js'] = '
        <script>
            $(".datepicker").datepicker({
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                });
        </script>
        ';

        //load the form
        $this->data['subview'] = 'admin/reportages/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function delete($id)
    {
        $this->reportage_m->delete($id);
        redirect('admin/reportage');
    }
}