<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 01-Mar-17
 * Time: 15:20
 */

namespace Application\Models;


use Application\Loader;

abstract class MainModel
{
	public $connect;

	protected $table;
	protected $fields;
	protected $join;

    private $dataContainer=[];
	public function __construct()
	{
		$this->connect = Loader::app()->getDB();
	}
	public function withRelate(){
		if($this->join === null) return;
		foreach($this->join as $join_table=>$join_keys){
			$this->connect->join($join_table, [$join_keys[0], $join_keys[1]]);
		}
	}
	public function insert(array $data){
        $this->dataContainer = $data;
		return $this->connect->insert($this->table, $data);
	}
	public function update(array $data, $where = null){
        $this->dataContainer = $data;
		if($where != null && is_array($where)) $this->where($where);
		$this->connect->update($this->table, $data);
	}
	public function delete($where = null){
		if($where != null && is_array($where)) $this->where($where);
		$this->connect->delete($this->table);
	}
	public function select($showFields = '*', $where = null){
		if($where != null && is_array($where)) $this->where($where);
		$this->withRelate();
		return $this->connect->get($this->table, null, $showFields);
	}
}