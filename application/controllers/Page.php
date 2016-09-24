<?php

class Page extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('pageplugin_m');
    }

    public function index() {

        // Fetch the page template
        //$this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);
        //count($this->data['page']) || show_404(current_url());

        $this->data['error_messages'] = '';
        $this->data['succes_messages'] = '';

        if($this->uri->segment(1) == '')
        {
            $this->data['page'] = $this->page_m->get(1);
        }
        else
        {
            $this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);
        }
        count($this->data['page']) || show_404(current_url());

        // Fetch the page data
        $method = '_' . $this->data['page']->template;

        if($method == '_')
        {
            $method = '_page';
        }

        $this->data['homepage'] = $this->page_m->get(1);
        $this->$method($this->data['page']->id);
        $this->data['menu_items'] = $this->page_m->get_nested(1);


        $this->data['plugins'] = $this->getPlugins($this->data['page']->id);

        $this->data["extra_js"] = '';


        // Load the view
        $template = $this->data['page']->template;
        if($template == '')
        {
            $template = 'page';
        }
        $this->data['subview'] = $template;
        $this->load->view('_main_layout', $this->data);
    }

    private function _content_right(){
        $title = $this->data['page']->title;
        if($this->data['page']->title2 != '')
        {
            $title = $this->data['page']->title2;
        }
        $content = $this->data['page']->body;
        $afbeelding = $this->data['page']->afbeelding;

        $body = '
        <div class="divide60"></div>
        <div class="container">
            <div class="row">
                <div class="row vertical-align-child">
                    <div class="col-sm-5 hidden-xs center-heading wow animated fadeInUp" data-wow-delay="0.3s">
                        <img src="'.$afbeelding.'" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-6 col-sm-offset-1 center-heading wow animated fadeInUp" data-wow-delay="0.6s">
                        <h2>'.$title.'</h2>
                        <span class="center-line"></span>
                        <p class="sub-text margin40">
                            '.$content.'
                        <hr>
                    </div>
                </div>
            </div><!--center heading end-->
        </div><!--services container-->
        ';

        $this->data['default_content'] = $body;
    }

    private function _page(){
        $this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);

        $this->data['left_menu_items'] = $this->page_m->get_pages($this->data['page']->id);

    }

    private function _contact()
    {
        $this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);

        if($_POST)
        {

            if(($_POST['middelnaam'] == '') && ($_POST['naam'] != '') && ($_POST['email'] != '') && ($_POST['bericht'] != ''))
            {
                $to      = 'info@bozani.be';
                $subject = 'Bericht via website';
                $message = '
                                    Naam: '.$_POST['naam'].'<br>
                                    E-mail: '.$_POST['email'].'<br>
                                    Telefoon: '.$_POST['telefoon'].'<br>
                                    Onderneming: '.$_POST['onderneming'].'<br><br>
                                    Bericht: '.htmlspecialchars($_POST['bericht']).'<br>';
                $headers = 'From:'. $_POST['naam'] ."\r\n" .
                    'Reply-To:'.$_POST['email'] . "\r\n" .
                    'Content-Type: text/html; charset=ISO-8859-1\r\n' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                $this->data['succes_messages'] = 'Uw bericht werd succesvol verzonden.';
            }
            else
            {
                $this->data['error_messages'] = 'Uw bericht werd niet verzonden omdat niet alle velden zijn ingevuld.';
            }
        }
    }

    private function _homepage()
    {



    }

    public function sortFunction( $a, $b ) {
        return strtotime($a["datum"]) - strtotime($b["datum"]);
    }

    private function getPlugins()
    {
        $this->load->model('pageplugin_m');
        $this->load->model('sliderbox_m');
        $this->load->model('slideritem_m');

        $plugin_body = '';


        $arr_plugins = $this->pageplugin_m->get_all_page($this->data['page']->id);

        foreach ($arr_plugins as $plugin)
        {
            if($plugin->type_id == '1')
            {
                $plugin_body .= '[[DEFAULT_CONTENT]]';
            }
            //SLIDERS
            if($plugin->type_id == '2')
            {
                $slideritems = $this->sliderbox_m->get_box($plugin->plugin_id);

                $plugin_body .= '
                <!-- begin:slider -->
                <div class="divide80"></div>
                <div class="container">
                <div class="col-md-12">
                    <div class="center-heading wow animated fadeInUp">
                        <h2>Wat <strong>doen we</strong>?</h2>
                        <span class="center-line"></span>
                    </div>
                </div>


                <div class="owl-carousel owl-theme service-slider wow animated fadeInUp">
                
                ';

                foreach ($slideritems as $item)
                {
                    $slideritem = $this->slideritem_m->get($item->item_id);

                    $plugin_body .= '
                         <div class="item">
                        <div class="service-box">
                            <div class="service-thumb">
                                <img src="'.$slideritem->foto.'" alt="" class="img-responsive img-slider">
                            </div>
                            <div class="service-desc">
                                <h4 class="text-uppercase">'.$slideritem->naam.'</h4>
                                <div class="border-width"></div>
                                <p>'.$slideritem->tekst.'</p>
                                <div class="text-right">
                                    <a href="'.$slideritem->link.'" class="btn btn-link">Meer info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
                }

                $plugin_body .= '
                        </div>
                    </div>
                <!-- end:slider -->';
            }
            if($plugin->type_id == '3')
            {
                $this->load->model('tekst_m');

                $tekst_info = $this->tekst_m->get($plugin->plugin_id);

                if($tekst_info->foto != '')
                {
                    if($tekst_info->align == 'left')
                    {
                        $plugin_body .= '
                        <div class="container">
                            <div class="row padd20-top-btm text-'.$tekst_info->align.'">
                                <div class="col-md-8">
                                    <h3>'.$tekst_info->titel.'</h3>
                                    '.$tekst_info->inhoud.'
                                </div>
                                <div class="col-md-4">
                                    <img src="'.$tekst_info->foto.'" class="img-responsive img-rounded"/>
                                </div>
                            </div>
                        </div>';
                    }
                    if($tekst_info->align == 'center')
                    {
                        $plugin_body .= '
                        <div class="container">
                            <div class="row padd20-top-btm text-'.$tekst_info->align.'">
                                <div class="col-md-12">
                                    <img src="'.$tekst_info->foto.'" class="img-responsive img-rounded"/>
                                </div>
                                <div class="col-md-12">
                                    <h3>'.$tekst_info->titel.'</h3>
                                    '.$tekst_info->inhoud.'
                                </div>
                            </div>
                        </div>';
                    }
                    if($tekst_info->align == 'right')
                    {
                        $plugin_body .= '
                        <div class="container">
                            <div class="row padd20-top-btm text-'.$tekst_info->align.'">
                                <div class="col-md-4">
                                    <img src="'.$tekst_info->foto.'" class="img-responsive img-rounded"/>
                                </div>
                                <div class="col-md-8">
                                    <h3>'.$tekst_info->titel.'</h3>
                                    '.$tekst_info->inhoud.'
                                </div>
                            </div>
                        </div>';
                    }
                }
                else
                {
                    $plugin_body .= '
                        <div class="container">
                            <div class="row padd20-top-btm">
                                <div class="col-md-12 text-'.$tekst_info->align.'">
                                    <h3'.$tekst_info->titel.'</h3>
                                    '.$tekst_info->inhoud.'
                                </div>
                            </div>
                        </div>';
                }


            }
            if($plugin->type_id == '4')
            {
                $this->load->model('service_m');

                $service_info = $this->service_m->get($plugin->plugin_id);

                $plugin_body .= '
                <!-- begin:featured -->
                <div id="featured">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading-title">
                                    <h2>'.$service_info->titel.'</h2>
                                    '.$service_info->inhoud.'
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="featured-container">
                                    <div class="featured-photos">
                                        <i class="fa fa-'.$service_info->icon_1.'" aria-hidden="true"></i>
                                    </div>
                                    <h3>'.$service_info->titel_1.'</h3>
                                    '.$service_info->inhoud_1.'
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="featured-container">
                                    <div class="featured-photos">
                                        <i class="fa fa-'.$service_info->icon_2.'" aria-hidden="true"></i>
                                    </div>
                                    <h3>'.$service_info->titel_2.'</h3>
                                    '.$service_info->inhoud_2.'
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="featured-container">
                                    <div class="featured-photos">
                                        <i class="fa fa-'.$service_info->icon_3.'" aria-hidden="true"></i>
                                    </div>
                                    <h3>'.$service_info->titel_3.'</h3>
                                    '.$service_info->inhoud_3.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:featured -->';
            }
        }

        return $plugin_body;
    }
}