<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Project_m extends MY_Model
{
    protected $_table_name = 'tbl_projects';
    protected $_order_by = 'title';
    public $_rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|required|max_length[150]'
        ),
        'cat_id' => array(
            'field' => 'cat_id',
            'label' => 'Categorie',
            'rules' => 'trim|intval'
        ),
        'description' => array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|xss_clean'
        ),
        'picture_small' => array(
            'field' => 'picture_small',
            'label' => 'Picture Small',
            'rules' => ''
        ),
        'picture_large_1' => array(
            'field' => 'picture_large_1',
            'label' => 'Picture Large 1',
            'rules' => ''
        ),
        'picture_large_2' => array(
            'field' => 'picture_large_2',
            'label' => 'Picture Large 2',
            'rules' => ''
        ),
    );

    public function get_new ()
    {
        $project = new stdClass();
        $project->title = '';
        $project->cat_id = '';
        $project->description = '';
        $project->picture_small = '';
        $project->picture_large_1 = '';
        $project->picture_large_2 = '';
        return $project;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }
}
