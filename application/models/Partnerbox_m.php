<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Partnerbox_m extends MY_Model
{
    protected $_table_name = 'tbl_partner_box';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'link_id';

    public function get_new ()
    {
        $partnerbox = new stdClass();
        $partnerbox->partner_id = '';
        $partnerbox->item_id = '';
        return $partnerbox;
    }

    public function get_all ()
    {
        $this->db->select('link_id, item_id');
        $this->db->order_by($this->_order_by);
        $partnerboxes = parent::get();

        // Return key => value pair array
        if (count($partnerboxes)) {
            foreach ($partnerboxes as $partnerbox) {
                $array[$partnerbox->box_id] = $partnerbox->naam;
            }
        }

        return $array;
    }

    public function get_box($partner_id)
    {
        $this->db->order_by($this->_order_by);
        $query = $this->db->get_where($this->_table_name, array('partner_id' => $partner_id));

        $partners = $query->result();

        return $partners;
    }

    public function delete_box($partner_id, $item_id)
    {
        $this->db->delete($this->_table_name, array('partner_id' => $partner_id, 'item_id' => $item_id));
    }

    public function save_order ($link_id, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $link_id)->update($this->_table_name);
    }

    public function get_max_volgorde($partner_id)
    {
        $this->db->select_max('volgorde');
        $query = $this->db->get_where($this->_table_name, array('partner_id' => $partner_id));

        $max = $query->row();
        $max = $max->volgorde;

        return $max;
    }
}
