<?php namespace Phpcmf\Controllers\Member;
/* *
 *
 * 本Demo的语法参考： http://help.xunruicms.com/445.html
 *
 * */
class {cname} extends \Phpcmf\Table
{

    public function __construct()
    {
        parent::__construct();
        // 表单显示名称
        $this->name = dr_lang('{fname}');
        // 模板前缀(避免混淆)
        $this->tpl_prefix = '{tpl_prefix}';

        // 采用ajax列表请求
        $this->is_ajax_list = true;

        // 用于表储存的字段，后台可修改的表字段，设置字段类别参考：http://help.xunruicms.com/1138.html
        $field = {field};

        // 用于列表显示的字段
        $list_field = {list_field};
        /*
         *array (
                    'use' => '1', // 1是显示，0是不显示
                    'name' => '', //显示名称
                    'width' => '', // 显示宽度
                    'func' => '', // 回调函数见：http://help.xunruicms.com/463.html
                    'center' => '0', // 1是居中，0是默认
                )
         * */

        // 初始化数据表
        $this->_init([
            'table' => '{table}',  // （不带前缀的）表名字
            'field' => $field, // 可查询的字段
            'list_field' => $list_field,
            'order_by' => 'id desc', // 列表排序，默认的排序方式
            'date_field' => '', // 按时间段搜索字段，没有时间字段留空
            'where_list' => {where_list}, // 默认搜索条件，每次列表都执行
        ]);
        $this->edit_where = {where_list}; //修改数据时候的条件判断
        $this->delete_where = {where_list}; //删除数据时候的条件判断
        $this->list_where = {where_list}; //数据列表时候的条件判断

        // 把公共变量传入模板
        \Phpcmf\Service::V()->assign([
            // 搜索字段
            'field' => $field,
            'is_time_where' => $this->init['date_field'],
        ]);
    }

    // 查看列表
    public function index() {
        list($tpl) = $this->_List();
        \Phpcmf\Service::V()->display($tpl);
    }

    // 添加内容
    public function add() {
        list($tpl) = $this->_Post(0);
        \Phpcmf\Service::V()->display($tpl);
    }

    // 修改内容
    public function edit() {
        list($tpl) = $this->_Post(intval(\Phpcmf\Service::L('input')->get('id')));
        \Phpcmf\Service::V()->display($tpl);
    }

    // 删除内容
    public function del() {
        $this->_Del(
            \Phpcmf\Service::L('Input')->get_post_ids(),
            function($rows) {
                // 删除前的验证
                return dr_return_data(1, 'ok', $rows);
            },
            function($rows) {
                // 删除后的处理
                return dr_return_data(1, 'ok');
            },
            \Phpcmf\Service::M()->dbprefix($this->init['table'])
        );
    }

    /**
     * 获取内容
     * $id      内容id,新增为0
     * */
    protected function _Data($id = 0) {
        $row = parent::_Data($id);
        // 这里可以对内容进行格式化显示操处理
        return $row;
    }

    // 格式化保存数据
    protected function _Format_Data($id, $data, $old) {
        if (!$id) {
            // 当提交新数据时，把当前时间插入进去
            //$data[1]['inputtime'] = SYS_TIME;
        }
        return $data;
    }


    // 保存内容
    protected function _Save($id = 0, $data = [], $old = [], $func = null, $func2 = null) {
        return parent::_Save($id, $data, $old, function($id, $data, $old){
            // 验证数据
            /*
            if (!$data[1]['title']) {
                return dr_return_data(0, '标题不能为空！', ['field' => 'title']);
            }*/
            // 保存之前执行的函数，并返回新的数据
            if (!$id) {
                // 当提交新数据时，把当前时间插入进去
                //$data[1]['inputtime'] = SYS_TIME;
            }

            return dr_return_data(1, null, $data);
        }, function ($id, $data, $old) {
            // 保存之后执行的动作
        });
    }

}
