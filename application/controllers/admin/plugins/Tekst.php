<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Tekst extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'teksts';
        $this->load->model('tekst_m');
        $this->data['page_title'] = 'teksts';
    }

    public function index()
    {

        $this->data['teksten'] = $this->tekst_m->get();
        $this->data['subview'] = 'admin/plugins/tekst/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a tekst or set a new one
        if ($id) {
            $this->data['tekst'] = $this->tekst_m->get($id);
            if(count($this->data['tekst']) == NULL)
            {
                $this->data['errors'] = 'tekst werd niet gevonden';
            }
        }
        else {
            $this->data['tekst'] = $this->tekst_m->get_new();
        }



        if($_POST)
        {
            $data = $this->tekst_m->array_from_post(array('naam', 'foto', 'titel', 'align'));

            $data['inhoud'] = $_POST['inhoud'];

            $this->tekst_m->save($data, $id);
            redirect('admin/plugins/tekst');
        }

        $this->data['align'] = $this->tekst_m->get_align();

        //load the form
        $this->data['subview'] = 'admin/plugins/tekst/edit';
        $this->load->view('admin/_layout_main', $this->data);


    }

    public function getStructure()
    {
        $arr_teksts = $this->tekst_m->get_all();
        $body = '';

        foreach ($arr_teksts as $id=>$tekst)
        {
            if($id > 0)
            {
                $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$id.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$tekst.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/tekst/delete/'.$id, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/tekst/edit/'. $id, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
                        </span>
                    </div>
                </li>
            ';
            }
        }

        return $body;
    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function volgorde_teksts()
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
            $this->tekst_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }
}