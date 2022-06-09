<?php namespace Phpcmf\Controllers\Admin;

// 开发者工具
class Home extends \Phpcmf\App
{

    public function __construct()
    {
        parent::__construct();
        \Phpcmf\Service::V()->assign([
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '应用控制器' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-code'],
                    //'创建空白应用' => ['add:'.APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/add', 'fa fa-plus', '550px', '60%'],
                    '创建空白应用插件' => ['add:'.APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/app_add', 'fa fa-plus', '550px', '60%'],
                    '创建模块应用插件' => ['add:'.APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/module_add', 'fa fa-plus', '550px', '60%'],
                    'help' => [681],
                ]
            ),
        ]);
    }

    // 本地的应用目录
    public function index() {

        $data = [];
        $local = dr_dir_map(APPSPATH, 1);
        foreach ($local as $dir) {
            $path = APPSPATH .$dir.'/';
            $data[$dir] = [
                'name' => $dir,
                'cname' => $dir,
                'type' => '<span class="badge badge-danger">'.dr_lang('自定义应用').'</span>',
            ];
            if (is_file($path.'Config/App.php')) {
                $cfg = require $path.'Config/App.php';
                if (($cfg['type'] != 'module' || $cfg['ftype'] == 'module')) {
                    $data[$dir] = [
                        'name' => $cfg['name'],
                        'cname' => $cfg['name'] . ' / ' . $dir,
                        'type' => '<span class="badge badge-info">'.dr_lang('应用插件').'</span>',
                        'is_app' => 1,
                    ];
                } else {
                    $data[$dir] = [
                        'name' => $cfg['name'],
                        'cname' => $cfg['name'] . ' / ' . $dir,
                        'type' => '<span class="badge badge-success">'.dr_lang('内容模块').'</span>',
                        'is_app' => 0,
                    ];
                }
            } elseif ($dir == 'Form') {
                $data[$dir] = [
                    'name' => dr_lang('网站表单'),
                    'cname' => $dir,
                    'type' => '<span class="badge badge-success">'.dr_lang('网站表单').'</span>',
                    'is_app' => 0,
                ];
            }
        }

        \Phpcmf\Service::V()->assign([
            'list' => $data,
        ]);
        \Phpcmf\Service::V()->display('app_list.html');
    }

    // 创建应用
    public function add() {

        if (IS_AJAX_POST) {
            $name = \Phpcmf\Service::L('input')->post('name', true);
            // 参数判断
            if (!$name) {
                $this->_json(0, dr_lang('目录名称不能为空'), ['field' => 'name']);
            } elseif (!preg_match('/^[a-z]+$/i', $name)) {
                $this->_json(0, dr_lang('目录只能是英文字母'), ['field' => 'name']);
            } elseif (is_dir(APPSPATH.ucfirst($name))) {
                $this->_json(0, dr_lang('此目录已经存在'), ['field' => 'name']);
            } elseif (!dr_check_put_path(APPSPATH)) {
                $this->_json(0, dr_lang('服务器没有创建目录的权限'), ['field' => 'name']);
            } elseif (\Phpcmf\Service::M('app')->is_sys_dir($name)) {
                $this->_json(0, dr_lang('目录[%s]名称是系统保留名称，请重命名', $name));
            }

            // 创建目录
            // 开始复制到指定目录
            $path = APPSPATH.ucfirst(strtolower($name)).'/';
            \Phpcmf\Service::L('File')->copy_file(APPPATH.'Code/App/', $path);
            if (!is_file($path.'Config/Routes.php')) {
                $this->_json(0, dr_lang('目录创建失败，请检查文件权限'));
            }

            // 替换模块配置文件
            $app = file_get_contents($path.'Models/My.php');
            $app = str_replace('{dir}', ucfirst($name), $app);
            file_put_contents($path.'Models/My.php', $app);

            // 复制版本文件
            file_put_contents($path.'Config/Version.php', "<?php

return [

    'id' => '0',
    'version' => 'dev',
    'license' => 'dev',
    'updatetime' => '2020-00-00',
    'downtime' => '2020-00-00',

];
");

            $this->_json(1, dr_lang('操作成功'));
        }

        \Phpcmf\Service::V()->assign([
            'form' => dr_form_hidden()
        ]);
        \Phpcmf\Service::V()->display('app_add.html');
        exit;
    }

    // 创建模块
    public function module_add() {

        if (!IS_USE_MODULE) {
            $this->_admin_msg(0, '没有安装「内容系统」插件');
        }

        if (IS_AJAX_POST) {

            $data = \Phpcmf\Service::L('input')->post('data');

            // 参数判断
            if (!$data['name']) {
                $this->_json(0, dr_lang('名称不能为空'), ['field' => 'name']);
            } elseif (!$data['dirname']) {
                $this->_json(0, dr_lang('目录不能为空'), ['field' => 'dirname']);
            } elseif (!preg_match('/^[a-z]+$/i', $data['dirname'])) {
                $this->_json(0, dr_lang('目录只能是英文字母'), ['field' => 'dirname']);
            } elseif (is_dir(APPSPATH.ucfirst($data['dirname']))) {
                $this->_json(0, dr_lang('此目录已经存在'), ['field' => 'dirname']);
            } elseif (!$data['icon']) {
                $this->_json(0, dr_lang('模块图标不能为空'), ['field' => 'icon']);
            } elseif (!dr_check_put_path(APPSPATH)) {
                $this->_json(0, dr_lang('服务器没有创建目录的权限'), ['field' => 'dirname']);
            } elseif (\Phpcmf\Service::M('app')->is_sys_dir($data['dirname'])) {
                $this->_json(0, dr_lang('目录[%s]名称是系统保留名称，请重命名', $data['dirname']));
            }

            // 开始复制到指定目录
            $path = APPSPATH.ucfirst($data['dirname']).'/';
            \Phpcmf\Service::L('File')->copy_file(dr_get_app_dir('module').'Temps/Module/', $path);
            if (!is_file($path.'Config/App.php')) {
                $this->_json(0, dr_lang('目录创建失败，请检查文件权限'), ['field' => 'dirname']);
            }

            // 替换模块配置文件
            $app = "<?php

return [

    'type' => 'app',
    'ftype' => 'module',
    'author' => '{author}',
    'name' => '{name}',
    'icon' => '{icon}',
    'system' => '1',
    'mtype' => '{mtype}',

];";
            $app = str_replace(['{name}', '{icon}', '{author}', '{mtype}'], [dr_safe_filename($data['name']), dr_safe_replace($data['icon']), dr_safe_replace($data['author']), intval($data['mtype'])], $app);
            file_put_contents($path.'Config/App.php', $app);

            file_put_contents($path.'Config/Version.php', "<?php

return [

    'id' => '0',
    'version' => 'dev',
    'license' => 'dev',
    'updatetime' => '2020-00-00',
    'downtime' => '2020-00-00',

];
");


            $this->_json(1, dr_lang('模块创建成功'));
            exit;

        }

        \Phpcmf\Service::V()->assign([
            'form' => dr_form_hidden(),
        ]);
        \Phpcmf\Service::V()->display('module_create.html');exit;
    }

    // 创建app
    public function app_add() {

        if (IS_AJAX_POST) {

            $data = \Phpcmf\Service::L('input')->post('data');

            // 参数判断
            if (!$data['name']) {
                $this->_json(0, dr_lang('名称不能为空'), ['field' => 'name']);
            } elseif (!$data['dirname']) {
                $this->_json(0, dr_lang('目录不能为空'), ['field' => 'dirname']);
            } elseif (!preg_match('/^[a-z_]+$/i', $data['dirname'])) {
                $this->_json(0, dr_lang('目录只能是英文字母'), ['field' => 'dirname']);
            } elseif (is_dir(APPSPATH.ucfirst($data['dirname']))) {
                $this->_json(0, dr_lang('此目录已经存在'), ['field' => 'dirname']);
            } elseif (!$data['icon']) {
                $this->_json(0, dr_lang('图标不能为空'), ['field' => 'icon']);
            } elseif (!dr_check_put_path(APPSPATH)) {
                $this->_json(0, dr_lang('服务器没有创建目录的权限'), ['field' => 'dirname']);
            } elseif (\Phpcmf\Service::M('app')->is_sys_dir($data['dirname'])) {
                $this->_json(0, dr_lang('目录[%s]名称是系统保留名称，请重命名', $data['dirname']));
            }

            // 开始复制到指定目录
            $data['dirname'] = strtolower($data['dirname']);
            $path = APPSPATH.ucfirst($data['dirname']).'/';
            \Phpcmf\Service::L('File')->copy_file(APPPATH.'Code/Myapp/', $path);
            if (!is_file($path.'Config/App.php')) {
                $this->_json(0, dr_lang('目录创建失败，请检查文件权限'), ['field' => 'dirname']);
            }

            // 替换模块配置文件
            file_put_contents($path.'Config/App.php', "<?php

return [

    'type' => 'app',
    'author' => '".dr_safe_filename($data['author'])."',
    'name' => '".dr_safe_filename($data['name'])."',
    'icon' => '".dr_safe_replace($data['icon'])."',

];");

            file_put_contents($path.'Config/Version.php', "<?php

return [

    'id' => '0',
    'version' => 'dev',
    'license' => 'dev',
    'updatetime' => '2020-00-00',
    'downtime' => '2020-00-00',

];
");

            file_put_contents($path.'Config/Menu.php', str_replace([
                'myapp',
                '我的测试插件',
                'fa fa-user',
            ], [
                $data['dirname'],
                $data['name'],
                $data['icon'],
            ], file_get_contents($path.'Config/Menu.php')));

            file_put_contents($path.'Models/My.php', str_replace([
                'Myapp',
            ], [
                ucfirst($data['dirname']),
            ], file_get_contents($path.'Models/My.php')));


            $this->_json(1, dr_lang('应用插件创建成功'));
        }

        \Phpcmf\Service::V()->assign([
            'form' => dr_form_hidden(),
        ]);
        \Phpcmf\Service::V()->display('app_create.html');exit;
    }


    // 应用控制器管理
    public function c_index() {

        $dir = ucfirst(\Phpcmf\Service::L('input')->get('dir', true));
        if (!$dir) {
            $this->_admin_msg(0, dr_lang('目录参数不存在'));
        }

        $path = APPSPATH.$dir.'/';
        if (!is_dir($path)) {
            $this->_admin_msg(0, dr_lang('目录[%s]不存在', $dir));
        } elseif (!is_file($path.'Config/Routes.php')) {
            $this->_admin_msg(0, dr_lang('应用[%s]缺少%s文件', $dir, $path.'Config/Routes.php'));
        }

        $data = [
            'admin' => [
                'path' => $dir.'/Controllers/Admin/',
                'type' => '<span class="badge badge-danger">'.dr_lang('后台控制器').'</span>',
                'file' => [],
            ],
            'member' => [
                'path' => $dir.'/Controllers/Member/',
                'type' => '<span class="badge badge-info">'.dr_lang('会员控制器').'</span>',
                'file' => [],
            ],
            'home' => [
                'path' => $dir.'/Controllers/',
                'type' => '<span class="badge badge-success">'.dr_lang('前端控制器').'</span>',
                'file' => [],
            ],
        ];
        $local = dr_file_map($path.'Controllers');
        if ($local) {
            foreach ($local as $file) {
                if (strpos($file, '.php') !== false) {
                    $data['home']['file'][] = $file;
                }
            }
        }
        $local = dr_file_map($path.'Controllers/Member');
        if ($local) {
            foreach ($local as $file) {
                if (strpos($file, '.php') !== false) {
                    $data['member']['file'][] = $file;
                }
            }
        }
        $local = dr_file_map($path.'Controllers/Admin');
        if ($local) {
            foreach ($local as $file) {
                if (strpos($file, '.php') !== false) {
                    $data['admin']['file'][] = $file;
                }
            }
        }

        \Phpcmf\Service::V()->assign([
            'dir' => $dir,
            'list' => $data,
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '开发者工具' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-code'],
                    '应用控制器管理' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/c_index{dir='.$dir.'}', 'fa fa-list'],
                    'help' => [681],
                ]
            ),
        ]);
        \Phpcmf\Service::V()->display('c_list.html');
    }

    // 创建控制器
    public function c_add() {

        $dir = ucfirst(\Phpcmf\Service::L('input')->get('dir', true));
        if (!$dir) {
            $this->_admin_msg(0, dr_lang('目录参数不存在'));
        }

        $path = $dir.'/Controllers/';
        if (!is_dir(APPSPATH.$path)) {
            $this->_admin_msg(0, dr_lang('目录[%s]不存在', APPSPATH.$path));
        }

        $tid = (\Phpcmf\Service::L('input')->get('tid'));
        if ($tid == 'admin') {
            $path.= 'Admin/';
        } elseif ($tid == 'member') {
            $path.= 'Member/';
        }

        if (IS_AJAX_POST) {

            $name = strtolower(dr_safe_filename(\Phpcmf\Service::L('input')->post('name')));
            $nfile = APPSPATH.$path.ucfirst($name).'.php';

            // 参数判断
            if (!$name) {
                $this->_json(0, dr_lang('文件名不能为空'), ['field' => 'name']);
            } elseif (!preg_match('/^[a-z0-9_]+$/i', $name)) {
                $this->_json(0, dr_lang('文件名只能是英文字母开头'), ['field' => 'name']);
            } elseif (is_file($nfile)) {
                $this->_json(0, dr_lang('此文件名已经存在'), ['field' => 'name']);
            } elseif (!dr_check_put_path(APPSPATH.$path)) {
                $this->_json(0, dr_lang('服务器没有创建文件的权限'), ['field' => 'name']);
            }

            // 备用文件
            if ($tid == 'admin') {
                $bfile = APPPATH.'Code/Controllers/Admin.php';
            } elseif ($tid == 'member') {
                $bfile = APPPATH.'Code/Controllers/Member.php';
            } else {
                $bfile = APPPATH.'Code/Controllers/Home.php';
            }

            if (!file_put_contents($nfile, file_get_contents($bfile))) {
                $this->_json(0, dr_lang('服务器没有创建文件的权限'), ['field' => 'name']);
            }

            // 替换文件
            $app = file_get_contents($nfile);
            $app = str_replace('{name}', ucfirst($name), $app);
            file_put_contents($nfile, $app);

            $this->_json(1, dr_lang('操作成功'));
        }

        \Phpcmf\Service::V()->assign([
            'path' => $path,
            'form' => dr_form_hidden(),
        ]);
        \Phpcmf\Service::V()->display('c_add.html');
        exit;
    }

    // 创建数据控制器
    public function db_add() {

        $dir = ucfirst(\Phpcmf\Service::L('input')->get('dir', true));
        if (!$dir) {
            $this->_admin_msg(0, dr_lang('目录参数不存在'));
        }
        $tid = ucfirst(\Phpcmf\Service::L('input')->get('tid', true));
        if (!in_array($tid, ['Member', 'Admin'])) {
            $this->_admin_msg(0, dr_lang('Tid参数不规范'));
        }

        $path = $dir.'/Controllers/'.$tid.'/';
        if (!is_dir(APPSPATH.$path)) {
            $this->_admin_msg(0, dr_lang('目录[%s]不存在', APPSPATH.$path));
        }

        $tables = \Phpcmf\Service::M()->db->query('show table status')->getResultArray();

        if (IS_AJAX_POST) {

            $name = strtolower(dr_safe_filename(\Phpcmf\Service::L('input')->post('name')));
            $nfile = APPSPATH.$path.ucfirst($name).'.php';

            $fname = strtolower(dr_safe_filename(\Phpcmf\Service::L('input')->post('fname')));
            !$fname && $fname = '未命名';

            $table = strtolower(dr_safe_filename(\Phpcmf\Service::L('input')->post('table')));
            if (!$table) {
                $this->_json(0, dr_lang('数据表未选择', $table), ['field' => 'table']);
            }

            $db = '';
            foreach ($tables as $t) {
                if ($t['Name'] == $table) {
                    $db = $table;
                    break;
                }
            }
            if (!$db) {
                $this->_json(0, dr_lang('数据表[%s]不可用', $table), ['field' => 'table']);
            }

            $where_list = "''";
            if ($tid == 'Admin') {
                $tpl = intval(dr_safe_filename(\Phpcmf\Service::L('input')->post('tpl')));
                if (!$tpl) {
                    $this->_json(0, dr_lang('模板格式未选择', $table), ['field' => 'tpl']);
                }
            } else {
                $tpl = 1;
                $uid = strtolower(dr_safe_filename(\Phpcmf\Service::L('input')->post('uid')));
                if ($uid) {
                    if (!\Phpcmf\Service::M()->is_field_exists($table, $uid)) {
                        $this->_json(0, dr_lang('数据表%s没有没有字段%s', $table, $uid), ['field' => 'table']);
                    }
                    $where_list = "'`".$uid."`='.\$this->uid";
                }
            }

            // 参数判断
            if (!$name) {
                $this->_json(0, dr_lang('文件名不能为空'), ['field' => 'name']);
            } elseif (!preg_match('/^[a-z0-9_]+$/i', $name)) {
                $this->_json(0, dr_lang('文件名只能是英文字母开头'), ['field' => 'name']);
            } elseif (is_file($nfile)) {
                $this->_json(0, dr_lang('此文件名已经存在'), ['field' => 'name']);
            } elseif (!dr_check_put_path(APPSPATH.$path)) {
                $this->_json(0, dr_lang('服务器没有创建文件的权限'), ['field' => 'name']);
            }

            // 备用文件
            $bfile = APPPATH.'Code/Table/'.$tid.'.php';
            if (!file_put_contents($nfile, file_get_contents($bfile))) {
                $this->_json(0, dr_lang('服务器没有创建文件的权限'), ['field' => 'name']);
            }

            // 字段配置
            $isid = 0;
            $field = \Phpcmf\Service::M()->db->query('SHOW FULL COLUMNS FROM `'.$db.'`')->getResultArray();
            $field_cfg = [];
            $list_field = [];

            foreach ($field as $t) {
                if ($t['Field'] == 'id') {
                    $isid = 1;
                    continue;
                }
                $ffname = $t['Comment'] ? $t['Comment'] : $t['Field'];
                $field_cfg[$t['Field']] = array(
                    'name' => $ffname,
                    'fieldname' => $t['Field'],
                    'ismain' => 1,
                    'ismember' => 1,
                    'fieldtype' => 'Text',
                );
                $list_field[$t['Field']] = array (
                    'use' => '1', // 1是显示，0是不显示
                    'name' => $ffname, //显示名称
                    'width' => '', // 显示宽度
                    'func' => '', // 回调函数见http://help.xunruicms.com/463.html
                    'center' => '0', // 1是居中，0是默认
                );
            }
            if (!$isid) {
                $this->_json(0, dr_lang('数据表[%s]没有id字段', $db), ['field' => 'table']);
            }

            // 替换文件
            $app = file_get_contents($nfile);
            $app = str_replace('{table}', trim(substr($db, strlen(\Phpcmf\Service::M()->dbprefix()))), $app);
            $app = str_replace('{cname}', ucfirst($name), $app); // 文件
            $app = str_replace('{name}', strtolower($name), $app); // 字段英文
            $app = str_replace('{tpl_prefix}', $tpl == 1 ? strtolower($name).'_' : 'table_', $app); // 字段英文
            $app = str_replace('{fname}', $fname, $app); // 字段中文
            $app = str_replace('{field}', var_export($field_cfg, true), $app);
            $app = str_replace('{list_field}', var_export($list_field, true), $app);
            $app = str_replace('{where_list}', $where_list, $app);
            file_put_contents($nfile, $app);

            // 模板文件
            if ($tid == 'Admin') {
                if ($tpl == 1) {
                    $tpl = APPSPATH.$dir.'/Views/';
                    dr_mkdirs($tpl);
                    $post = file_get_contents(CMSPATH.'View/table_post.html');
                    file_put_contents($tpl.strtolower($name).'_post.html', $post);
                    $post = file_get_contents(CMSPATH.'View/table_list.html');
                    file_put_contents($tpl.strtolower($name).'_list.html', $post);
                }
            } else {
                $tpl = TPLPATH.'pc/'.SITE_TEMPLATE.'/member/'.strtolower($dir).'/';
                dr_mkdirs($tpl);
                $post = file_get_contents(CMSPATH.'View/table_post.html');
                file_put_contents($tpl.strtolower($name).'_post.html', str_replace(['{template "header.html"}', '{template "footer.html"}'], ['{template "mheader.html"}', '{template "mfooter.html"}'], $post));
                $post = file_get_contents(CMSPATH.'View/table_list.html');
                file_put_contents($tpl.strtolower($name).'_list.html', str_replace(['{template "mytable.html"}', '{template "api_list_date_search.html"}', '{template "header.html"}', '{template "footer.html"}'], ['{template "mytable.html", "admin"}', '{template "api_list_date_search.html", "admin"}', '{template "mheader.html"}', '{template "mfooter.html"}'], $post));
            }

            $this->_json(1, dr_lang('操作成功'));
        }

        \Phpcmf\Service::V()->assign([
            'path' => $path,
            'form' => dr_form_hidden(),
            'tables' => $tables,
        ]);
        \Phpcmf\Service::V()->display('db_add_'.strtolower($tid).'.html');
        exit;
    }

    // 控制器详情
    public function show() {

        $dir = ucfirst(\Phpcmf\Service::L('input')->get('dir', true));
        if (!$dir) {
            $this->_admin_msg(0, dr_lang('目录参数不存在'));
        }

        $file = ucfirst(\Phpcmf\Service::L('input')->get('file', true));
        if (!$file) {
            $this->_admin_msg(0, dr_lang('文件参数不存在'));
        }

        $path = APPSPATH.$dir.'/Controllers/';
        if (!is_dir($path)) {
            $this->_admin_msg(0, dr_lang('目录[%s]不存在', $dir));
        }

        $tid = (\Phpcmf\Service::L('input')->get('tid', true));
        if ($tid == 'admin') {
            $path.= 'Admin/';
            $curl = SELF.'?s='.strtolower($dir).'&c='.strtolower(str_replace('.php', '', $file)).'&m=方法名称';
        } elseif ($tid == 'member') {
            $path.= 'Member/';
            $curl = 'index.php?s=member&app='.strtolower($dir).'&c='.strtolower(str_replace('.php', '', $file)).'&m=方法名称';
        } else {
            $curl = 'index.php?s='.strtolower($dir).'&c='.strtolower(str_replace('.php', '', $file)).'&m=方法名称';
        }

        $cfile = $path.$file;
        if (!is_file($cfile)) {
            $this->_admin_msg(0, dr_lang('控制器文件[%s]不存在', $cfile));
        }

        if (strpos(file_get_contents($cfile), 'TableDemo') !== false) {
            // 数据控制器
            $name = strtolower(str_replace('.php', '', $file));
            $curl = ADMIN_URL.SELF.'?s='.strtolower($dir).'&c='.$name.'&m=index';
            \Phpcmf\Service::V()->assign([
                'curl' => $curl,
                'cfile' => $cfile,
                'list_tpl' => APPSPATH.$dir.'/Views/'.$name.'_list.html',
                'post_tpl' => APPSPATH.$dir.'/Views/'.$name.'_post.html',
            ]);
            \Phpcmf\Service::V()->display('db_info.html');
        } else {
            // 通用控制器
            \Phpcmf\Service::V()->assign([
                'curl' => $curl,
                'cfile' => $cfile,
            ]);
            \Phpcmf\Service::V()->display('show.html');
        }



        exit;
    }


}
