<?php namespace Phpcmf\Controllers\Admin;

// 开发者工具
class Field extends \Phpcmf\App
{
    public function __construct()
    {
        parent::__construct();
        \Phpcmf\Service::V()->assign([
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '生成字段代码' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/index', 'fa fa-code'],
                    //'字段调用' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/code', 'fa fa-table'],
                    //'创建自定义字段' => [APP_DIR.'/'.\Phpcmf\Service::L('Router')->class.'/field', 'fa fa-plus'],
                ]
            ),
        ]);

    }

    /*
    public function index() {

        $rname = 'table-app_dever_field';
        $list = \Phpcmf\Service::M()->table('field')->where('relatedname', $rname)->where('relatedid', 0)->getAll();

        \Phpcmf\Service::V()->assign([
            'list' => $list,
            'rid' => 0,
            'rname' => $rname,
        ]);
        \Phpcmf\Service::V()->display('field.html');
    }*/

    public function field_code($id) {

        return '{dr_fieldform(\Phpcmf\Service::M(\'field\', \'dever\')->get('.$id.'), \'\')}';
    }


    public function field () {
        dr_redirect(dr_url('field/index', ['rname' => 'table-app_dever_field']));
    }


    public function index() {

        $ftype = \Phpcmf\Service::L('Field')->type('module');

        if (IS_POST) {

            $data = \Phpcmf\Service::L('input')->post('data');
            if (empty($data['fieldname'])) {
                $this->_json(0, dr_lang('字段名称不能为空'));
            } elseif (empty($data['fieldtype'])) {
                $this->_json(0, dr_lang('字段类别不能为空'));
            } elseif (!preg_match('/^[a-z]+[a-z0-9\_]+$/i', $data['fieldname'])) {
                $this->_json(0, dr_lang('字段名称不规范'));
            } elseif (strlen($data['fieldname']) > 20) {
                $this->_json(0, dr_lang('字段名称太长'));
            } else {
                $code = '<p>直接放在模板中的代码：<br></p>';
                $code.= '<textarea class="form-control" style="height:80px; width: 100%;">';
                $code.= '&lt;?'.'php echo dr_fieldform(\''.str_replace("'", "\'", dr_array2string($data)).'\', $'.$data['fieldname'].', 1, 1);?>';
                $code.= '</textarea>';
                $code.= '<br><br><p>二次开发时的配置代码：<br></p>';
                $code.= '<textarea class="form-control" style="height:170px; width: 100%;">';
                $code.= var_export($data, true);
                $code.= '</textarea>';
                $code.= '<br><br><p>后台字段导入的配置代码：<br></p>';
                $code.= '<textarea class="form-control" style="height:170px; width: 100%;">';
                $code.= dr_array2string($data);
                $code.= '</textarea>';
                $this->_json(1, '<div style="padding: 30px;">'.$code.'</div>');
            }
        }

        \Phpcmf\Service::V()->assign([
            'form' => dr_form_hidden(),
            'ftype' => $ftype,
        ]);
        \Phpcmf\Service::V()->display('field_admin.html');
    }

}
