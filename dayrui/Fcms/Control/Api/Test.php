<?php namespace Phpcmf\Control\Api;
/**
 * www.xunruicms.com
 * 迅睿内容管理框架系统（简称：迅睿CMS）
 * 本文件是框架系统文件，二次开发时不可以修改本文件
 **/

// 测试信息
class Test extends \Phpcmf\Common
{

    public function index() {

        echo 'This is v'.$this->cmf_version['version'];
        exit;
    }

}
