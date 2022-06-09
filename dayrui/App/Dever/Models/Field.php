<?php namespace Phpcmf\Model\Dever;

class Field extends \Phpcmf\Model {


    /*
     * 获取单个数据
     * 主键
     * */
    public function get($id) {

        $query = $this->db->table('field')->where('id', (int)$id)->get();
        if (!$query) {
            return [];
        }

        $rt = $query->getRowArray();
        if ($rt) {
            $rt['setting'] = dr_string2array($rt['setting']);
        }

        return $rt;
    }


}