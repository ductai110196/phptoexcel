<?php
interface DBTool
{
    public function getdata($db, $table);
    public function getbyid($db, $table, $id);
    public function getquery($db, $sql);
    public function insert($db, $table, $data = array());
    public function update($db, $table, $id, $data = array());
    public function delete($db, $table, $id);
}