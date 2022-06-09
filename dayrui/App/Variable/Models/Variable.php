<?php namespace Phpcmf\Model\Variable;

class Variable extends \Phpcmf\Model
{


    // 缓存
    public function cache() {

        // 新字段
        $table = \Phpcmf\Service::M()->dbprefix('var');
        if (\Phpcmf\Service::M()->db->tableExists($table)) {
            // 创建字段 游客点赞
            if (!\Phpcmf\Service::M()->db->fieldExists('hide', $table)) {
                \Phpcmf\Service::M()->query('ALTER TABLE `'.$table.'` ADD `hide` int(5) DEFAULT 0');
            }
        }

        $data = $this->table('var')->getAll();
        $cache = [];
        if ($data) {
            foreach ($data as $t) {
                if ($t['hide']) {
                    continue;
                }
                $cache[$t['cname']] = $t['value'];
            }
        }

        \Phpcmf\Service::L('cache')->set_file('var', $cache);
    }
}