<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 8/04/15
 * Time: 20:41
 */

class PostController extends CI_Controller
{
    function index()
    {
        $this->load->model('post');
    }
}