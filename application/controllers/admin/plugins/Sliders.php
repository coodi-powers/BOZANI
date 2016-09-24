<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Sliders extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Sliders';
        $this->load->model('slider_m');
        $this->load->model('slideritem_m');
        $this->load->model('sliderbox_m');
        $this->data['page_title'] = 'Sliders';
    }

    public function index($slider_id = NULL)
    {
        $this->data['extra_js'] = '
        <script src=\'' . base_url('assets_admin/js/plugins/nestable/jquery.nestable.js') . '\'></script>
        
        <script>
            $(document).ready(function(){
        
                var updateOutput2 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \'' . base_url('index.php/admin/plugins/sliders/volgorde_boxen') . '\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 2
                $(\'#nestable2\').nestable({maxDepth: 1 }).on(\'change\', updateOutput2);
        
                updateOutput2($(\'#nestable2\').data(\'output\', $(\'#nestable2-output\')));
        
                });
        
        </script>
        ';


        $this->data['sliders'] = $this->slider_m->get();
        $this->data['slideritems'] = $this->slideritem_m->get();

        $this->data['slider_info'] = $this->slider_m->get_new();
        $this->data['sliderbox'] = array();
        if ($slider_id != NULL) {
            $this->data['slider_info'] = $this->slider_m->get($slider_id);
            $this->data['nested_structure'] = $this->getStructure($slider_id);
        }

        $this->data['subview'] = 'admin/plugins/sliders/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {


        // fetch a nest or set a new one
        if ($id) {
            $this->data['slider'] = $this->slider_m->get($id);
            if (count($this->data['slider']) == NULL) {
                $this->data['errors'] = 'slider werd niet gevonden';
            }
        } else {
            $this->data['slider'] = $this->slider_m->get_new();
        }

        if ($_POST) {
            $data = $this->slider_m->array_from_post(array('naam'));

            $this->slider_m->save($data, $id);
            redirect('admin/plugins/sliders');
        }

        //load the form
        $this->data['subview'] = 'admin/plugins/sliders/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }




    //--ITEMS----------------------------------
    //-----------------------------------------


    public function edit_item($id = NULL)
    {

        // fetch a nest or set a new one
        if ($id) {
            $this->data['slider_item'] = $this->slideritem_m->get($id);
            if (count($this->data['slider_item']) == NULL) {
                $this->data['errors'] = 'item werd niet gevonden';
            }
        } else {
            $this->data['slider_item'] = $this->slideritem_m->get_new();
        }

        if ($_POST) {
            $data = $this->slideritem_m->array_from_post(array('naam', 'foto', 'link', 'tekst'));

            $this->slideritem_m->save($data, $id);
            redirect('admin/plugins/sliders');
        }

        //load the form
        $this->data['subview'] = 'admin/plugins/sliders/edit_item';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function edit_box($slider_id)
    {
        $arr_linked = array();

        $linked_boxes = $this->sliderbox_m->get_box($slider_id);
        $all_boxes = $this->slideritem_m->get();

        foreach ($linked_boxes as $link) {
            array_push($arr_linked, $link->item_id);
        }

        if ($_POST) {
            foreach ($all_boxes as $box) {
                if (isset($_POST['checked_' . $box->item_id])) {
                    if ($_POST['checked_' . $box->item_id] == '1') {
                        if (!in_array($box->item_id, $arr_linked)) {

                            //toevoegen
                            $volgorde = $this->sliderbox_m->get_max_volgorde($slider_id);
                            $volgorde = $volgorde + 1;
                            $data['slider_id'] = $slider_id;
                            $data['item_id'] = $box->item_id;
                            $data['volgorde'] = $volgorde;
                            $this->sliderbox_m->save($data, NULL);
                        }
                    }
                } else {
                    if (in_array($box->item_id, $arr_linked)) {
                        //verwijderen
                        $this->sliderbox_m->delete_box($slider_id, $box->item_id);
                    }
                }
            }

            redirect('admin/plugins/sliders/index/' . $slider_id);
        }

        $this->data['linked'] = $arr_linked;
        $this->data['all_boxes'] = $all_boxes;
        $this->data['slider_info'] = $this->slider_m->get($slider_id);

        $this->data['subview'] = 'admin/plugins/sliders/box_edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function getStructure($slider_id)
    {
        $arr_items = $this->sliderbox_m->get_box($slider_id);
        $body = '';

        foreach ($arr_items as $item) {
            if ($item->link_id > 0) {
                $item_info = $this->slideritem_m->get($item->item_id);
                $body .= '
                <li class="dd-item dd-nodrag" data-id="' . $item->link_id . '">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">' . $item_info->naam . '</div>
                        <span class="pull-right">
                            <a href="' . anchor('admin/plugins/sliders/delete_box/' . $item->link_id, '') . '"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                        </span>
                    </div>
                </li>
            ';
            }
        }

        return $body;
    }

    public function volgorde_boxen()
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
            $this->sliderbox_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }

    public function delete_box($link_id)
    {
        $item_info = $this->sliderbox_m->get($link_id);
        $this->sliderbox_m->delete_box($item_info->slider_id, $item_info->item_id);

        redirect('admin/plugins/sliders/index/' . $item_info->slider_id);
    }
    
    public function delete($id)
    {
        $this->slider_m->delete($id);
        $this->sliderbox_m->delete_totaalbox($id);

        redirect('admin/plugins/sliders/index/');
    }

    public function delete_item($id)
    {
        $check = $this->sliderbox_m->check_item_linked($id);
        if($check == FALSE)
        {
            $this->slideritem_m->delete($id);
        }
        redirect('admin/plugins/sliders/index/');
    }
}