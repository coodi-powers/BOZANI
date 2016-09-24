<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Link extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'links';
        $this->load->model('link_m');
        $this->data['page_title'] = 'links';
    }

    public function index()
    {
        //extra js
        $this->data['extra_js'] = '
        <script src=\''.base_url('assets_admin/js/plugins/linkable/jquery.linkable.js') .'\'></script>
        
        <script>
            $(document).ready(function(){
        
                var updateOutput2 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/link/volgorde_links').'\', { testvalue: (window.JSON.stringify(list.linkable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate linkable for list 2
                $(\'#linkable2\').linkable({maxDepth: 1 }).on(\'change\', updateOutput2);
        
                updateOutput2($(\'#linkable2\').data(\'output\', $(\'#linkable2-output\')));
        
                });
        
        </script>
        ';

        $this->data['nested_structure'] = $this->getStructure();
        $this->data['subview'] = 'admin/link/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a link or set a new one
        if ($id) {
            $this->data['link'] = $this->link_m->get($id);
            if(count($this->data['link']) == NULL)
            {
                $this->data['errors'] = 'link werd niet gevonden';
            }
        }
        else {
            $this->data['link'] = $this->link_m->get_new();
        }



        if($_POST)
        {
            $data = $this->link_m->array_from_post(array('naam', 'link', 'foto'));

            if($this->data['link']->volgorde == '')
            {
                $max = $this->link_m->get_max_volgorde();
                $max = $max[0]->volgorde;

                $volgorde = $max + 1;
                $data['volgorde'] = $volgorde;
            }

            $this->link_m->save($data, $id);
            redirect('admin/link');
        }

        //load the form
        $this->data['subview'] = 'admin/link/edit';
        $this->load->view('admin/_layout_main', $this->data);


    }

    public function getStructure()
    {
        $arr_links = $this->link_m->get_all();
        $body = '';

        foreach ($arr_links as $id=>$link)
        {
            if($id > 0)
            {
                $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$id.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$link.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/link/delete/'.$id, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/link/edit/'. $id, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
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

    public function volgorde_links()
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
            $this->link_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }
}