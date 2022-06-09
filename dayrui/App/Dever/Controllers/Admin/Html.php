<?php namespace Phpcmf\Controllers\Admin;

// 开发者工具
class Html extends \Phpcmf\App
{


    // 本地的应用目录
    public function index() {

        \Phpcmf\Service::V()->assign([
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '后台HTML特效' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-html5'],
                ]
            ),
        ]);
        \Phpcmf\Service::V()->display('app_html.html');
    }



}
