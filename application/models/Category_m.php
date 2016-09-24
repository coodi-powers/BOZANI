<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Category_m extends MY_Model
{
    protected $_table_name = 'categories';
    protected $_order_by = 'name';
    public $_rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|xss_clean|required|max_length[150]'
        )
    );

    public function get_new ()
    {
        $cat = new stdClass();
        $cat->name = '';
        return $cat;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }
}
