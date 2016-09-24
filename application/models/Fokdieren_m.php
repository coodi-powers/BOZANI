<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Fokdieren_m extends MY_Model
{
    protected $_table_name = 'tbl_fokdieren';
    protected $_order_by = 'naam';
    protected $_primary_key = 'fokdier_id';
    public $_rules = array();

    public function get_new ()
    {
        $fokdier = new stdClass();
        $fokdier->naam = '';
        $fokdier->geslacht = '';
        $fokdier->kleur = '';
        $fokdier->foto = '';
        $fokdier->geboortedatum = date('d-m-Y');
        $fokdier->afkomst = '';
        return $fokdier;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('fokdier_id, naam');
        $this->db->order_by($this->_order_by);
        $fokdieren = parent::get();

        // Return key => value pair array
        if (count($fokdieren)) {
            foreach ($fokdieren as $fokdier) {
                $array[$fokdier->fokdier_id] = $fokdier->naam;
            }
        }

        return $array;
    }

    public function get_geslachten ()
    {
        $array = array();

        $array['m'] = "Mannelijk";
        $array['f'] = "Vrouwelijk";

        return $array;
    }
}
