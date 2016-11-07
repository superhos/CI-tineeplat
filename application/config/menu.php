<?php
defined('BASEPATH') OR exit('No direct script access allowed');
		
$config['menu'] =  array(
			array(
				'id' => 'userlist',
				'title' => '业务管理',
				'icon' => 'fa-child',
				'child' => array(
					array(
						'id' => 'userlist',
						'title' => '用户管理',
						'icon' => 'fa-child',
						'uri' => '/admin/listUser'
					),
					array(
						'id' => 'storelist',
						'title' => '商店管理',
						'icon' => 'fa-child',
						'uri' => '/admin/listStore'
					)
				)
			),
			array(
				'id' => 'storelist',
				'title' => '商店管理',
				'icon' => 'fa-child',
				'uri' => '/admin/listStore'
			)
		);