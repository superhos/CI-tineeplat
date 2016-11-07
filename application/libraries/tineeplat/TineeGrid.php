<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tineegrid {

	public $content = array();
    public $title = '';
    public $subtitle = '';
    public $isExport = false;
    private $model;
    private $CI;
    private $db;
    public $editFunc;
    public $deleteFunc;

	public function __construct($config)
    {   
        $this->CI =& get_instance();
        $this->CI->load->library('tineeplat/tineecolumn');
        $this->model = $config['model'];
        $this->CI->load->database();
        $this->db = $this->CI->db;
    }

    /**
     *  Single Column
    **/
    public function column($column,$title = null){
    	$tineecolumn = new TineeColumn();
        $column = $tineecolumn->column($column,$title);
    	array_push($this->content,$column);
    	return $column;
    }

    /**
     *  Multi Column
    **/
    public function columns(){
        $numargs = func_num_args();  
        $args = func_get_args();
        foreach ($args as $key => $value) {
            $tineecolumn = new TineeColumn();
            if (is_array($value)){
                $column = $tineecolumn->column($value[0],$value[1]);
            }else{
                $column = $tineecolumn->column($value,$value);
            }
            array_push($this->content,$column);
        }
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