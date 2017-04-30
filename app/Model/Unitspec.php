<?php
class Unitspec extends AppModel {
  public $useTable = 'unitspecs';

  public $belongsTo = array(
      'Unit' =>array(
	  'className'=>'Unit',
	  'foreignKey'=>'unit_id',
      )
  );
  public $validate = array(
	  'fighting_speed' => array(
		  'notBlank' => array(
			  'rule' => 'notBlank',
			  'message' => '入力して下さい。'
		  ),
		  'numeric' => array(
			  'rule' => 'numeric',
			  'message' => '半角数字で入力して下さい。'
		  ),
	  ),
//	  'crusing_speed' => array(
//		  'notBlank' => array(
//			  'rule' => 'notBlank',
//			  'message' => '入力して下さい。'
//		  ),
//		  'numeric' => array(
//			  'rule' => 'numeric',
//			  'message' => '半角数字で入力して下さい。'
//		  ),
//	  ),
//	  'crusing_range' => array(
//		  'notBlank' => array(
//			  'rule' => 'notBlank',
//			  'message' => '入力して下さい。'
//		  ),
//		  'numeric' => array(
//			  'rule' => 'numeric',
//			  'message' => '半角数字で入力して下さい。'
//		  ),
//	  ),
//	  'unti_fighter' => array(
//		  'notBlank' => array(
//			  'rule' => 'notBlank',
//			  'message' => '入力して下さい。'
//		  ),
//		  'numeric' => array(
//			  'rule' => 'numeric',
//			  'message' => '半角数字で入力して下さい。'
//		  ),
//	  ),
  ); 
}