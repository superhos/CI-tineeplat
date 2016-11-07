<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TineeSelect {

	public $html;
    public $column;
    public $title;
    public $options;
    public $required;

	public function __construct()
    {   
    }

    public function select($column,$title = null){
    	$this->column = $column;
        $this->title = isset($title)?$title:$column;
    	return $this;
    }

    public function options($options){
        $this->options = $options;
    }

    public function required(){
        $this->required = true;
    }

    public function gen(){
        $html = '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$this->title;

        if ($this->required){
            $html.= '<span class="required">*</span>';
        }

        $html .= '</label><div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="'.$this->column.'" class="form-control">';
        foreach ($this->options as $key => $value) {
            $html.= '<option value="'.$value.'">'.$key.'</option>';
        }
                            
                            
        $html.='</select></div></div>';
        $this->html = $html;
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