<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Konijnen_m extends MY_Model
{
    protected $_table_name = 'tbl_konijnen';
    protected $_order_by = 'naam';
    protected $_primary_key = 'konijn_id';
    public $_rules = array(
        'naam' => array(
            'field' => 'naam',
            'label' => 'Naam',
            'rules' => 'trim|xss_clean|required|max_length[100]'
        ),
        'nest_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent',
            'rules' => 'trim|intval'
        ),
        'foto' => array(
            'field' => 'foto',
            'label' => 'Foto',
            'rules' => 'trim|xss_clean|max_length[250]'
        ),
        'beschrijving' => array(
            'field' => 'beschrijving',
            'label' => 'Beschrijving',
            'rules' => 'trim|xss_clean'
        ),
        'prijs' => array(
            'field' => 'prijs',
            'label' => 'Prijs',
            'rules' => 'trim|xss_clean'
        )
    );

    public function get_new ()
    {
        $konijn = new stdClass();
        $konijn->naam = '';
        $konijn->nest_id = '';
        $konijn->prijs = '';
        $konijn->foto = '';
        $konijn->beschrijving = '';
        $konijn->moeder = '';
        $konijn->vader = '';
        $konijn->geboortedatum = date('d-m-Y');
        $konijn->beschikbaar = date('d-m-Y');
        $konijn->geslacht = '';
        $konijn->gereserveerd = '';
        return $konijn;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('konijn_id, naam');
        $this->db->order_by($this->_order_by);
        $konijnen = parent::get();

        // Return key => value pair array
        if (count($konijnen)) {
            foreach ($konijnen as $konijn) {
                $array[$konijn->konijn_id] = $konijn->naam;
            }
        }

        return $array;
    }

    public function get_nest ($nest_id)
    {
        $this->db->where('nest_id', $nest_id);
        $this->db->order_by($this->_order_by);
        $konijnen = parent::get();

        // Return key => value pair array
        if (count($konijnen)) {
            foreach ($konijnen as $konijn) {
                $array[$konijn->konijn_id] = $konijn;
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
