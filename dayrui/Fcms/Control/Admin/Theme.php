<?php namespace Phpcmf\Control\Admin;
/**
 * www.xunruicms.com
 * 迅睿内容管理框架系统（简称：迅睿CMS）
 * 本文件是框架系统文件，二次开发时不可以修改本文件
 **/

class Theme extends \Phpcmf\Admin\File
{

    public function __construct(...$params)
    {
        parent::__construct(...$params);
        $this->root_path = WEBPATH.'static/';
        $this->backups_dir = 'theme';
        $this->exclude_dir = ['assets'];
        $this->backups_path = WRITEPATH.'backups/'.$this->backups_dir.'/';
    }

    public function index() {
        $this->_List();
    }

    public function edit() {
        $this->_Edit();
    }

    public function add() {
        $this->_Add();
    }

    public function clear_del() {
        $this->_Clear();
    }

    public function del() {
        $this->_Del();
    }

    public function image_index() {
        $this->_Image();
    }


}
