<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TineePassword {

	public $html;
    public $column;
    public $title;
    public $required;

	public function __construct()
    {   
    }

    public function password($column,$title = null){
    	$this->column = $column;
        $this->title = isset($title)?$title:$column;
    	return $this;
    }

    public function required(){
        $this->required = true;
    }

    public function gen(){
        $html = '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="'.$this->column.'">'.$this->title;

        if ($this->required){
            $html.= '<span class="required">*</span>';
        }

        $html .= '</label><div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="'.$this->column.'" type="password" id="'.$this->column.'" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>';
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