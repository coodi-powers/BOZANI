<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Slider_m extends MY_Model
{
    protected $_table_name = 'tbl_sliders';
    protected $_table_box_name = 'tbl_slider_box';
    protected $_order_by = 'naam';
    protected $_primary_key = 'slider_id';

    public function get_new ()
    {
        $slider = new stdClass();
        $slider->naam = '';
        return $slider;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('slider_id, naam');
        $this->db->order_by($this->_order_by);
        $sliders = parent::get();

        // Return key => value pair array
        if (count($sliders)) {
            foreach ($sliders as $slider) {
                $array[$slider->slider_id] = $slider->naam;
            }
        }

        return $array;
    }
    
}
