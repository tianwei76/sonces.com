<?php namespace Phpcmf\Controllers\Admin;

class Debug extends \Phpcmf\Common {

	public function index() {
		\Phpcmf\Service::V()->assign([
		    'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '调试变量记录' => ['dever/debug/index', 'fa fa-bug'],
                    'help' => [1202],
                ]
            ),
			'list' => dr_file_map(WRITEPATH.'debuglog/'),
		]);
		\Phpcmf\Service::V()->display('debug_list.html');
	}

	public function show_index() {

        $file = dr_safe_filename($_GET['file']);
        $file = WRITEPATH.'debuglog/'.$file.'.txt';
        if (!$file) {
            exit('文件不存在：'.$file);
        }
        if (filesize($file) > 1024*1024*2) {
            exit('此日志文件大于2MB，请使用Ftp等工具查看此文件：'.$file);
        }
        $code = file_get_contents($file);
        \Phpcmf\Service::V()->assign([
            'file' => $file,
            'code' => $code,
            'menu' => [],
        ]);
        \Phpcmf\Service::V()->display('debug_show.html');exit;
    }

    public function del() {

        $ids = \Phpcmf\Service::L('input')->post('ids');
        if (!$ids) {
            $this->_json(0, dr_lang('你还没有选择呢'));
        }
        foreach ($ids as $t) {
            $file = dr_safe_filename($t);
            $file = WRITEPATH.'debuglog/'.$file;
            unlink($file);
        }
        $this->_json(1, dr_lang('操作成功'));
    }

}
