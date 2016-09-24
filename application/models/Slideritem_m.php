<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Slideritem_m extends MY_Model
{
    protected $_table_name = 'tbl_slider_items';
    protected $_order_by = 'naam';
    protected $_primary_key = 'item_id';

    public function get_new ()
    {
        $slideritem = new stdClass();
        $slideritem->naam = '';
        $slideritem->tekst = '';
        $slideritem->foto = '';
        $slideritem->link = '';
        return $slideritem;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('item_id, naam');
        $this->db->order_by($this->_order_by);
        $slideritems = parent::get();

        // Return key => value pair array
        if (count($slideritems)) {
            foreach ($slideritems as $slideritem) {
                $array[$slideritem->item_id] = $slideritem->naam;
            }
        }

        return $array;
    }
}
