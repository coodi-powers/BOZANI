<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Partneritem_m extends MY_Model
{
    protected $_table_name = 'tbl_partner_items';
    protected $_order_by = 'naam';
    protected $_primary_key = 'item_id';

    public function get_new ()
    {
        $partneritem = new stdClass();
        $partneritem->naam = '';
        $partneritem->foto = '';
        $partneritem->link = '';
        return $partneritem;
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
        $partneritems = parent::get();

        // Return key => value pair array
        if (count($partneritems)) {
            foreach ($partneritems as $partneritem) {
                $array[$partneritem->item_id] = $partneritem->naam;
            }
        }

        return $array;
    }
}
