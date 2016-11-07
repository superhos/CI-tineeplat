<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TineePlat {

	private $grid;
	private $model;
    private $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }

    public function grid($model,$func)
    {
    	//load model
    	$this->CI->load->model($model);
        $this->model = $model;
        $config = array (
            'model' => $model
        );
    	$this->CI->load->library('tineeplat/tineegrid',$config);
        $this->grid = $this->CI->tineegrid;
    	$func($this->grid);
        $data = $this->package($this->grid);
    	return $data;
    }

    public function form($model,$func)
    {
        //load model
        $this->CI->load->model($model);
        $this->model = $model;
        $config = array (
            'model' => $model
        );
        $this->CI->load->library('tineeplat/tineeform',$config);
        $this->form = $this->CI->tineeform;
        $func($this->form);
        $data = $this->packageForm($this->form);
        return $data;
    }

    public function packageForm($form){
        foreach ($form->content as $key =>&$value) {
            $value->gen();
        }

        $data['fields'] = $form->content;

        if (isset($form->title)){
            $data['title'] = $form->title;
        }

        if (isset($form->subtitle)){
            $data['subtitle'] = $form->subtitle;
        }

        return $data;
    }

    public function package($grid){
        $data = $grid->generate();
        $this->CI->load->model($this->model);
        $model = $this->CI->{$this->model};
        foreach ($grid->content as $key => $tineecolumn) {
            if (isset($tineecolumn->column['format'])){
                foreach ($data['data'] as $k => $d) {
                    $v = $d->{$tineecolumn->column['column']};
                    $d->{$tineecolumn->column['column']} = $tineecolumn->column['format']($v);
                }
            }
            if (isset($tineecolumn->column['value'])){
                foreach ($data['data'] as $k => $d) {
                    $d->{$tineecolumn->column['column']} = $tineecolumn->column['value']($d);
                }
            }

            if (isset($grid->editFunc)){
                foreach ($data['data'] as $k => $d) {
                    $func = $grid->editFunc;
                    $d->{'canedit'} = $func($d);
                }
            }else{
                foreach ($data['data'] as $k => $d) {
                    $d->{'canedit'} = true;
                }
            }

            if (isset($grid->deleteFunc)){
                foreach ($data['data'] as $k => $d) {
                    $func = $grid->deleteFunc;
                    $d->{'candelete'} = $func($d);
                }
            }else{
                foreach ($data['data'] as $k => $d) {
                    $d->{'candelete'} = true;
                }
            }
        }

        // var_dump($data['fields']);
        $fields = $data['fields'];
        unset($data['fields']);
        $data['fields'] = $grid->content;

        if (isset($grid->title)){
            $data['title'] = $grid->title;
        }

        if (isset($grid->subtitle)){
            $data['subtitle'] = $grid->subtitle;
        }

        if ($grid->isExport){
            $data['isExport'] = true;
        }else{
            $data['isExport'] = false;
        }

        // $ind = 0;
        // foreach ($data['data'] as $k => $d) {
        //     foreach ($grid->content as $key => $tineecolumn) {
        //         $result[$ind][$key] = array('meta'=>$tineecolumn,'data'=>$d->{$tineecolumn->column['column']});
        //     }
        //     $ind++;
        // }
        return $data;
    }
}