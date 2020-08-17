<?php
    class News_model extends CI_Model {
        
        public function __construct(){
            // loads database library
            $this->load->database();
        }

        public function get_news($slug = FALSE){
            
            // gets all news
            if($slug === FALSE){
                $query = $this->db->get('news');
                return $query->result_array();
            }

            // gets a particular news with the slug
            $query = $this->db->get_where('news', array('slug' => $slug));
            return $query->row_array();
        }

    }