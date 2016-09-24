<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Partner_m extends MY_Model
{
    protected $_table_name = 'tbl_partners';
    protected $_table_box_name = 'tbl_partner_box';
    protected $_order_by = 'naam';
    protected $_primary_key = 'partner_id';

    public function get_new ()
    {
        $partner = new stdClass();
        $partner->naam = '';
        return $partner;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('partner_id, naam');
        $this->db->order_by($this->_order_by);
        $partners = parent::get();

        // Return key => value pair array
        if (count($partners)) {
            foreach ($partners as $partner) {
                $array[$partner->partner_id] = $partner->naam;
            }
        }

        return $array;
    }
    
}
