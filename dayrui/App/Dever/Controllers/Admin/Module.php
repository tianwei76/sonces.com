<?php namespace Phpcmf\Controllers\Admin;

// 开发者工具
class Module extends \Phpcmf\App
{

    public function index() {

        if (!IS_USE_MODULE) {
            $this->_admin_msg(0, '没有安装「内容系统」插件');
        }

        $my = [];
        $module = \Phpcmf\Service::M('Module')->All(); // 库中已安装模块
        if ($module) {
            foreach ($module as $t) {
                $dir = $t['dirname'];
                if (is_file(dr_get_app_dir($dir).'Config/App.php') && dr_is_module($dir)) {
                    $cfg = require dr_get_app_dir($dir).'Config/App.php';
                    $t['name'] = $cfg['name'] ? $cfg['name'] : $dir;
                    $my[$dir] = $t;
                }
            }
        }

        \Phpcmf\Service::V()->assign([
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '导出模块配置' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-table'],
                ]
            ),
            'my' => $my,
        ]);
        \Phpcmf\Service::V()->display('module_list.html');
    }

    public function edit() {

        $id = intval($_GET['id']);
        $module = \Phpcmf\Service::M()->table('module')->get($id);
        if (!$module) {
            exit('模块不存在');
        }

        $at = trim($_GET['at']);

        switch ($at) {

            case 'field':

                $field = \Phpcmf\Service::M()->db->table('field')
                    ->where('relatedname', 'module')
                    ->where('relatedid', $id)
                    ->orderBy('displayorder ASC, id ASC')
                    ->get()->getResultArray();
                if (!$field) {
                    exit('模块字段不存在');
                }
                $content = [
                    'table' => [

                    ],
                    'field' => [

                    ],
                ];
                foreach ($field as $t) {
                    unset($t['id'],$t['relatedid'],$t['relatedname']);
                    $t['setting'] = dr_string2array($t['setting']);
                    $content['field'][$t['ismain']][] = $t;
                }

                $site = dr_string2array($module['site']);
                if (!$site) {
                    exit('模块未安装');
                }
                foreach ($site as $sid => $t) {
                    $table = \Phpcmf\Service::M()->dbprefix(dr_module_table_prefix($module['dirname'], $sid));
                    break;
                }

                $sql = \Phpcmf\Service::M()->db->query("SHOW CREATE TABLE `".$table."`")->getRowArray();
                $content['table'][1] = str_replace(
                    array($sql['Table'], 'CREATE TABLE'),
                    array('{tablename}', 'CREATE TABLE IF NOT EXISTS'),
                    $sql['Create Table']
                );
                $sql = \Phpcmf\Service::M()->db->query("SHOW CREATE TABLE `".$table."_data_0`")->getRowArray();
                $content['table'][0] = str_replace(
                    array($sql['Table'], 'CREATE TABLE'),
                    array('{tablename}', 'CREATE TABLE IF NOT EXISTS'),
                    $sql['Create Table']
                );

                \Phpcmf\Service::V()->assign([
                    'note' => '保存到'.dr_get_app_dir($module['dirname']).'Config/Content.php',
                    'note2' => '将导出的配置文件保存在模块目录中，当重新安装模块时系统会帮你自动创建这些字段',
                    'content' => '<?php '.PHP_EOL.PHP_EOL.'return '.var_export($content, true).';',
                ]);
                \Phpcmf\Service::V()->display('module_copy.html');exit;
                break;

            case 'config':
                $id = intval($_GET['id']);
                $module = \Phpcmf\Service::M()->table('module')->get($id);
                if (!$module) {
                    exit('模块不存在');
                }

                \Phpcmf\Service::V()->assign([
                    'note' => '保存到'.dr_get_app_dir($module['dirname']).'Config/Setting.php',
                    'note2' => '将导出的配置文件保存在模块目录中，当重新安装模块时系统会帮你自动存储这些信息',
                    'content' => '<?php '.PHP_EOL.PHP_EOL.'return '.var_export(dr_string2array($module['setting']), true).';',
                ]);
                \Phpcmf\Service::V()->display('module_copy.html');exit;

                break;

            case 'mform':

                if (!dr_is_app('mform')) {
                    exit('模块表单插件未安装');
                }

                $id = intval($_GET['id']);
                $module = \Phpcmf\Service::M()->table('module')->get($id);
                if (!$module) {
                    exit('模块不存在');
                }

                $form = \Phpcmf\Service::M()->db->table('module_form')->where('module', $module['dirname'])->get()->getResultArray();
                if (!$form) {
                    exit('模块不存在表单');
                }

                $site = dr_string2array($module['site']);
                if (!$site) {
                    exit('模块未安装');
                }
                foreach ($site as $sid => $t) {
                    $table = \Phpcmf\Service::M()->dbprefix(dr_module_table_prefix($module['dirname'], $sid));
                    break;
                }

                $content = [];
                foreach ($form as $f) {
                    $ftable = $table.'_form_'.$f['table'];
                    $value = [
                        'form' => $f,
                    ];
                    $value['table'] = [
                        0 => [],
                        1 => [],
                    ];
                    $sql = \Phpcmf\Service::M()->db->query("SHOW CREATE TABLE `".$ftable."`")->getRowArray();
                    $value['table'][1] = str_replace(
                        array($sql['Table'], 'CREATE TABLE'),
                        array('{tablename}', 'CREATE TABLE IF NOT EXISTS'),
                        $sql['Create Table']
                    );
                    $sql = \Phpcmf\Service::M()->db->query("SHOW CREATE TABLE `".$ftable."_data_0`")->getRowArray();
                    $value['table'][0] = str_replace(
                        array($sql['Table'], 'CREATE TABLE'),
                        array('{tablename}', 'CREATE TABLE IF NOT EXISTS'),
                        $sql['Create Table']
                    );

                    $value['field'] = [
                        0 => [],
                        1 => [],
                    ];
                    $field = \Phpcmf\Service::M()->db->table('field')
                        ->where('relatedname', 'mform-'.$module['dirname'])
                        ->where('relatedid', $f['id'])
                        ->orderBy('displayorder ASC, id ASC')
                        ->get()->getResultArray();
                    if (!$field) {
                        exit('表单【'.$f['name'].'】字段不存在');
                    }
                    foreach ($field as $t) {
                        unset($t['id'],$t['relatedid'],$t['relatedname']);
                        $t['setting'] = dr_string2array($t['setting']);
                        $value['field'][$t['ismain']][] = $t;
                    }

                    $content[$f['table']] = $value;
                }

                \Phpcmf\Service::V()->assign([
                    'note' => '保存到'.dr_get_app_dir($module['dirname']).'Config/Form.php',
                    'note2' => '将导出的配置文件保存在模块目录中，当重新安装模块时系统会帮你自动安装表单',
                    'content' => '<?php '.PHP_EOL.PHP_EOL.'return '.var_export($content, true).';',
                ]);
                \Phpcmf\Service::V()->display('module_copy.html');exit;
                break;

            case 'config3':

                break;

            case 'config4':

                break;
        }

        exit('未定义接口');
    }


}
