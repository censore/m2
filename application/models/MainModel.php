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
	public $limit_count = 1;
	public $limit_offset = 1;
    public $ignore = [
        'brand_link'=>'/cars/',
        'type_link'=>'/cars/',
    ];

	protected $table;
	protected $fields;
	protected $join;
	protected $lock;


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
		$result = $this->connect->insert($this->table, $data);
		if($this->connect->getLastError()) throw new \Exception($this->connect->getLastError());
		return $result;
	}
	public function update(array $data, $where = null){
        $this->dataContainer = $data;
		if($where != null && is_array($where)) $this->where($where);
		$result = $this->connect->update($this->table, $data);
		if($this->connect->getLastError()) throw new \Exception($this->connect->getLastError());
		return $result;
	}
	public function delete($where = null){
		if($where != null && is_array($where)) $this->where($where);
		$result = $this->connect->delete($this->table);
		if($this->connect->getLastError()) throw new \Exception($this->connect->getLastError());
		return $result;
	}
	public function select($showFields = '*', $where = null){
		if($where != null && is_array($where)) $this->where($where);
		$this->withRelate();

		$result = $this->connect->get($this->table, [$this->limit_count, $this->limit_offset], $showFields);
		if($this->connect->getLastError()) throw new \Exception($this->connect->getLastError());
		return $result;
	}
	public function setRandom(){
		$this->connect->orderBy('RAND()');
        return $this;
	}
	public function insertIfNonExists($data = [], $where = null, $replace = false){
		if($where != null && is_array($where)) $this->where($where);
        $this->where($data);
		$result =$this->connect->get($this->table, null, 'COUNT(*) as `total`')[0];
		if($result['total'] == 0){
			return $this->insert($data);
		}
		if($replace == true){
			return $this->connect->replace($this->table, $data);
		}
		return $this;
	}

	public function where($condition, $row = ''){
		if(is_array($condition)){
			foreach($condition as $key=>$value){
				$this->connect->where($key, $value);
			}
		}else{
			$this->connect->where($condition, $row);
		}
	}
	public function setLock(){
		//if($this->lock == true) $this->connect->lock($this->table); echo "Loced table" . PHP_EOL;
		return $this;
	}
	public function setUnlock(){
		//if($this->lock == true) $this->connect->unlock(); echo "Unlocked table" . PHP_EOL;
		return $this;
	}
	public function limit($limit = 1, $offset = 0){
		$this->limit_count = $limit;
		$this->limit_offset = $offset;
	}
}