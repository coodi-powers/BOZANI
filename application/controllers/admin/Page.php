<?php
/**
 * Created by PhpStorm.
 * page: bartbollen
 * Date: 4/05/15
 * Time: 19:52
 */

class Page extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('menu_m');
        $this->load->model('pageplugin_m');
        $this->load->model('sliderbox_m');
        $this->data['submenu'] = '';
        $this->data['title'] = 'Pagina\'s';
        $this->data['page_title'] = 'Pagina\'s';
    }

    public function index($pagina_id = 0)
    {
        if($pagina_id != NULL)
        {
            $this->data['page_info'] = $this->page_m->get($pagina_id);
        }
        else
        {
            $this->data['page_info'] = $this->page_m->get_new();
        }

        //fetch all pages
        $this->data['pages'] = $this->page_m->get_with_parent();

        
        //extra js
        $this->data['extra_js'] = '
        <script src=\''.base_url('assets_admin/js/plugins/nestable/jquery.nestable.js') .'\'></script>
        
        <script>
            $(document).ready(function(){
        
                var updateOutput = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/page/volgorde_plugins').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 
                $(\'#nestable\').nestable().on(\'change\', updateOutput);
        
                updateOutput($(\'#nestable\').data(\'output\', $(\'#nestable-output\')));
        
        
        
                var updateOutput2 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/page/volgorde_paginas').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 2
                $(\'#nestable2\').nestable().on(\'change\', updateOutput2);
        
                updateOutput2($(\'#nestable2\').data(\'output\', $(\'#nestable2-output\')));
        
                });
        
        </script>
        ';
        $this->data['nested_structure'] = $this->getStructure(0);



        //extra js
        $this->data['extra_js'] .= '
        <script>
            $(document).ready(function(){
        
                var updateOutput3 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/page/volgorde_plugins').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 2
                $(\'#nestable3\').nestable().on(\'change\', updateOutput3);
        
                updateOutput3($(\'#nestable\').data(\'output\', $(\'#nestable-output\')));
        
                });
        
        </script>
        ';
        $this->data['nested_structure_plugins'] = $this->plugins_getStructure($pagina_id);

        //load view
        $this->data['subview'] = 'admin/page/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    
    public function getStructure($pagina_id)
    {
        $arr_pages = $this->page_m->get_children($pagina_id);
        $body = '';
        
        foreach ($arr_pages as $key=>$page_name)
        {
            $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$key.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$page_name.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/page/delete/'.$key, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/page/edit/'. $key, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
                            <a href="'.anchor('admin/page/index/'. $key, '').'"><span class="label label-default pull-right"><i class="fa fa-puzzle-piece"></i></span></a>
                        </span>
                    </div>';


            if($this->page_m->get_children($key) != 'no-children')
            {

                $body .= '<ol class=\'dd-list\'>';
                $body .= $this->getStructure($key);
                $body .= '</ol>';
            }

            $body .= '
                </li>
            ';
        }

        return $body;
    }
    

    public function order()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function volgorde_paginas()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode($json_decode);
    }

    //volgorde paginas uitlezen
    public function decode($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->page_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;

            if($item->children != '')
            {
                $volgorde = 1;
                //alle kinderen nieuwe parent geven
                foreach($item->children as $child)
                {
                    $this->page_m->save_order($child->id, $volgorde);
                    $volgorde ++;

                    $this->page_m->save_parent($child->id, $item->id);
                }

                $this->decode($item->children);
            }
        }
    }

    public function edit($id = NULL)
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'../../assets_admin/ckeditor/';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets_admin/ckfinder/');

        // fetch a page or set a new one
        if ($id) {
            $this->data['page'] = $this->page_m->get($id);
            if(count($this->data['page']) == NULL)
            {
                $this->data['errors'] = 'page could not be found';
            }
        }
        else {
            $this->data['page'] = $this->page_m->get_new();
        }

        //pages for dropdown
        $this->data['pages_no_parent'] = $this->page_m->get_all();

        //Get all menus
        $this->data['menus'] = $this->menu_m->get_all();

        //$this->data['pages_no_parent'] = '';


        // set up the form
        //$rules = $this->page_m->_rules;
        //$this->form_validation->set_rules($rules);

        //process the form

        if($_POST)
        {
            $data = $this->page_m->array_from_post(array('title', 'slug', 'parent_id', 'menu', 'naam', 'template', 'afbeelding', 'title2'));
            $data['body'] = $_POST['body'];
            $this->page_m->save($data, $id);


            if($id == NULL)
            {
                $id = $this->db->insert_id();
                $plugin_data['pagina_id'] = $id;
                $plugin_data['type_id'] = '1';
                $this->pageplugin_m->save($plugin_data, NULL);
            }
            redirect('admin/page');
        }

        /*
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->page_m->array_from_post(array('title', 'slug', 'body', 'parent_id', 'template'));
            $this->page_m->save($data, $id);
            redirect('admin/page');
        }
        */

        //load the form
        $this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function delete($id)
    {
        $this->page_m->delete($id);
        redirect('admin/page');
    }

    public function delete_box($id)
    {
        $plugin = $this->pageplugin_m->get($id);
        $pid = $plugin->pagina_id;

        $this->pageplugin_m->delete($id);

        redirect('admin/page/index/'.$pid);
    }

    public function _unique_slug($str)
    {
        // do not validate if slug already excists
        // unless it's the slug for the current page
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        $page = $this->page_m->get();

        if(count($page))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }

    public function plugins_getStructure($pagina_id)
    {
        $arr_items = $this->pageplugin_m->get_all_page($pagina_id);
        $body = '';

        foreach ($arr_items as $item) {
            if ($item->link_id > 0) {
                $item_info = $this->pageplugin_m->get($item->link_id);
                if($item->plugin_id > 0)
                {
                    $naam = $this->pageplugin_m->get_item_name($item->link_id);
                }
                else
                {
                    $naam = "DEFAULT CONTENT";
                }
                $body .= '
                <li class="dd-item dd-nodrag" data-id="' . $item->link_id . '">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">' . $naam . '</div>';

                if($item->plugin_id > 0)
                {
                    $body .= '
                        <span class="pull-right">
                            <a href="' . anchor('admin/page/delete_box/' . $item->link_id, '') . '"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                        </span>';
                }

                $body .= '
                    </div>
                </li>
            ';
            }
        }

        return $body;
    }

    public function volgorde_plugins()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode_plugins($json_decode);
    }

    //volgorde uitlezen
    public function decode_plugins($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->pageplugin_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }

    public function edit_plugins($pagina_id)
    {
        $arr_linked = array();

        $linked_plugins = $this->pageplugin_m->get_all_page($pagina_id);
        $all_plugins = $this->pageplugin_m->get_all_plugins();

        foreach ($linked_plugins as $link) {
            array_push($arr_linked, $link->type_id .'_'. $link->plugin_id);
        }


        if ($_POST) {
            foreach ($all_plugins as $plugins) {
                if (isset($_POST['checkedPlugin_'.$plugins['type_id'].'_'.$plugins['plugin_id']]))
                {
                    if ($_POST['checkedPlugin_'.$plugins['type_id'].'_'.$plugins['plugin_id']] == '1') {
                        if (!in_array($plugins['type_id'].'_'.$plugins['plugin_id'], $arr_linked))
                        {
                            //toevoegen
                            $volgorde = $this->pageplugin_m->get_max_volgorde($pagina_id);
                            $volgorde = $volgorde + 1;
                            $data['pagina_id'] = $pagina_id;
                            $data['plugin_id'] = $plugins['plugin_id'];
                            $data['type_id'] = $plugins['type_id'];
                            $data['volgorde'] = $volgorde;
                            $this->pageplugin_m->save($data, NULL);

                        }
                    }
                }
                else
                {
                    if (in_array($plugins['type_id'].'_'.$plugins['plugin_id'], $arr_linked)) {
                        //verwijderen
                        $this->pageplugin_m->delete_link($pagina_id, $plugins['plugin_id']);
                    }
                }
            }

            redirect('admin/page/index/' . $pagina_id);
        }
        else
        {
            $this->data['linked'] = $arr_linked;
            $this->data['all_plugins'] = $all_plugins;
            $this->data['pagina_info'] = $this->page_m->get($pagina_id);

            $this->data['subview'] = 'admin/page/plugins_edit';
            $this->load->view('admin/_layout_main', $this->data);
        }
    }
}