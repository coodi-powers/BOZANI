<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Interview extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Interviews';
        $this->load->model('interview_m');
        $this->data['page_title'] = 'Interviews';
    }

    public function index()
    {
        $this->data['interviews'] = $this->interview_m->get();
        $this->data['subview'] = 'admin/interviews/index';
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
        
        // fetch an interview or set a new one
        if ($id) {
            $this->data['interview'] = $this->interview_m->get($id);
            if(count($this->data['interview']) == NULL)
            {
                $this->data['errors'] = 'Interview werd niet gevonden';
            }
        }
        else {
            $this->data['interview'] = $this->interview_m->get_new();
        }

        if($_POST)
        {
            $data = $this->interview_m->array_from_post(array('naam', 'afbeelding', 'titel_nl', 'auteur', 'type'));
            $data['intro_nl'] = $_POST['intro_nl'];
            $data['inhoud_nl'] = $_POST['inhoud_nl'];

            $datum = new DateTime($_POST['datum']);
            $datum = $datum->format('Y-m-d');
            $data['datum'] = $datum;

            $this->interview_m->save($data, $id);
            redirect('admin/interview');
        }

        $this->data['arr_types'] = $this->interview_m->get_types();

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
        $this->data['subview'] = 'admin/interviews/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function delete($id)
    {
        $this->interview_m->delete($id);
        redirect('admin/interview');
    }
}