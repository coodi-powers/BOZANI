<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Nest extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Nesten';
        $this->load->model('nest_m');
        $this->data['page_title'] = 'Nesten';
    }

    public function index()
    {
        //extra js
        $this->data['extra_js'] = '
        <script src=\''.base_url('assets_admin/js/plugins/nestable/jquery.nestable.js') .'\'></script>
        
        <script>
            $(document).ready(function(){
        
                var updateOutput2 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/nest/volgorde_nesten').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
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

        $this->data['nested_structure'] = $this->getStructure();
        $this->data['subview'] = 'admin/nest/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a nest or set a new one
        if ($id) {
            $this->data['nest'] = $this->nest_m->get($id);
            if(count($this->data['nest']) == NULL)
            {
                $this->data['errors'] = 'Nest werd niet gevonden';
            }
        }
        else {
            $this->data['nest'] = $this->nest_m->get_new();
        }

        if($_POST)
        {
            $data = $this->nest_m->array_from_post(array('naam_vader', 'naam_moeder', 'foto'));

            if($this->data['nest']->volgorde == '')
            {
                $max = $this->nest_m->get_max_volgorde();
                $max = $max[0]->volgorde;

                $volgorde = $max + 1;
                $data['volgorde'] = $volgorde;
            }

            $datum = new DateTime($_POST['geboortedatum']);
            $datum = $datum->format('Y-m-d');
            $data['geboortedatum'] = $datum;

            $datum = new DateTime($_POST['beschikbaar']);
            $datum = $datum->format('Y-m-d');
            $data['beschikbaar'] = $datum;

            $this->nest_m->save($data, $id);
            redirect('admin/nest');
        }

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
        $this->data['subview'] = 'admin/nest/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function getStructure()
    {
        $arr_nesten = $this->nest_m->get_all();
        $body = '';

        foreach ($arr_nesten as $id=>$nest)
        {
            if($id > 0)
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
            $this->nest_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }
}