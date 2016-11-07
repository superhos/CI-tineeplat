<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TineeRadiobox {

	public $html;
    public $column;
    public $title;
    public $options;
    public $required;
    public $style = 'original';

	public function __construct()
    {   
    }

    public function radiobox($column,$title = null){
    	$this->column = $column;
        $this->title = isset($title)?$title:$column;
    	return $this;
    }

    public function options($options){
        $this->options = $options;
        return $this;
    }

    public function style($sty){
        $this->style = $sty;
        return $this;
    }

    public function required(){
        $this->required = true;
        return $this;
    }

    public function gen(){
        $html = '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">'.$this->title;

        if ($this->required){
            $html.= '<span class="required">*</span>';
        }

        $html .= '</label><div class="col-md-6 col-sm-6 col-xs-12"><div class="btn-group" data-toggle="buttons">';
        if ($this->style === 'block'){
            foreach ($this->options as $key => $value) {
                $html.= '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="'.$this->column.'" value="'.$value.'"> &nbsp; '.$key.' &nbsp;
                                </label>';
            }
        }else{
            foreach ($this->options as $key => $value) {
                $html.= '<div class="radio">
                            <label>
                              <input type="radio" class="flat" checked name="'.$this->column.'"> '.$key.'
                            </label>
                          </div>';
            }
        }
        $html.='</div></div></div>';
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