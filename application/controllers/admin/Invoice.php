<?php
/**
 * Created by PhpStorm.
 * invoice: bartbollen
 * Date: 14/05/15
 * Time: 22:24
 */

class Invoice extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_m');
        $this->load->model('category_m');
        $this->load->model('map_m');
        $this->load->model('file_m');
        $this->data['submenu'] = '';
    }

    public function index($time = NULL)
    {
        redirect('admin/invoice/view', 'refresh');
        echo $time;
        //fetch all invoices
        $this->data['invoices'] = $this->invoice_m->get();
        $this->data['categories'] = $this->category_m->get();
        $this->data['maps'] = $this->map_m->get();

        //load view
        $this->data['subview'] = 'admin/invoice/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function view($time = NULL)
    {
        if($time != NULL)
        {
            $arr_time_pieces = explode("-", $time);
            $current_year = $arr_time_pieces[0];
            if(isset($arr_time_pieces[1]))
            {
                $current_month = $arr_time_pieces[1];
            }
            else
            {
                $current_month = date("M");
            }
        }
        else
        {
            //$time = date("Y");
            //$current_year = date("Y");
            //$current_month = date("M");
        }

        $arr_filter = array();
        $orderby = "";

        if($_POST['submit_filter'])
        {
            if($_POST['cat'] != '0')
            {
                $arr_filter['cat'] = $_POST['cat'];
            }
            if($_POST['map'] != '0')
            {
                $arr_filter['map'] = $_POST['map'];
            }
            if($_POST['orderby'] != '0')
            {
                $orderby = $_POST['orderby'];
            }
        }

        //fetch all invoices
        $this->data['invoices'] = $this->invoice_m->get_like('date', $time, $arr_filter, $orderby);
        $this->data['categories'] = $this->category_m->get();
        $this->data['maps'] = $this->map_m->get();

        //load view
        $this->data['current_year'] = $current_year;
        $this->data['current_month'] = $current_month;
        $this->data['subview'] = 'admin/invoice/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function detail($id = NULL)
    {
        $data_file = "";
        // fetch a invoice or set a new one
        if ($id) {
            $this->data['invoice'] = $this->invoice_m->get($id);
            if (count($this->data['invoice']) == NULL) {
                $this->data['errors'] = 'invoice could not be found';
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
                //$this->invoice_m->file = '';
            }
            else
            {
                $data_file = array('upload_data' => $this->upload->data());
                $filedata = array();
                $filedata['invoice_id'] = intval($id);
                $filedata['file_path'] = $data_file['upload_data']['file_name'];
                $this->file_m->save($filedata,NULL);
                //$this->file_m->save($filedata, $file_id);
                //$this->invoice_m->file = $data_file['upload_data']['file_name'];
            }
            //redirect('admin/invoice');
        }

        $this->data['files'] = $this->file_m->get_by('invoice_id', $id);
        $this->data['categories'] = $this->category_m->get();
        $this->data['maps'] = $this->map_m->get();
        $this->data['subview'] = 'admin/invoice/detail';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        $data_file = "";
        // fetch a invoice or set a new one
        if ($id) {
            $this->data['invoice'] = $this->invoice_m->get($id);
            if(count($this->data['invoice']) == NULL)
            {
                $this->data['errors'] = 'invoice could not be found';
            }
        }
        else {
            $this->data['invoice'] = $this->invoice_m->get_new();
        }
        $file_id = NULL;


        // set up the form
        $rules = $this->invoice_m->_rules;
        $this->form_validation->set_rules($rules);

        // set up the upload
        $config['upload_path'] = '../uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);


        //process the form
        if($this->form_validation->run() == TRUE)
        {
            //save the invoice
            $data = $this->invoice_m->array_from_post(array('title', 'cat', 'map', 'date', 'extra'));
            $this->invoice_m->save($data, $id);


            //set the id if it's a new invoice
            if($id == NULL)
            {
                $id = $this->db->insert_id();
            }


            //attach the files
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                //$this->invoice_m->file = '';
            }
            else
            {
                $data_file = array('upload_data' => $this->upload->data());
                $filedata = array();
                $filedata['invoice_id'] = intval($id);
                $filedata['file_path'] = $data_file['upload_data']['file_name'];
                $this->file_m->save($filedata, $file_id);
                dump($filedata);
                dump($data);
                //$this->file_m->save($filedata, $file_id);
                //$this->invoice_m->file = $data_file['upload_data']['file_name'];
            }

            redirect('admin/invoice/detail/'.$id);
        }

        //load the form

        $this->data['categories'] = $this->category_m->get();
        $this->data['maps'] = $this->map_m->get();
        $this->data['subview'] = 'admin/invoice/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id)
    {
        $this->invoice_m->delete($id);
        redirect('admin/invoice');
    }

    public function deletefile($filename, $invoice_id)
    {
        $file = '../uploads/'.$_SESSION['id'].'/'.$invoice_id.'/'.$filename;
        unlink($file);

        $file_object = $this->file_m->get_by('file_path', $filename);

        $this->file_m->deletefile($invoice_id, $filename);

        redirect('admin/invoice/detail/'.$invoice_id);
    }
}