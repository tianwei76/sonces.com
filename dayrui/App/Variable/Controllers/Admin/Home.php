<?php namespace Phpcmf\Controllers\Admin;


class Home extends \Phpcmf\Common
{
    private $type;
    private $form; // 表单验证配置

    public function __construct(...$params) {
        parent::__construct(...$params);
        \Phpcmf\Service::V()->assign('menu', \Phpcmf\Service::M('auth')->_admin_menu(
            [
                '自定义全局变量' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-code'],
                '添加' => ['add:'.APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/add', 'fa fa-plus'],
                '更新缓存' => ['ajax:api/cache_update', 'fa fa-refresh'],
                'help' => [357],
            ]
        ));
        // 表单验证配置
        $this->form = [
            'name' => [
                'name' => '名称',
                'rule' => [
                    'empty' => dr_lang('名称不能为空')
                ],
                'filter' => [],
                'length' => '200'
            ],
            'cname' => [
                'name' => '别名',
                'rule' => [
                    'empty' => dr_lang('别名不能为空')
                ],
                'filter' => [],
                'length' => '200'
            ],
        ];
        $this->type = [
            0 => dr_lang('逻辑值'),
            1 => dr_lang('文本值'),
        ];
        \Phpcmf\Service::V()->assign('type', $this->type);
    }

    public function index() {

        // 新字段
        $table = \Phpcmf\Service::M()->dbprefix('var');
        if (\Phpcmf\Service::M()->db->tableExists($table)) {
            // 创建字段 游客点赞
            if (!\Phpcmf\Service::M()->db->fieldExists('hide', $table)) {
                \Phpcmf\Service::M()->query('ALTER TABLE `'.$table.'` ADD `hide` int(5) DEFAULT 0');
            }
        }

        list($list, $total) = \Phpcmf\Service::M()->table('var')->limit_page();

        \Phpcmf\Service::V()->assign([
            'list' => $list,
            'total' => $total,
            'mypages'	=> \Phpcmf\Service::L('Input')->page(\Phpcmf\Service::L('Router')->url(APP_DIR.'/home/index'), $total, 'admin')
        ]);
        \Phpcmf\Service::V()->display('myvar_index.html');
    }

    public function add() {

        if (IS_AJAX_POST) {
            $data = $this->_validation(0, \Phpcmf\Service::L('Input')->post('data'));
            $rt = \Phpcmf\Service::M()->table('var')->insert($data);
            if (!$rt['code']) {
                $this->_json(0, $rt['msg']);
            }
            \Phpcmf\Service::L('Input')->system_log('添加自定义变量: '.$data['name']);
            \Phpcmf\Service::M('Variable', APP_DIR)->cache();
            exit($this->_json(1, dr_lang('操作成功')));
        }

        \Phpcmf\Service::V()->assign([
            'form' => dr_form_hidden()
        ]);
        \Phpcmf\Service::V()->display('myvar_add.html');
        exit;
    }


    public function edit() {

        $id = intval(\Phpcmf\Service::L('Input')->get('id'));
        $data = \Phpcmf\Service::M()->table('var')->get($id);
        !$data && exit($this->_json(0, dr_lang('数据#%s不存在', $id)));

        if (IS_AJAX_POST) {
            $data = $this->_validation($id, \Phpcmf\Service::L('Input')->post('data'));
            $rt = \Phpcmf\Service::M()->table('var')->update($id, $data);
            if (!$rt['code']) {
                $this->_json(0, $rt['msg']);
            }
            \Phpcmf\Service::L('Input')->system_log('修改自定义变量: '.$data['name']);
            \Phpcmf\Service::M('Variable', APP_DIR)->cache();
            exit($this->_json(1, dr_lang('操作成功')));
        }

        \Phpcmf\Service::V()->assign([
            'data' => $data,
            'form' => dr_form_hidden(),
            'code' => $data['type'] ? "{dr_var_value('".$data['cname']."')}" : ("{if dr_var_value('".$data['cname']."')}".PHP_EOL."是".PHP_EOL."{else}".PHP_EOL."否".PHP_EOL."{/if}")
        ]);
        \Phpcmf\Service::V()->display('myvar_add.html');
        exit;
    }

    public function del() {

        $ids = \Phpcmf\Service::L('Input')->get_post_ids();
        if (!$ids) {
            exit($this->_json(0, dr_lang('你还没有选择呢')));
        }

        $rt = \Phpcmf\Service::M()->table('var')->deleteAll($ids);
        if (!$rt['code']) {
            $this->_json(0, $rt['msg']);
        }
        \Phpcmf\Service::L('Input')->system_log('批量删除自定义变量: '. @implode(',', $ids));
        \Phpcmf\Service::M('Variable', APP_DIR)->cache();

        exit($this->_json(1, dr_lang('操作成功'), ['ids' => $ids]));
    }

    // 隐藏或者启用
    public function hidden_edit() {

        $id = (int)\Phpcmf\Service::L('input')->get('id');
        $row = \Phpcmf\Service::M()->table('var')->get($id);
        if (!$row) {
            $this->_json(0, dr_lang('数据不存在'));
        }

        $v = $row['hide'] ? 0 : 1;
        \Phpcmf\Service::M()->table('var')->update($id, ['hide' => $v]);
        \Phpcmf\Service::M('cache')->sync_cache('');

        exit($this->_json(1, dr_lang($v ? '已被禁用' : '已被启用'), ['value' => $v]));
    }

    // 验证数据
    private function _validation($id, $data) {

        list($data, $return) = \Phpcmf\Service::L('Form')->validation($data, $this->form);
        if (\Phpcmf\Service::M()->table('var')->is_exists($id, 'cname', $data['cname'])) {
            exit($this->_json(0, dr_lang('别名已经存在'), ['field' => 'cname']));
        }
        if ($return) {
            exit($this->_json(0, $return['error'], ['field' => $return['name']]));
        }
        if (!$id) {
            $data['hide'] = 0;
        }
        $data['type'] = intval($data['type']);
        $data['value'] = $data['value'][$data['type']];

        return $data;
    }

}
