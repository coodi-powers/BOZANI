<?php
/**
 * Created by PhpStorm.
 * invoice: bartbollen
 * Date: 14/05/15
 * Time: 22:24
 */

class Category extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('map_m');
        $this->load->model('category_m');
        $this->load->model('project_category_m');

        $this->data['submenu'] = 'admin/category/submenu';
    }

    public function index()
    {
        //fetch all
        $this->data['maps'] = $this->map_m->get();
        $this->data['categories'] = $this->category_m->get();
        $this->data['project_categories'] = $this->project_category_m->get();

        //load view
        $this->data['subview'] = 'admin/category/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function indexcat()
    {
        //fetch all
        $this->data['categories'] = $this->category_m->get();

        //load view
        $this->data['subview'] = 'admin/category/indexcat';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function indexmap()
    {
        //fetch all
        $this->data['maps'] = $this->map_m->get();

        //load view
        $this->data['subview'] = 'admin/category/indexmap';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function editcat($id = NULL)
    {
        // fetch a category or set a new one
        if ($id) {
            $this->data['object'] = $this->category_m->get($id);
            if(count($this->data['object']) == NULL)
            {
                $this->data['errors'] = 'Category could not be found';
            }
        }
        else {
            $this->data['object'] = $this->category_m->get_new();
        }


        // set up the form
        $rules = $this->category_m->_rules;
        $this->form_validation->set_rules($rules);

        //process the form
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->category_m->array_from_post(array('name'));
            $this->category_m->save($data, $id);
            redirect('admin/category');
        }

        //load the form
        $this->data['subview'] = 'admin/category/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function editmap($id = NULL)
    {
        // fetch a invoice or set a new one
        if ($id) {
            $this->data['object'] = $this->map_m->get($id);
            if(count($this->data['object']) == NULL)
            {
                $this->data['errors'] = 'Map could not be found';
            }
        }
        else {
            $this->data['object'] = $this->map_m->get_new();
        }


        // set up the form
        $rules = $this->map_m->_rules;
        $this->form_validation->set_rules($rules);

        //process the form
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->map_m->array_from_post(array('name'));
            $this->map_m->save($data, $id);
            redirect('admin/category');
        }

        //load the form
        $this->data['subview'] = 'admin/category/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function editcat_project($id = NULL)
    {
        // fetch a invoice or set a new one
        if ($id) {
            $this->data['object'] = $this->project_category_m->get($id);
            if(count($this->data['object']) == NULL)
            {
                $this->data['errors'] = 'Categorie could not be found';
            }
        }
        else {
            $this->data['object'] = $this->project_category_m->get_new();
        }


        // set up the form
        $rules = $this->project_category_m->_rules;
        $this->form_validation->set_rules($rules);

        //process the form
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->project_category_m->array_from_post(array('name'));
            $this->project_category_m->save($data, $id);
            redirect('admin/category');
        }

        //load the form
        $this->data['subview'] = 'admin/category/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function deletecat($id)
    {
        $this->category_m->delete($id);
        redirect('admin/category');
    }

    public function deletemap($id)
    {
        $this->map_m->delete($id);
        redirect('admin/category');
    }

    public function delete_cat_project($id)
    {
        $this->project_category_m->delete($id);
        redirect('admin/category');
    }
}