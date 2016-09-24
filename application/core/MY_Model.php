<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 15:48
 */

class MY_Model extends CI_Model
{
    //---SOME BASIC VARIABLES-------------------------------------------------------------------------------------------
    protected $_table_name      = "";
    protected $_primary_key     = "id";
    protected $_primary_filter  = "intval";
    protected $_order_by         = "";
    public $_rules           = array();
    protected $_timestamps      = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function array_from_post($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    //---BASIC FUNCTIONS------------------------------------------------------------------------------------------------
    public function get($id = NULL, $single = NULL)
    {
        if($id != NULL)
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }

        $this->db->order_by($this->_order_by);

        $query = $this->db->get($this->_table_name);

        switch($method)
        {
            case 'row':
                return $query->row();
                break;
            case 'result':
                return $query->result();
                break;
        }
    }

    public function get_by($field, $where, $single = NULL)
    {
        $this->db->where($field, $where);
        return $this->get(NULL, $single);
    }

    public function get_by_original($where, $single = FALSE){
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function get_like($field, $where, $arr_filter = array(), $orderby="", $single = FALSE){
        $this->db->like($field, $where);
        foreach($arr_filter as $key=>$filter)
        {
            $this->db->where($key, $filter);
        }
        $this->db->order_by($orderby);
        return $this->get(NULL, $single);
    }

    public function get_date_field($field)
    {
        $this->db->where($field, $where);
        return $this->get(NULL, $single);
    }

    public function count($field="", $where="", $single = NULL)
    {
        $query = $this->db->where($field, $where);
        $count = $query->num_rows;
        return $count;
    }

    public function save($data, $id = NULL)
    {
        //Set timestamps
        if($this->_timestamps == TRUE)
        {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        //Insert
        if($id === NULL)
        {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] == NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        //Update
        else
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

    public function delete($id)
    {
        $this->db->delete($this->_table_name, array($this->_primary_key => $id));
    }

    public function deletefile($invoice_id, $filename)
    {
        $filter = $this->_primary_filter;
        $id = $filter($invoice_id);

        if (!$id)
        {
            return false;
        }
        else
        {
            $this->db->where('invoice_id', $id);
            $this->db->where('file_path', $filename);
            $this->db->limit(1);
            $this->db->delete($this->_table_name);
        }
    }
}