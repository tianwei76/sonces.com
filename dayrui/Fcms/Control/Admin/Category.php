<?php namespace Phpcmf\Control\Admin;
/**
 * www.xunruicms.com
 * 迅睿内容管理框架系统（简称：迅睿CMS）
 * 本文件是框架系统文件，二次开发时不可以修改本文件
 **/

class Category extends \Phpcmf\Admin\Category
{

    public function index() {
        $this->_Admin_List();
    }

    public function all_add() {
        $this->_Admin_All_Add();
    }

    public function add() {
        $this->_Admin_Add();
    }

    public function edit() {
        $this->_Admin_Edit();
    }

    public function url_edit() {
        $this->_Admin_Url_Edit();
    }

    public function move_edit() {
        $this->_Admin_Move_Edit();
    }
    
    public function show_edit() {
        $this->_Admin_Show_Edit();
    }
    
    public function displayorder_edit() {
        $this->_Admin_Order();
    }
    
    public function html_edit() {
        $this->_Admin_Html_Edit();
    }

    public function htmlall_edit() {
        $this->_Admin_Html_All_Edit();
    }

    public function phpall_edit() {
        $this->_Admin_Php_All_Edit();
    }

    public function del() {
        $this->_Admin_Del();
    }

}
