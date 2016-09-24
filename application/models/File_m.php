<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class File_m extends MY_Model
{
    protected $_table_name = 'tbl_files';
    protected $_order_by = 'invoice_id';
    public $_rules = array(
        'file_path' => array(
            'field' => 'file_path',
            'label' => 'File path',
            'rules' => ''
        ),
    );

    public function get_new ()
    {
        $page = new stdClass();
        $page->invoice_id = '';
        $page->file_path = '';
        return $page;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }
}
