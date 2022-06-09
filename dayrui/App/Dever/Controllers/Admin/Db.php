<?php namespace Phpcmf\Controllers\Admin;


class Db extends \Phpcmf\Common
{

	public function __construct() {
		parent::__construct();
		\Phpcmf\Service::V()->assign('menu', \Phpcmf\Service::M('auth')->_admin_menu(
			[
				'数据结构' => ['dever/db/index', 'fa fa-database'],
				'执行SQL' => ['dever/db/sql_add', 'fa fa-code'],
			]
		));
	}

	public function index() {

	    $list = \Phpcmf\Service::M()->db->query('show table status')->getResultArray();

		\Phpcmf\Service::V()->assign([
			'list' => $list,
            'uriprefix' => 'dever/db'
		]);
		\Phpcmf\Service::V()->display('db_index.html');
	}

	public function show_index() {

	    $table = dr_safe_replace(\Phpcmf\Service::L('input')->get('id'));
        $list = \Phpcmf\Service::M()->db->query('SHOW FULL COLUMNS FROM `'.$table.'`')->getResultArray();

		\Phpcmf\Service::V()->assign([
			'list' => $list,
			'table' => $table,
		]);
		\Phpcmf\Service::V()->display('db_show.html');exit;
	}

	// 批量操作
	public function add() {

	    $at = \Phpcmf\Service::L('input')->get('at');
        $ids = \Phpcmf\Service::L('input')->post('ids');
        if (!$ids) {
            $this->_json(0, dr_lang('没有选择表'));
        }

        $cache = [];
        $count = count($ids);
        if ($count > 100) {
            $pagesize = ceil($count/100);
            for ($i = 1; $i <= 100; $i ++) {
                $cache[$i] = array_slice($ids, ($i - 1) * $pagesize, $pagesize);
            }
        } else {
            for ($i = 1; $i <= $count; $i ++) {
                $cache[$i] = array_slice($ids, ($i - 1), 1);
            }
        }

        // 存储文件
        \Phpcmf\Service::L('cache')->set_data('db-todo-'.$at, $cache, 3600);
        $this->_json(1, 'ok', ['url' => dr_url('dever/db/count_index', ['at' => $at, 'hide_menu' => 1])]);
    }

    public function count_index() {

        $at = \Phpcmf\Service::L('input')->get('at');

        /*
        $i = 0;
        foreach ($ids as $table) {

            if (!$table) {
                continue;
            }

            switch ($at) {

                case 'x':
                    \Phpcmf\Service::M()->db->query('REPAIR TABLE `'.$table.'`');
                    break;

                case 'y':
                    \Phpcmf\Service::M()->db->query('OPTIMIZE TABLE `'.$table.'`');
                    break;

                case 's':
                    \Phpcmf\Service::M()->db->query('FLUSH TABLE `'.$table.'`');
                    break;

            }
            $i++;
        }*/


        \Phpcmf\Service::V()->assign([
            'todo_url' => dr_url('dever/db/todo_index', ['at' => $at]),
        ]);
        \Phpcmf\Service::V()->display('db_bfb.html');exit;
    }

    public function todo_index() {

        $at = \Phpcmf\Service::L('input')->get('at');
        $page = max(1, intval(\Phpcmf\Service::L('input')->get('page')));
        $cache = \Phpcmf\Service::L('cache')->get_data('db-todo-'.$at);
        if (!$cache) {
            $this->_json(0, '数据缓存不存在');
        }

        $data = $cache[$page];
        if ($data) {
            $html = '';
            foreach ($data as $table) {

                $ok = '完成';
                $class = '';
                switch ($at) {

                    case 'x':
                        \Phpcmf\Service::M()->db->query('REPAIR TABLE `'.$table.'`');
                        break;

                    case 'y':
                        \Phpcmf\Service::M()->db->query('OPTIMIZE TABLE `'.$table.'`');
                        break;

                    case 's':
                        // 取消刷新表，可能数据库的某些账号权限不允许
                        \Phpcmf\Service::M()->db->query('FLUSH TABLE `'.$table.'`');
                        break;

                    case 'ut':
                        \Phpcmf\Service::M()->db->query('ALTER TABLE `'.$table.'` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;');
                        break;

                    case 'jc':
                        $data = \Phpcmf\Service::M()->db->query('CHECK TABLE `'.$table.'`')->getRowArray();
                        if (!$data) {
                            $class = 'p_error';
                            $ok = "<span class='error'>".dr_lang('表信息读取失败')."</span>";
                        } else {
                            $ok = $data['Msg_text'];
                        }

                }

                $html.= '<p class="'.$class.'"><label class="rleft">'.$table.'</label><label class="rright">'.$ok.'</label></p>';
            }
            $this->_json($page + 1, $html);
        }

        // 完成
        \Phpcmf\Service::L('cache')->clear('db-todo-'.$at);
        $this->_json(100, '');
    }

    // 执行sql
    public function sql_add() {

        if (IS_POST) {
            $msg = '';
            $sqls = trim(\Phpcmf\Service::L('input')->post('sql'));
            $replace = [];
            $replace[0][] = '{dbprefix}';
            $replace[1][] = \Phpcmf\Service::M()->db->DBPrefix;
            $sql_data = explode(';SQL_FINECMS_EOL', trim(str_replace(array(PHP_EOL, chr(13), chr(10)), 'SQL_FINECMS_EOL', str_replace($replace[0], $replace[1], $sqls))));

            if ($sql_data) {
                foreach($sql_data as $query){
                    if (!$query) {
                        continue;
                    }
                    $ret = '';
                    $queries = explode('SQL_FINECMS_EOL', trim($query));
                    foreach($queries as $query) {
                        $ret.= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query;
                    }
                    $sql = trim($ret);
                    if (!$sql) {
                        continue;
                    }
                    $ck = 0;
                    foreach (['select', 'create', 'drop', 'alter', 'insert', 'replace', 'update', 'delete'] as $key) {
                        if (strpos(strtolower($sql), $key) === 0) {
                            if (!IS_DEV && in_array($key, ['create', 'drop', 'delete', 'alter'])) {
                                $this->_json(0, dr_lang('为了安全起见，在开发者模式下才能运行%s语句', $key), -1);
                            }
                            $ck = 1;
                            break;
                        }
                    }
                    if (!$ck) {
                        $this->_json(0, dr_lang('存在不允许执行的SQL语句：%s', dr_strcut($sql, 20)));
                    }
                    foreach (['outfile', 'dumpfile', '.php', 'union'] as $kw) {
                        if (strpos(strtolower($sql), $kw) !== false) {
                            $this->_json(0, dr_lang('存在非法SQL关键词：%s', $kw));
                        }
                    }
                    if (stripos($sql, 'select') === 0) {
                        // 查询语句
                        $db = \Phpcmf\Service::M()->db->query($sql);
                        !$db && $this->_json(0, dr_lang('查询出错'));
                        $rt = $db->getResultArray();
                        if ($rt) {
                            $msg.= var_export($rt, true);
                        } else {
                            $rt = \Phpcmf\Service::M()->db->error();
                            \Phpcmf\Service::L('File')->add_sql_cache($sql);
                            $this->_json(0, $rt['message']);
                        }
                    } else {
                        // 执行语句
                        $db = \Phpcmf\Service::M()->db->query($sql);
                        if (!$db) {
                            $rt = \Phpcmf\Service::M()->db->error();
                            $this->_json(0, '查询错误：'.$rt['message']);
                        }
                    }
                }
                $this->_json(1, $msg ? $msg : dr_lang('执行完成'));
            } else {
                $this->_json(0, dr_lang('不存在的SQL语句'));
            }
        }

        \Phpcmf\Service::V()->assign([
            'sql_cache' => \Phpcmf\Service::L('File')->get_sql_cache(),
        ]);
        \Phpcmf\Service::V()->display('db_sql.html');
    }
}
