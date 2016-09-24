<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Tekst_m extends MY_Model
{
    protected $_table_name = 'tbl_tekst';
    protected $_order_by = 'naam';
    protected $_primary_key = 'tekst_id';
    public $_rules = array();

    public function get_new ()
    {
        $tekst = new stdClass();
        $tekst->naam = '';
        $tekst->titel = '';
        $tekst->inhoud = '';
        $tekst->foto = '';
        return $tekst;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('tekst_id, naam');
        $this->db->order_by($this->_order_by);
        $teksten = parent::get();

        $array = array(
            0 => 'Geen tekst'
        );
        // Return key => value pair array
        if (count($teksten)) {
            foreach ($teksten as $tekst) {
                $array[$tekst->tekst_id] = $tekst->naam;
            }
        }

        return $array;
    }

    public function get_align ()
    {
        $array = array();

        $array['left'] = "Links";
        $array['center'] = "Midden";
        $array['right'] = "Rechts";

        return $array;
    }

    /*
    public function get_max_volgorde()
    {
        $this->db->select_max('volgorde');
        $max = parent::get();

        return $max;
    }

    public function save_order ($tekst, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $tekst)->update($this->_table_name);
    }
    */
}
