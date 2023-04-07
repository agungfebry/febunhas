<?php
class M_galery extends CI_Model
{
    function get_data($table)
    {
        return $this->db->get($table);
    }
    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    function insert_galery($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // fungsi untuk menghapus data dari database
    function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }
}
