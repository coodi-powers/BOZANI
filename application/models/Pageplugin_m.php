<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Pageplugin_m extends MY_Model
{
    protected $_table_name = 'tbl_pagina_plugins';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'link_id';

    public function get_new ()
    {
        $pageplugin = new stdClass();
        $pageplugin->pagina_id = '';
        $pageplugin->type_id = '';
        $pageplugin->plugin_id = '';
        return $pageplugin;
    }

    public function get_all ()
    {
        $this->db->select('link_id, pagina_id');
        $this->db->order_by($this->_order_by);
        $sliderboxes = parent::get();

        // Return key => value pair array
        if (count($sliderboxes)) {
            foreach ($sliderboxes as $sliderbox) {
                $array[$sliderbox->box_id] = $sliderbox->naam;
            }
        }

        return $array;
    }

    public function get_all_page($pagina_id)
    {
        $this->db->order_by($this->_order_by);
        $query = $this->db->get_where($this->_table_name, array('pagina_id' => $pagina_id));

        $plugins = $query->result();

        return $plugins;
    }

    public function delete_link($pagina_id, $plugin_id)
    {
        $this->db->delete($this->_table_name, array('pagina_id' => $pagina_id, 'plugin_id' => $plugin_id));
    }

    public function save_order ($link_id, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $link_id)->update($this->_table_name);
    }

    public function get_max_volgorde($pagina_id)
    {
        $this->db->select_max('volgorde');
        $query = $this->db->get_where($this->_table_name, array('pagina_id' => $pagina_id));

        $max = $query->row();
        $max = $max->volgorde;

        return $max;
    }

    public function get_all_plugins()
    {
        $arr_plugins = array();
        $this->db->select('type_id, naam, tabel, field_id');
        $this->db->order_by('naam');
        $types = $this->db->get('tbl_plugin_types');

        $types = $types->result();

        foreach ($types as $type)
        {
            if($type->tabel != '')
            {
                $this->db->select($type->field_id.', naam');
                $this->db->order_by('naam');
                $plugins = $this->db->get($type->tabel);

                $plugins = $plugins->result();

                foreach ($plugins as $plugin)
                {
                    $temp_id = $type->field_id;
                    $arr_temp = array(
                        'type_id' => $type->type_id,
                        'plugin_id'=> $plugin->$temp_id,
                        'title'=>$plugin->naam,
                        'type_naam'=>$type->naam
                    );
                    array_push($arr_plugins, $arr_temp);
                }
            }
        }

        return $arr_plugins;
    }

    public function get_item_name($link_id)
    {
        $item_info = $this->get($link_id);
        $query = $this->db->get_where('tbl_plugin_types', array('type_id' => $item_info->type_id), '', '');
        $type = $query->result();
        $type = $type[0];

        $query = $this->db->get_where($type->tabel, array($type->field_id => $item_info->plugin_id), '', '');
        $info = $query->result();
        $info = $info[0];


        return $info->naam;
    }
}
