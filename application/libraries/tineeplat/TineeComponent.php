<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TineeComponent {

	public $column;

	public function __construct()
    {   
    }

    public function column($column,$title = null){
    	$this->column = array('column'=>$column,'title'=>$title?$title:$column,'sortable'=>false);
    	return $this;
    }

    //is sortable?
    public function sortable($order = 'asc'){
    	$this->column['sortable'] = $order;
    	return $this;
    }

    //format data
    public function format($func){
    	$this->column['format'] = $func;
    	return $this;
    }

    public function more($moretable,$func){
        $this->column['more'] = array(
                'table' => $moretable,
                'callback' => $func
            );
        return $this;
    }

    public function value($func){
        $this->column['value'] = $func;
        return $this;
    }
}