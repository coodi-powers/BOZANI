<?php
/**
 * Created by PhpStorm.
 * project: bartbollen
 * Date: 14/05/15
 * Time: 22:24
 */

class project extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_m');
        $this->load->model('project_category_m');
        $this->data['submenu'] = '';
    }

    public function index($time = NULL)
    {
        //fetch all projects
        $this->data['projects'] = $this->project_m->get();
        $this->data['categories'] = $this->project_category_m->get();

        //load view
        $this->data['subview'] = 'admin/project/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function detail($id = NULL)
    {
        $data_file = "";
        // fetch a project or set a new one
        if ($id) {
            $this->data['project'] = $this->project_m->get($id);
            if (count($this->data['project']) == NULL) {
                $this->data['errors'] = 'project could not be found';
            }
        }

        if($_POST)
        {
            $dir = '../uploads/'.$this->session->id.'/'.$id;
            if (!is_dir($dir)) {
                mkdir($dir, 0777, TRUE);

            }

            // set up the upload
            $config['upload_path'] = $dir.'/';
            $config['allowed_types'] = '*';

            $this->load->library('upload', $config);

            //attach the files
            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                dump($error);
                //$this->project_m->file = '';
            }
            else
            {
                $data_file = array('upload_data' => $this->upload->data());
                $filedata = array();
                $filedata['project_id'] = intval($id);
                $filedata['file_path'] = $data_file['upload_data']['file_name'];
                $this->file_m->save($filedata,NULL);
                //$this->file_m->save($filedata, $file_id);
                //$this->project_m->file = $data_file['upload_data']['file_name'];
            }
            //redirect('admin/project');
        }

        $this->data['arr_types'] = $this->interview_m->get_types();

        $this->data['files'] = $this->file_m->get_by('project_id', $id);
        $this->data['categories'] = $this->category_m->get();
        $this->data['maps'] = $this->map_m->get();
        $this->data['subview'] = 'admin/project/detail';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        $data_file = "";
        // fetch a project or set a new one
        if ($id) {
            $this->data['project'] = $this->project_m->get($id);
            if(count($this->data['project']) == NULL)
            {
                $this->data['errors'] = 'project could not be found';
            }
        }
        else {
            $this->data['project'] = $this->project_m->get_new();
        }
        $file_id = NULL;


        // set up the form
        $rules = $this->project_m->_rules;
        $this->form_validation->set_rules($rules);

        // set up the upload
        $config['upload_path'] = '../uploads/project_pictures/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);


        //process the form
        if($this->form_validation->run() == TRUE)
        {
            //save the project
            $data = $this->project_m->array_from_post(array('title', 'description', 'cat_id', 'picture_small', 'picture_large_1', 'picture_large_2'));
            $this->project_m->save($data, $id);


            //set the id if it's a new project
            if($id == NULL)
            {
                $id = $this->db->insert_id();
            }


            //attach the files
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                //$this->project_m->file = '';
            }
            else
            {
                $data_file = array('upload_data' => $this->upload->data());
                $filedata = array();
                $filedata['project_id'] = intval($id);
                $filedata['file_path'] = $data_file['upload_data']['file_name'];
                $this->file_m->save($filedata, $file_id);
                dump($filedata);
                dump($data);
                //$this->file_m->save($filedata, $file_id);
                //$this->project_m->file = $data_file['upload_data']['file_name'];
            }

            redirect('admin/project');
        }

        //load the form

        $this->data['categories'] = $this->project_category_m->get();
        $this->data['subview'] = 'admin/project/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id)
    {
        $this->project_m->delete($id);
        redirect('admin/project');
    }

    public function deletefile($filename, $project_id)
    {
        $file = '../uploads/'.$_SESSION['id'].'/'.$project_id.'/'.$filename;
        unlink($file);

        $file_object = $this->file_m->get_by('file_path', $filename);

        $this->file_m->deletefile($project_id, $filename);

        redirect('admin/project/detail/'.$project_id);
    }
}