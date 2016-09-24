<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Fokdieren extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'fokdieren';
        $this->load->model('fokdieren_m');
        $this->data['page_title'] = 'Fokdieren';
    }

    public function index()
    {
        $this->data['fokdieren'] = $this->fokdieren_m->get();
        $this->data['subview'] = 'admin/fokdieren/index';
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

        
        // fetch a nest or set a new one
        if ($id) {
            $this->data['fokdier'] = $this->fokdieren_m->get($id);
            if(count($this->data['fokdier']) == NULL)
            {
                $this->data['errors'] = 'fokdier werd niet gevonden';
            }
        }
        else {
            $this->data['fokdier'] = $this->fokdieren_m->get_new();
        }

        if($_POST)
        {
            $data = $this->fokdieren_m->array_from_post(array('naam', 'foto', 'geslacht', 'kleur', 'afkomst'));

            $datum = new DateTime($_POST['geboortedatum']);
            $datum = $datum->format('Y-m-d');
            $data['geboortedatum'] = $datum;

            $this->fokdieren_m->save($data, $id);
            redirect('admin/fokdieren');
        }

        $this->data['geslachten'] = $this->fokdieren_m->get_geslachten();

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
        $this->data['subview'] = 'admin/fokdieren/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function getStructure()
    {
        $arr_nesten = $this->fokdieren_m->get_all();
        $body = '';

        foreach ($arr_nesten as $id=>$nest)
        {
            $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$id.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$nest.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/nest/delete/'.$id, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/nest/edit/'. $id, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
                            <a href="#"><span class="label label-default pull-right"><i class="fa fa-list-ul"></i></span></a>
                        </span>
                    </div>
                </li>
            ';
        }

        return $body;
    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function volgorde_nesten()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode($json_decode);
    }

    //volgorde uitlezen
    public function decode($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->fokdieren_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }
}