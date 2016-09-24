<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Link_m extends MY_Model
{
    protected $_table_name = 'tbl_links';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'link_id';
    public $_rules = array();

    public function get_new ()
    {
        $link = new stdClass();
        $link->naam = '';
        $link->link = '';
        $link->foto = '';
        $link->volgorde = '';
        return $link;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('link_id, naam');
        $this->db->order_by($this->_order_by);
        $linken = parent::get();

        $array = array(
            0 => 'Geen link'
        );
        // Return key => value pair array
        if (count($linken)) {
            foreach ($linken as $link) {
                $array[$link->link_id] = $link->naam;
            }
        }

        return $array;
    }

    public function get_max_volgorde()
    {
        $this->db->select_max('volgorde');
        $max = parent::get();

        return $max;
    }

    public function save_order ($link, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $link)->update($this->_table_name);
    }
}
