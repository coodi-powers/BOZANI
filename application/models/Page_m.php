<?php
class Page_m extends MY_Model
{
    protected $_table_name = 'tbl_paginas';
    protected $_order_by = 'order';
    public $_rules = array(
        'parent_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent',
            'rules' => 'trim|intval'
        ),
        'menu' => array(
            'field' => 'menu',
            'label' => 'Menu',
            'rules' => 'trim|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
        )
    );

    public function get_new ()
    {
        $page = new stdClass();
        $page->title = '';
        $page->slug = '';
        $page->body = '';
        $page->parent_id = 0;
        $page->template = 'page';
        $page->menu = '';
        $page->title2 = '';
        return $page;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);

        // Reset parent ID for its children
        $this->db->set(array(
            'parent_id' => 0
        ))->where('parent_id', $id)->update($this->_table_name);
    }

    public function save_order ($page, $volgorde)
    {
        $data = array('order' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $page)->update($this->_table_name);
    }

    public function save_parent ($page, $parent)
    {
        $data = array('parent_id' => (int) $parent);
        $this->db->set($data)->where($this->_primary_key, $page)->update($this->_table_name);
    }

    public function get_pages($parent)
    {
        $this->db->where('parent_id', $parent);
        $this->db->order_by($this->_order_by);
        return $this->db->get('tbl_paginas')->result_array();
    }


    public function get_nested ($parent)
    {
        $arr_return = array();
        $this->db->where('parent_id', $parent);
        $this->db->order_by($this->_order_by);

        $pages = $this->db->get('tbl_paginas')->result_array();

        foreach ($pages as $page)
        {
            $arr_temp = array();
            $arr_temp['id'] = $page['id'];
            $arr_temp['title'] = $page['title'];
            $arr_temp['slug'] = $page['slug'];
            $arr_temp['children'] = '';

            $children = $this->get_pages($page['id']);
            if(!empty($children))
            {
                $arr_temp['children'] = $this->get_nested($page['id']);
            }

            array_push($arr_return, $arr_temp);
        }

        return $arr_return;
    }

    public function get_with_parent ($id = NULL, $single = FALSE)
    {
        $this->db->select('tbl_paginas.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('tbl_paginas as p', 'tbl_paginas.parent_id=p.id', 'left');
        return parent::get($id, $single);
    }

    public function get_no_parents ()
    {
        // Fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $pages = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No parent'
        );
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id] = $page->title;
            }
        }

        return $array;
    }

    public function get_children ($parent_id)
    {
        // Fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('parent_id', $parent_id);
        $pages = parent::get();

        // Return key => value pair array
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id] = $page->title;
            }
            return $array;
        }
        else
        {
            return 'no-children';
        }
    }





    public function get_all ()
    {
        // Fetch pages without parents
        $this->db->select('id, title');
        $pages = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No parent'
        );
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id] = $page->title;
            }
        }

        return $array;
    }
}