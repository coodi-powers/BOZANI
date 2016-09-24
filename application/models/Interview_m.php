<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Interview_m extends MY_Model
{
    protected $_table_name = 'tbl_interviews';
    protected $_order_by = 'datum';
    protected $_primary_key = 'interview_id';

    public function get_new ()
    {
        $interview = new stdClass();
        $interview->naam = '';
        $interview->titel_nl = '';
        $interview->intro_nl = '';
        $interview->inhoud_nl = '';
        $interview->datum = date('d-m-Y');
        $interview->auteur = '';
        $interview->afbeelding = '';
        $interview->type = '1';
        return $interview;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('interview_id, naam');
        $this->db->order_by($this->_order_by);
        $interviews = parent::get();

        // Return key => value pair array
        if (count($interviews)) {
            foreach ($interviews as $interview) {
                $array[$interview->interview_id] = $interview->naam;
            }
        }

        return $array;
    }

    public function get_interviews($type, $id = NULL, $recent = NULL)
    {
        if($id != NULL)
        {
            $this->db->where('interview_id', $id);
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

    public function get_archief()
    {
        $this->db->from("tbl_interviews ,tbl_reportages");
        $this->db->select("tbl_interviews.interview_id,tbl_interviews.titel_nl as intervieuw_titel, tbl_interviews.datum,tbl_reportages.reportage_id, tbl_reportages.titel_nl, tbl_reportages.datum");
        //you can add more orderby
        //you can add where condition too

        $result = $this->db->get()->result_array();

        return $result;
    }
}
