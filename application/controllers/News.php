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

        // creates a new news.
        public function create(){
            // load form helper and form_validation library.
            $this->load->helper('form');
            $this->load->libary('form_validation');

            $data['title'] = 'Create a news item';

            // set_rules takes 3 arguments; the name of the input field, the name to use in error message and the rule.
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');
            }else{
                $this->news_model->set_news();
                $this->load->view('news/success');
            }
        }
    }