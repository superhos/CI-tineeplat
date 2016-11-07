<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tineeform {

	public $content = array();
    private $model;
    private $CI;
    private $db;
    public $title = '';
    public $subtitle = '';

	public function __construct($config)
    {   
        $this->CI =& get_instance();
        $this->CI->load->library('tineeplat/tineecomponent');
        $this->model = $config['model'];
        $this->CI->load->database();
        $this->db = $this->CI->db;
    }

    public function text($column,$title = null){
        $this->CI->load->library('tineeplat/tineetext');
        $tineetext = new TineeText();
        $text = $tineetext->text($column,$title);
        array_push($this->content,$text);
        return $text;   
    }

    public function password($column,$title = null){
        $this->CI->load->library('tineeplat/tineepassword');
        $tineetext = new TineePassword();
        $text = $tineetext->password($column,$title);
        array_push($this->content,$text);
        return $text;   
    }

    public function select($column,$title = null){
        $this->CI->load->library('tineeplat/tineeselect');
        $tineetext = new TineeSelect();
        $text = $tineetext->select($column,$title);
        array_push($this->content,$text);
        return $text;   
    }

    public function radiobox($column,$title = null){
        $this->CI->load->library('tineeplat/tineeradiobox');
        $tineetext = new TineeRadiobox();
        $text = $tineetext->radiobox($column,$title);
        array_push($this->content,$text);
        return $text;   
    }

    public function switchCheck($column,$title = null,$des){
        $this->CI->load->library('tineeplat/tineeswitch');
        $tineetext = new TineeSwitch();
        $text = $tineetext->switchCheck($column,$title,$des);
        array_push($this->content,$text);
        return $text;   
    }

    public function title($title){
        $this->title = $title;
    }

    public function subtitle($title){
        $this->subtitle = $title;
    }

    public function editFilter($can){
        $this->editFunc = $can;
    }

    public function deleteFilter($can){
        $this->deleteFunc = $can;
    }

    public function model(){
        return $this->db;
    }

    public function generate(){
        // $model_gen = $this->model;       
        $fields = $this->db->list_fields($this->model);

        $data['fields'] = $fields;

        $query = $this->db->get($this->model);
        $data['data'] = $query->result();

        return $data;
    }
}