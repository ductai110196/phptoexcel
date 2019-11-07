<?php
interface DBTool
{
    public function getdata();
    public function getbyid($id);
    public function getquery($sql);
    public function insert($data = array());
    public function update($id, $data = array());
    public function delete($id);
}