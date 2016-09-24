<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Invoice_m extends MY_Model
{
    protected $_table_name = 'invoices';
    protected $_order_by = 'title';
    public $_rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|required|max_length[150]'
        ),
        'date' => array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'trim|required|xss_clean'
        ),
        'map' => array(
            'field' => 'map',
            'label' => 'Map',
            'rules' => 'trim|intval'
        ),
        'cat' => array(
            'field' => 'cat',
            'label' => 'Categorie',
            'rules' => 'trim|intval'
        ),
        'extra' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|xss_clean'
        ),
    );

    public function get_new ()
    {
        $invoice = new stdClass();
        $invoice->title = '';
        $invoice->date = date('Y-m-d');
        $invoice->map = '';
        $invoice->cat = '';
        $invoice->extra = '';
        return $invoice;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }
}
