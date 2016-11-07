<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Model {

    public $userName;
    public $id;

    public $store = array(
                'model' => 'Store',
                'own_id' => 'id',
                'model_id' => 'id',
                'link_model' => 'Member_store',
                'link_own_id' => 'member_id',
                'link_model_id' => 'store_id'
            );

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

}