<?php
/**
 * Created by PhpStorm.
 * article: bartbollen
 * Date: 4/05/15
 * Time: 19:52
 */

class Article extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_m');
        $this->data['submenu'] = '';
    }

    public function index()
    {
        //fetch all articles
        $this->data['articles'] = $this->article_m->get();

        //load view
        $this->data['subview'] = 'admin/article/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a article or set a new one
        if ($id) {
            $this->data['article'] = $this->article_m->get($id);
            if(count($this->data['article']) == NULL)
            {
                $this->data['errors'] = 'article could not be found';
            }
        }
        else {
            $this->data['article'] = $this->article_m->get_new();
        }

        // set up the form
        $rules = $this->article_m->_rules;
        $this->form_validation->set_rules($rules);

        //process the form
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->article_m->array_from_post(array('title', 'slug', 'body', 'pubdate'));
            $this->article_m->save($data, $id);
            redirect('admin/article');
        }

        //load the form
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id)
    {
        $this->article_m->delete($id);
        redirect('admin/article');
    }
}