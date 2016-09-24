<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Reportage_m extends MY_Model
{
    protected $_table_name = 'tbl_reportages';
    protected $_order_by = 'datum';
    protected $_primary_key = 'reportage_id';

    public function get_new ()
    {
        $reportage = new stdClass();
        $reportage->naam = '';
        $reportage->titel_nl = '';
        $reportage->intro_nl = '';
        $reportage->inhoud_nl = '';
        $reportage->datum = date('d-m-Y');
        $reportage->auteur = '';
        $reportage->afbeelding = '';
        $reportage->album = '';
        $reportage->type = '';
        return $reportage;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('reportage_id, naam');
        $this->db->order_by($this->_order_by);
        $reportages = parent::get();

        // Return key => value pair array
        if (count($reportages)) {
            foreach ($reportages as $reportage) {
                $array[$reportage->reportage_id] = $reportage->naam;
            }
        }

        return $array;
    }

    public function get_reportages($type, $id = NULL, $recent = NULL)
    {
        if($id != NULL)
        {
            $this->db->where('reportage_id', $id);
        }
        $this->db->where('type', $type);
        $this->db->order_by($this->_order_by, "desc");

        if($recent != NULL)
        {
            return $this->db->get($this->_table_name, $recent)->result_array();
        }
        else
        {
            return $this->db->get($this->_table_name)->result_array();
        }
    }

    public function get_types()
    {
        $arr_types = array(
            1 => 'Motocross',
            2 => 'Cyclocross'
        );

        return $arr_types;
    }
}
