<?php 
    class News extends CI_Controller {
        
        public function __construct(){

            // loads the model so can be used in all other methods in this controller.
            // loads an url helper as well.
            parent::__construct();
            $this->load->model('news_model');
            $this->load->helper('url_helper');
        }

        // get all news, calling the get_news() method defined in the News model.
        public function index(){
            $data['news'] = $this->news_model->get_news();
            $data['title'] = 'News archive';

            // pass data to the views to display it.
            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer');
        }

        // get one specific news, calling the get_news() method defined in the News model.
        public function view($slug = NULL){

            $data['news_item'] = $this->news_model->get_news($slug);

            if(empty($data['news_item'])){
                show_404();
            }

            $data['title'] = $data['news_item']['title'];

            $this->load->view('templates/header', $data);
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer');
        }
    }