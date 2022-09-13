<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkerModel extends Model
{
    public function __construct()
    {
        // $db = \Config\Database::connect('anotherDB', true);
        $db = db_connect();
        $this->builder = $db->table('satker');
        $this->builder->orderBy('id_satker', 'ASC');
        $this->builder->select('*');
    }

    public function getBuilder()
    {
        return $this->builder->get();
    }

    public function edit($id, $value)
    {
        $this->builder->where('no_satker', $id);
        $this->builder->set('uraian', $value);
        return $this->builder->update();
    }
}
