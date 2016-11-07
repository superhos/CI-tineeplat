<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('tineeplat');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function menu(){
		$this->config->load('menu');
		$menu = $this->config->item('menu');
		return $menu;
	}

	public function addUser(){
		$plat = $this->tineeplat->form('Member',function($form){
			$form->text('userName','用户名')->required();
			
			$form->password('password','密码')->required();

			$sexs = [
		        '男'  => 1,
		        '女' => 0,
		    ];

			$form->radiobox('sex','性别')->options($sexs)->style('original');

			$levs = [
		        '管理员'  => 1,
		        '服务员' => 2,
		    ];

			$form->select('lev','级别')->options($levs);

			$form->switchCheck('status', '状态','可用');

			$form->title('增加用戶');
		});

		$this->load->view('admin/header');
		$data['menu'] = $this->menu();
		$this->load->view('admin/side_menu',$data);
		$this->load->view('admin/top_nav');
		$data['output'] = $plat;
		$this->load->view('admin/form',$data);
		$this->load->view('admin/index');
	}

	public function listUser(){
		$plat = $this->tineeplat->grid('Member',function($grid){
			$grid->column('id')->sortable('asc');
			$grid->column('userName','用戶名');

			$grid->column('sex','性別')->format(function($val){
				return $val==1?'男':'女';
			});

			$grid->column('status','狀態')->format(function($val){
				return $val==1?'正常':'禁用';
			});

			//主表以外数据
			$grid->column('store','店鋪')->value(function($data){
				$this->db->select('*');
				$this->db->from('member');
				$this->db->join('store', 'member.id = store.member_id');
				$this->db->where('member.id ='.$data->id );
				$query = $this->db->get();
				return $query->num_rows();
			});

			$grid->column('lev','級別')->format(function($val){
				$result = $this->db->select('name')->from('managelevel')->where('lev =',$val)->get()->row();
				return $result->name;
			});

			$grid->column('addtime','加入時間');

			$grid->title('用戶管理');
			$grid->subtitle('好好管理,天天向上');

			//修改數據源 直接操作model 语法同CI
			$grid->model()->where('lev >',1);

			// $grid->isExport = true; //導出模式

			// $grid->editFilter(function($data){
			// 	return $data->lev=='管理员'?false:true;
			// }); //设定可被编辑规则

			// $grid->deleteFilter(function($data){
			// 	return $data->sex=='女'?false:true;
			// }); //高級的不能被編輯
		});

		$this->load->view('admin/header');
		$data['menu'] = $this->menu();
		$this->load->view('admin/side_menu',$data);
		$this->load->view('admin/top_nav');
		$data['output'] = $plat;
		$this->load->view('admin/grid',$data);
		$this->load->view('admin/index');
	}

	public function listStore(){
		$plat = $this->tineeplat->grid('Store',function($grid){
			$grid->column('id');
			$grid->column('name','店铺名称');

			$grid->column('status','狀態')->format(function($val){
				return $val==1?'正常':'禁用';
			});

			//主表以外数据
			$grid->column('member','拥有人')->value(function($data){
				$this->db->select('*');
				$this->db->from('member');
				$this->db->where('member.id ='.$data->member_id );
				$query = $this->db->get();
				return $query->row()->userName;
			});

			//修改數據源 直接操作model 语法同CI
			// $grid->model()->where('status =',1);

			$grid->title('店铺管理');
			$grid->subtitle('好好管理,天天向上');

		});

		$this->load->view('admin/header');
		$data['menu'] = $this->menu();
		$this->load->view('admin/side_menu',$data);
		$this->load->view('admin/top_nav');
		$data['output'] = $plat;
		$this->load->view('admin/grid',$data);
		$this->load->view('admin/index');
	}
}
