<?php

class Unit extends AppModel {

  public $useTable = 'units';
  public $actsAs = array('Search.Searchable');
  public $filterArgs = array(
	  'name' => array('type' => 'query', 'method'=>'multiWordSearch'),
	  'search_period' => array('type' => 'query', 'method'=>'periodSearch'),
	  'senario' => array('type' => 'query', 'method'=>'senarioSearch'),
	  'nationality' => array('type' => 'value'),
	  'type' => array('type' => 'value'),
  );
  public $hasMany = array(
	  'Unitspec' => array(
		  'className' => 'Unitspec',
		  'foreignKey' => 'unit_id',
	  )
  );
  public $validate = array(
	  'name' => array(
		  'notBlank' => array(
			  'rule' => 'notBlank',
			  'required' => 'true',
			  'message' => '入力して下さい。'
		  ),
		  'isUnique' => array(
			  'rule' => 'isUnique',
			  'message' => '  すでに同名ユニットが登録されています。'
		  ),
	  ),
	  'nationality' => array(
		  'notBlank' => array(
			  'rule' => 'notBlank',
			  'required' => 'true',
			  'message' => '入力して下さい。'
		  ),
	  ),
	  'type' => array(
		  'notBlank' => array(
			  'rule' => 'notBlank',
			  'required' => 'true',
			  'message' => '入力して下さい。'
		  ),
	  ),
  );

  public function saveUnit($data) {
	$data = $this->addSpec($data);
	$this->save($data);
	$id = isset($data['Unit']['id']) ? $data['Unit']['id'] : $this->getLastInsertId();
	//画像保存(添付ある場合)
	$picture = $data['Unit']['picture'];
	if ($picture['error'] == 0) {
	  $path = IMAGES . DS . 'picture' . DS . $id;
	  if (file_exists($path)) {
		$this->removeDir($path);
	  }
	  mkdir($path, 0777, true);
	  $pictureName = mb_convert_encoding($picture['name'], "SJIS", "AUTO");
	  move_uploaded_file($picture['tmp_name'], $path . DS . $pictureName);
	}
	return $id;
  }

  public function getData($id) {
	$this->recurdive = -1;
	return $this->findById($id);
  }

  public function formatData($data) {
	for($i=1;$i<=3;$i++) {
	  $specColumns = array('fighting_speed_', 'crusing_speed_', 'crusing_range_', 'crusing_range_notank_', 'unti_fighter_', 'unti_bomber_');
	  foreach($specColumns as $column) {
		$data['Unitspec'][$i][$column] = $data['Unit'][$column . $i];
	  }
	}
	return $data;
  }

  public function addSpec($data) {
	$unitSpec = $data['Unitspec'];
	foreach ($unitSpec as $_key => $_value) {
	  $specColumns = array('fighting_speed', 'crusing_speed', 'crusing_range', 'crusing_range_notank', 'unti_fighter', 'unti_bomber');
	  foreach($specColumns as $column) {
		$data['Unit'][$column . '_' . $_key] = isset($_value[$column]) ? $_value[$column] : null;
	  }
	}
	unset($data['Unitspec']);
	return $data;
  }

  public function multiWordSearch($data = array()) {
	$keyword = mb_convert_kana($data['name'], "s", "UTF-8");
	$keyword = str_replace("　", " ", $keyword);
	$keywords = explode(' ', $keyword);
	//空文字削除
	$keywords = array_filter($keywords);
	  $conditions['OR'] = array();
	  foreach ($keywords as $count => $keyword) {
		$condition = array(
			'OR' => array(
				//検索対象のフィールド名、適宜変更や追加削除を行って下さい。
				$this->alias . '.name LIKE' => '%' . $keyword . '%',
			)
		);
		array_push($conditions['OR'], $condition);
	  }
	return $conditions;
  }

  public function multiWordHardSearch($data = array()) {
	$keyword = mb_convert_kana($data['name'], "s", "UTF-8");
	$keyword = str_replace("　", " ", $keyword);
	$keywords = explode(' ', $keyword);
	//空文字削除
	$keywords = array_filter($keywords);
	  $conditions['OR'] = array();
	  foreach ($keywords as $count => $keyword) {
		$condition = array(
			'OR' => array(
				//検索対象のフィールド名、適宜変更や追加削除を行って下さい。
				$this->alias . '.name' => $keyword,
			)
		);
		array_push($conditions['OR'], $condition);
	  }
	return $conditions;
  }
  
  public function senarioSearch($data = array()) {
	$senario = $data['senario'];
	$senarioUnit = Configure::read('Master.SenarioUnit.' . $senario);
	$searchData['name'] = $senarioUnit;
	return $this->multiWordHardSearch($searchData);
  }

  public function periodSearch($data = array()) {
	$period = $data['search_period'];
	$condition = array(
		'NOT' => array(
			$this->alias . '.fighting_speed_' . $period => null,
		)
	);
	return $condition;
  }
}