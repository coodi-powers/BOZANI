<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Partners extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Partners';
        $this->load->model('partner_m');
        $this->load->model('partneritem_m');
        $this->load->model('partnerbox_m');
        $this->data['page_title'] = 'Partners';
    }

    public function index($partner_id = NULL)
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
                        $.post( \'' . base_url('index.php/admin/partners/volgorde_boxen') . '\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
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


        $this->data['partners'] = $this->partner_m->get();
        $this->data['partneritems'] = $this->partneritem_m->get();

        $this->data['partner_info'] = $this->partner_m->get_new();
        $this->data['partnerbox'] = array();
        if ($partner_id != NULL) {
            $this->data['partner_info'] = $this->partner_m->get($partner_id);
            $this->data['nested_structure'] = $this->getStructure($partner_id);
        }

        $this->data['subview'] = 'admin/partners/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {


        // fetch a nest or set a new one
        if ($id) {
            $this->data['partner'] = $this->partner_m->get($id);
            if (count($this->data['partner']) == NULL) {
                $this->data['errors'] = 'partner werd niet gevonden';
            }
        } else {
            $this->data['partner'] = $this->partner_m->get_new();
        }

        if ($_POST) {
            $data = $this->partner_m->array_from_post(array('naam'));

            $this->partner_m->save($data, $id);
            redirect('admin/partners');
        }

        //load the form
        $this->data['subview'] = 'admin/partners/edit';
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
            $this->data['partner_item'] = $this->partneritem_m->get($id);
            if (count($this->data['partner_item']) == NULL) {
                $this->data['errors'] = 'item werd niet gevonden';
            }
        } else {
            $this->data['partner_item'] = $this->partneritem_m->get_new();
        }

        if ($_POST) {
            $data = $this->partneritem_m->array_from_post(array('naam', 'foto', 'link'));

            $this->partneritem_m->save($data, $id);
            redirect('admin/partners');
        }

        //load the form
        $this->data['subview'] = 'admin/partners/edit_item';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function edit_box($partner_id)
    {
        $arr_linked = array();

        $linked_boxes = $this->partnerbox_m->get_box($partner_id);
        $all_boxes = $this->partneritem_m->get();

        foreach ($linked_boxes as $link) {
            array_push($arr_linked, $link->item_id);
        }

        if ($_POST) {
            foreach ($all_boxes as $box) {
                if (isset($_POST['checked_' . $box->item_id])) {
                    if ($_POST['checked_' . $box->item_id] == '1') {
                        if (!in_array($box->item_id, $arr_linked)) {

                            //toevoegen
                            $volgorde = $this->partnerbox_m->get_max_volgorde($partner_id);
                            $volgorde = $volgorde + 1;
                            $data['partner_id'] = $partner_id;
                            $data['item_id'] = $box->item_id;
                            $data['volgorde'] = $volgorde;
                            $this->partnerbox_m->save($data, NULL);
                        }
                    }
                } else {
                    if (in_array($box->item_id, $arr_linked)) {
                        //verwijderen
                        $this->partnerbox_m->delete_box($partner_id, $box->item_id);
                    }
                }
            }

            redirect('admin/partners/index/' . $partner_id);
        }

        $this->data['linked'] = $arr_linked;
        $this->data['all_boxes'] = $all_boxes;
        $this->data['partner_info'] = $this->partner_m->get($partner_id);

        $this->data['subview'] = 'admin/partners/box_edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function getStructure($partner_id)
    {
        $arr_items = $this->partnerbox_m->get_box($partner_id);
        $body = '';

        foreach ($arr_items as $item) {
            if ($item->link_id > 0) {
                $item_info = $this->partneritem_m->get($item->item_id);
                $body .= '
                <li class="dd-item dd-nodrag" data-id="' . $item->link_id . '">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">' . $item_info->naam . '</div>
                        <span class="pull-right">
                            <a href="' . anchor('admin/partners/delete_box/' . $item->link_id, '') . '"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
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
            $this->partnerbox_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }

    public function delete_box($link_id)
    {
        $item_info = $this->partnerbox_m->get($link_id);
        $this->partnerbox_m->delete_box($item_info->partner_id, $item_info->item_id);

        redirect('admin/partners/index/' . $item_info->partner_id);
    }
}