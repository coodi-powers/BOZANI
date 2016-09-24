<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Nest_m extends MY_Model
{
    protected $_table_name = 'tbl_nesten';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'nest_id';
    public $_rules = array(
        'naam_vader' => array(
            'field' => 'naam_vader',
            'label' => 'Naam vader',
            'rules' => 'trim|xss_clean|required|max_length[100]'
        ),
        'naam_moeder' => array(
            'field' => 'naam_moeder',
            'label' => 'Naam moeder',
            'rules' => 'trim|xss_clean|required|max_length[100]'
        ),
        'foto' => array(
            'field' => 'foto',
            'label' => 'Foto',
            'rules' => 'trim|xss_clean|max_length[250]'
        ),
        'geboortedatum' => array(
            'field' => 'foto',
            'label' => 'Foto',
            'rules' => 'trim|xss_clean|required|max_length[20]'
        )
    );

    public function get_new ()
    {
        $nest = new stdClass();
        $nest->naam_vader = '';
        $nest->naam_moeder = '';
        $nest->foto = '';
        $nest->geboortedatum = date('d-m-Y');
        $nest->beschikbaar = date('d-m-Y');
        return $nest;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('nest_id, naam_vader, naam_moeder');
        $this->db->order_by($this->_order_by);
        $nesten = parent::get();

        $array = array(
            0 => 'Geen nest'
        );
        // Return key => value pair array
        if (count($nesten)) {
            foreach ($nesten as $nest) {
                $array[$nest->nest_id] = $nest->naam_vader.' & '.$nest->naam_moeder;
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

    public function save_order ($nest, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $nest)->update($this->_table_name);
    }
}
