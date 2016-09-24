<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Sliderbox_m extends MY_Model
{
    protected $_table_name = 'tbl_slider_box';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'link_id';

    public function get_new ()
    {
        $sliderbox = new stdClass();
        $sliderbox->slider_id = '';
        $sliderbox->item_id = '';
        return $sliderbox;
    }

    public function get_all ()
    {
        $this->db->select('link_id, item_id');
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

    public function get_box($slider_id)
    {
        $this->db->order_by($this->_order_by);
        $query = $this->db->get_where($this->_table_name, array('slider_id' => $slider_id));

        $sliders = $query->result();

        return $sliders;
    }

    public function delete_box($slider_id, $item_id)
    {
        $this->db->delete($this->_table_name, array('slider_id' => $slider_id, 'item_id' => $item_id));
    }

    public function delete_totaalbox($slider_id)
    {
        $this->db->delete($this->_table_name, array('slider_id' => $slider_id));
    }

    public function save_order ($link_id, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $link_id)->update($this->_table_name);
    }

    public function get_max_volgorde($slider_id)
    {
        $this->db->select_max('volgorde');
        $query = $this->db->get_where($this->_table_name, array('slider_id' => $slider_id));

        $max = $query->row();
        $max = $max->volgorde;

        return $max;
    }

    public function check_item_linked($item_id)
    {
        $this->db->where('item_id', $item_id);
        $this->db->order_by($this->_order_by);
        $items = parent::get();

        // Return key => value pair array
        if (count($items)) {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
