<?php

$this->load->view('components/page_head');

$this->load->view('templates/plugins_1');

$this->load->view('templates/'.$subview);

$this->load->view('templates/plugins_2');

$this->load->view('components/page_tail');

?>