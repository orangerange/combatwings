<?php

class UnitsController extends AppController {

  public $uses = array('Unit', 'Unitspec');
  public $components = array('Paginator', 'Search.Prg');
   public $presetVars = array(
    array('field' => 'name', 'type' => 'value'),
    array('field' => 'nationality', 'type' => 'value'),
    array('field' => 'type', 'type' => 'value'),
    array('field' => 'sort','type' => 'value'),
    array('field' => 'search_period','type' => 'value'),
    array('field' => 'senario','type' => 'value'),
    array('field' => 'submit_type','type' => 'value'),
    array('field' => 'selected_units','type' => 'value'),
    array('field' => 'limit','type' => 'value'),
    array('field' => 'period','type' => 'value'),
    array('field' => 'dice_sum','type' => 'value'),
    array('field' => 'calculate_type','type' => 'value'),
    array('field' => 'attacker','type' => 'value'),
    array('field' => 'ss_target','type' => 'value'),
  );

  public function index() {
	$this->Unit->validate = array();
	$this->Prg->commonProcess();
	$calculateFlg=false;
	$count = $this->Unit->find('count', array(
		'conditions' => array(
			$this->Unit->parseCriteria($this->passedArgs)
		),
	));
	$limit = isset($this->request->data['Unit']['limit']) ? $this->request->data['Unit']['limit'] : 5;
	$maxPage = ceil($count/$limit);
	if(isset($this->request->params['named']['page']) && $this->request->params['named']['page'] > $maxPage) {
	  $this->request->params['named']['page'] = 1;
	}
	$order = array('Unit.nationality' => 'ASC', 'Unit.type' => 'Asc');
	if(isset($this->request->data['Unit']['sort'])) {
	  $sort = $this->request->data['Unit']['sort'];
	}
	if(!empty($sort)) {
	  $order = Configure::read('Master.Unit.SortCode.' . $sort) + $order;
	}
	$this->Paginator->settings = array(
		'recursive' => 2,
		'conditions' => array(
			$this->Unit->parseCriteria($this->passedArgs)
		),
		'limit' => $limit,
		'order' => $order,
	);
	if (isset($this->request->data['Unit']['submit_type']) && $this->request->data['Unit']['submit_type'] == 'calculate') {
	  $this->Session->delete('Unit.selectedUnits');
	  $this->Session->delete('Period');
	  $this->Session->delete('Calculate');

	  $this->Session->write('Unit.selectedUnits', array_filter($this->request->data['Unit']['selected_units']));
	  $this->Session->write('Period', $this->request->data['Unit']['period']);
	  $this->Session->write('Calculate.Type', $this->request->data['Unit']['calculate_type']);
	  $this->Session->write('Calculate.DiceSum', $this->request->data['Unit']['dice_sum']);
	  $this->Session->write('Calculate.Attacker', $this->request->data['Unit']['attacker']);
	  $this->Session->write('Calculate.SSTarget', $this->request->data['Unit']['ss_target']);
	  $calculateFlg=true;
	}
	$this->set(compact('calculateFlg'));
	$this->set('units', $this->Paginator->paginate());
  }

  public function calculate(){
	$selectedUnits = $this->Session->read('Unit.selectedUnits');
	$period = $this->Session->read('Period');
	$calculate = $this->Session->read('Calculate');
	$selectedIds = array();
	foreach($selectedUnits as $_key=>$_value) {
	  $selectedIds[]=$_key;
	}
	$periodFightingSpeed = 'Unit.fighting_speed_' . $period;
	$units = $this->Unit->find('all', array('recursive'=>'-1', 'conditions'=>array('NOT'=>array($periodFightingSpeed=>null), 'Unit.id'=>$selectedIds),'order'=>array('Unit.nationality' => 'ASC', 'Unit.type' => 'Asc')));
	$usUnits=array();
	$ssUnits=array();
	$usPowerSum = 0;
	$ssPowerSum = 0;
	foreach($units as $_unit) {
	  $_unit['Unit']['num'] = $selectedUnits[$_unit['Unit']['id']];
	  if($_unit['Unit']['nationality']==Configure::read('Master.Unit.NationalityKey.US') && $_unit['Unit']['type'] == $calculate['SSTarget']) {
		$_unit['Unit']['one_power'] = $_unit['Unit']['unti_fighter_' . $period];
		$_unit['Unit']['power'] = $_unit['Unit']['one_power'] * $_unit['Unit']['num'];
		$usPowerSum += $_unit['Unit']['power'];
		$usUnits[] = $_unit;
	  }
	  elseif($_unit['Unit']['nationality']==Configure::read('Master.Unit.NationalityKey.SS')) {
		$_unit['Unit']['one_power'] = $calculate['SSTarget'] == Configure::read('Master.Calculate.SSTargetKey.Fighter') ? $_unit['Unit']['unti_fighter_' . $period] : $_unit['Unit']['unti_bomber_' . $period];
		$_unit['Unit']['power'] = $_unit['Unit']['one_power'] * $_unit['Unit']['num'];
		$ssPowerSum += $_unit['Unit']['power'];
		$ssUnits[] = $_unit;
	  }
	}
	$diceSum = $calculate['DiceSum'];
	if($diceSum < 1 || empty($diceSum)) {
	  $diceSum = 1;
	}
	if($diceSum > 14) {
	  $diceSum = 14;
	}
	if ($usPowerSum <= 0 || $ssPowerSum <= 0) {
	  $usRatio = '判定不能';
	  $ssRatio = '判定不能';
	  $usDamage = '判定不能';
	  $ssDamage = '判定不能';
	} else {
	  if ($usPowerSum > $ssPowerSum) {
		$ratio = $usPowerSum / $ssPowerSum;
		$usRatio = $calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.US') ? floor($ratio) : ceil($ratio);
		$ssRatio = 1;
		if($calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.US')) {
		  $usDamage = 0;
		  if ($usRatio <= 4) {
			$ssDamage = Configure::read('Master.Calculate.Damage.Attacker.' . $usRatio . '.' . $diceSum);
		  }
		  else {
			$count = floor($usRatio/4);
			$other = $usRatio - 4 * $count;
			$repeatedDamage = Configure::read('Master.Calculate.Damage.Attacker.' . 4 . '.' . $diceSum);
			$otherDamage = $other > 0 ? Configure::read('Master.Calculate.Damage.Attacker.' . $other . '.' . $diceSum) : 0;
			$allDamage = $repeatedDamage * $count + $otherDamage;
			$ssDamage = $repeatedDamage . '×' . $count . '＋' . $otherDamage . '=' . $allDamage;
		  }
		}
		else {
		  $ssDamage=0;
		   if ($usRatio <= 4) {
			$usDamage = Configure::read('Master.Calculate.Damage.Defender.' . $usRatio . '.' . $diceSum);
		  }
		  else {
			$ssDamage = 0;
		  }
		}
	  } elseif ($usPowerSum < $ssPowerSum) {
		$ratio = $ssPowerSum / $usPowerSum;
		$ssRatio = $calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.SS') ? floor($ratio) : ceil($ratio);
		$usRatio = 1;
		if($calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.US')) {
		  $usDamage = 0;
		   if($ssRatio <= 4) {
			$ssDamage = Configure::read('Master.Calculate.Damage.Defender.' . $ssRatio . '.' . $diceSum);
		  }
		  else {
			$ssDamage = 0;
		  }
		}
		else {
		  $ssDamage = 0;
		  if ($ssRatio <= 4) {
			$usDamage = Configure::read('Master.Calculate.Damage.Attacker.' . $ssRatio . '.' . $diceSum);
		  }
		  else {
			$usDamage = 'めちゃ多い';
			$count = floor($ssRatio/4);
			$other = $ssRatio - 4 * $count;
			$repeatedDamage = Configure::read('Master.Calculate.Damage.Attacker.' . 4 . '.' . $diceSum);
			$otherDamage = $other > 0 ? Configure::read('Master.Calculate.Damage.Attacker.' . $other . '.' . $diceSum) : 0 ;
			$allDamage = $repeatedDamage * $count + $otherDamage;
			$usDamage = $repeatedDamage . '×' . $count . '＋' . $otherDamage . '=' . $allDamage;
		  }
		}
	  } else {
		$usRatio = 1;
		$ssRatio = 1;
		$usDamage = $calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.SS') ? 0 : Configure::read('Master.Calculate.Damage.Attacker.' . 1 . '.' . $diceSum);
		$ssDamage = $calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.SS') ? Configure::read('Master.Calculate.Damage.Attacker.' . 1 . '.' . $diceSum) : 0;
	  }
	}
	$this->set(compact('calculate', 'usUnits', 'ssUnits', 'usPowerSum', 'ssPowerSum', 'usRatio', 'ssRatio', 'usDamage', 'ssDamage'));
  }

  public function input() {
	if ($this->request->is('post')) {
	  $this->Unit->set($this->request->data);
	  //ドイツ軍機の場合は対爆撃機戦闘力も必須
	  if ($this->request->data['Unit']['nationality'] == Configure::read('Master.Unit.NationalityKey.SS')) {
		$this->Unitspec->validate += array('unti_bomber' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => '入力して下さい。',
				),
				'numeric' => array(
					'rule' => 'numeric',
					'message' => '半角数字で入力して下さい。'
				),
			),
		  );
	  }
	  //存在しない期間についてポストしない
	  for($i=1; $i<=3; $i++) {
		if($this->request->data['Unit']['none_' . $i] ==1) {
		  unset($this->request->data['Unitspec'][$i]);
		}
	  }
	  //saveAllによりassociationを含むバリデーション
	  if ($this->Unit->saveAll($this->request->data, array('validate' => 'only'))) {
		if($this->request->data['Unit']['picture']['error'] == 0) {
		  $this->request->data['Unit']['picture_name'] = $this->request->data['Unit']['picture']['name'];
		}
		$newId = $this->Unit->saveUnit($this->request->data);
		$this->set(compact('newId'));
		$this->Session->setFlash('ユニットを登録しました。');
	  }
	  else {
		$this->Session->setFlash('入力にエラーがあります。');
	  }
	}
  }

  public function edit($id=null) {
	$data = $this->Unit->getData($id);
	 $data = $this->Unit->formatData($data);
	$this->set('editFlg', true);
	if(!isset($id)) {
	  die('不正な遷移です。');
	}
	if (!preg_match("/^[0-9]+$/", $id)) {
	  die('不正な遷移です。');
	}
	if($this->request->is('post') || $this->request->is('put')) {
	  $this->Unit->set($this->request->data);
	  $this->Unit->id = $id;
	  $this->request->data['Unit']['id'] = $id;
	  if ($this->request->data['Unit']['nationality'] == Configure::read('Master.Unit.NationalityKey.SS')) {
		$this->Unitspec->validate += array('unti_bomber' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => '入力して下さい。',
				),
				'numeric' => array(
					'rule' => 'numeric',
					'message' => '半角数字で入力して下さい。'
				),
			),
		  );
	  }
	   //存在しない期間についてポストしない
	  for($i=1; $i<=3; $i++) {
		if($this->request->data['Unit']['none_' . $i] ==1) {
		  unset($this->request->data['Unitspec'][$i]);
		}
	  }
	  //saveAllによりassociationを含むバリデーション
	  if ($this->Unit->saveAll($this->request->data, array('validate' => 'only'))) {
		//新たな画像あればその画像
		if($this->request->data['Unit']['picture']['error'] == 0) {
		  $this->request->data['Unit']['picture_name'] = $this->request->data['Unit']['picture']['name'];
		}
		//無ければ前の画像
		else {
		  $this->request->data['Unit']['picture_name'] = $data['Unit']['picture_name'];
		}
		$this->Unit->saveUnit($this->request->data);
		$this->Session->setFlash('ユニットを更新しました。');
	  }
	  else {
		$this->request->data['Unit']['id'] = $id;
		$this->request->data['Unit']['picture_name'] = $data['Unit']['picture_name'];
		$this->Session->setFlash('入力にエラーがあります。');
	  }
	}
	//初期遷移
	else {
	  $data = $this->Unit->getData($id);
	  $data = $this->Unit->formatData($data);
	  $this->request->data = $data;
	}
	$this->render('/Units/input');
  }
}
