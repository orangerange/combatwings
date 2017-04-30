<?php

$config['Master'] = array(
	'Period' => array(
		'1' => 'a(～1943年10月)',
		'2' => 'b(1943年11月～1944年1月)',
		'3' => 'c(1944年2月～)',
	),
	'Senario' => array(
		'1' => '練習',
		'2' => '短期1',
	),
	'SenarioKey' => array(
		'Practice' => 1,
		'Short1' => 2,
	),
	'SenarioUnit' => array(
		'1' => 'B17 B24 P47 SPITFIRE Bf109 Fw190 Bf110 Me210/40(N) Ju88',
		'2' => 'B17 B26 P47 SPITFIRE Bf109 Fw190 Bf110 Ju88',
	),
	'Unit' => array(
		'Limit'=>array(
			'5'=>'5件',
			'10'=>'10件',
			'21'=>'21件'
		),
		'Type' => array(
			'1' => '戦闘機',
			'2' => '爆撃機',
		),
		'TypeKey' => array(
			'F' => 1,
			'B' => 2,
		),
		'Nationality' => array(
			'2' => '連合',
			'3' => '枢軸'
		),
		'NationalityKey' => array(
			'US' => 2,
			'SS' => 3,
		),
		'Sort1' => array(
			'1' => '戦闘速度(a)昇順',
			'2' => '戦闘速度(a)降順',
			'3' => '戦闘速度(b)昇順',
			'4' => '戦闘速度(b)降順',
			'5' => '戦闘速度(c)昇順',
			'6' => '戦闘速度(c)降順',),
		'Sort2' => array(
			'7' => '巡航速度(a)昇順',
			'8' => '巡航速度(a)降順',
			'9' => '巡航速度(b)昇順',
			'10' => '巡航速度(b)降順',
			'11' => '巡航速度(c)昇順',
			'12' => '巡航速度(c)降順',),
		'Sort3' => array(
			'13' => '航続力(a)昇順',
			'14' => '航続力(a)降順',
			'15' => '航続力(b)昇順',
			'16' => '航続力(b)降順',
			'17' => '航続力(c)昇順',
			'18' => '航続力(c)降順',),
		'Sort4' => array(
			'19' => '増槽なし航続力(a)昇順',
			'20' => '増槽なし航続力(a)降順',
			'21' => '増槽なし航続力(b)昇順',
			'22' => '増槽なし航続力(b)降順',
			'23' => '増槽なし航続力(c)昇順',
			'24' => '増槽なし航続力(c)降順',),
		'Sort5' => array(
			'25' => '対戦戦闘(a)昇順',
			'26' => '対戦戦闘(a)降順',
			'27' => '対戦戦闘(b)昇順',
			'28' => '対戦戦闘(b)降順',
			'29' => '対戦戦闘(c)昇順',
			'30' => '対戦戦闘(c)降順',),
		'Sort6' => array(
			'31' => '対爆戦闘(a)昇順',
			'32' => '対爆戦闘(a)降順',
			'33' => '対爆戦闘(b)昇順',
			'34' => '対爆戦闘(b)降順',
			'35' => '対爆戦闘(c)昇順',
			'36' => '対爆戦闘(c)降順',
		),
		'SortCode' => array(
			'1' => array('Unit.fighting_speed_1' => 'ASC'),
			'2' =>  array('Unit.fighting_speed_1' => 'DES C'),
			'3' => array('Unit.fighting_speed_2' => 'ASC'),
			'4' =>  array('Unit.fighting_speed_2' => 'DESC'),
			'5' => array('Unit.fighting_speed_3' => 'ASC'),
			'6' =>  array('Unit.fighting_speed_3' => 'DESC'),
			'7' => array('Unit.crusing_speed_1' => 'ASC'),
			'8' =>  array('Unit.crusing_speed_1' => 'DESC'),
			'9' => array('Unit.crusing_speed_2' => 'ASC'),
			'10' =>  array('Unit.crusing_speed_2' => 'DESC'),
			'11' => array('Unit.crusing_speed_3' => 'ASC'),
			'12' =>  array('Unit.crusing_speed_3' => 'DESC'),
			'13' => array('Unit.crusing_range_1' => 'ASC'),
			'14' =>  array('Unit.crusing_range_1' => 'DESC'),
			'15' => array('Unit.crusing_range_2' => 'ASC'),
			'16' =>  array('Unit.crusing_range_2' => 'DESC'),
			'17' => array('Unit.crusing_range_3' => 'ASC'),
			'18' =>  array('Unit.crusing_range_3' => 'DESC'),
			'19' => array('Unit.crusing_range_notank_1' => 'ASC'),
			'20' =>  array('Unit.crusing_range_notank_1' => 'DESC'),
			'21' => array('Unit.crusing_range_notank_2' => 'ASC'),
			'22' =>  array('Unit.crusing_range_notank_2' => 'DESC'),
			'23' => array('Unit.crusing_range_notank_3' => 'ASC'),
			'24' =>  array('Unit.crusing_range_notank_3' => 'DESC'),
			'25' => array('Unit.unti_fighter_1' => 'ASC'),
			'26' =>  array('Unit.unti_fighter_1' => 'DESC'),
			'27' => array('Unit.unti_fighter_2' => 'ASC'),
			'28' =>  array('Unit.unti_fighter_2' => 'DESC'),
			'29' => array('Unit.unti_fighter_3' => 'ASC'),
			'30' =>  array('Unit.unti_fighter_3' => 'DESC'),
			'31' => array('Unit.unti_bomber_1' => 'ASC'),
			'32' =>  array('Unit.unti_bomber_1' => 'DESC'),
			'33' => array('Unit.unti_bomber_2' => 'ASC'),
			'34' =>  array('Unit.unti_bomber_2' => 'DESC'),
			'35' => array('Unit.unti_bomber_3' => 'ASC'),
			'36' =>  array('Unit.unti_bomber_3' => 'DESC'),
		),
	),
	'Calculate'=>array(
		'Type'=>array(
			'1'=>'空戦',
		),
		'TypeKey'=>array(
			'Fight'=> 1,
		),
		'Attacker'=>array(
			'1'=>'連合攻撃',
			'2'=>'枢軸攻撃',
		),
		'AttackerKey'=>array(
			'US'=> 1,
			'SS'=> 2,
		),
		'SSTarget'=>array(
			'1'=>'枢軸対戦闘機',
			'2'=>'枢軸対爆撃機',
		),
		'SSTargetKey'=>array(
			'Fighter'=> 1,
			'Bomber'=> 2,
		),
		'Damage'=>array(
			'Attacker' => array(
				1=>array(
					1=>0,
					2=>0,
					3=>0,
					4=>0,
					5=>1,
					6=>1,
					7=>1,
					8=>1,
					9=>1,
					10=>1,
					11=>2,
					12=>2,
					13=>2,
					14=>2,
				),
				2=>array(
					1=>0,
					2=>1,
					3=>1,
					4=>1,
					5=>1,
					6=>1,
					7=>2,
					8=>2,
					9=>2,
					10=>2,
					11=>2,
					12=>3,
					13=>3,
					14=>3,
				),
				3=>array(
					1=>1,
					2=>1,
					3=>1,
					4=>2,
					5=>2,
					6=>2,
					7=>2,
					8=>3,
					9=>3,
					10=>3,
					11=>3,
					12=>4,
					13=>4,
					14=>4,
				),
				4=>array(
					1=>1,
					2=>1,
					3=>2,
					4=>2,
					5=>2,
					6=>3,
					7=>3,
					8=>3,
					9=>4,
					10=>4,
					11=>4,
					12=>5,
					13=>5,
					14=>5,
				),
			  ),
			'Defender' => array(
				1=>array(
					1=>0,
					2=>0,
					3=>0,
					4=>0,
					5=>1,
					6=>1,
					7=>1,
					8=>1,
					9=>1,
					10=>1,
					11=>2,
					12=>2,
					13=>2,
					14=>2,
				),
				2=>array(
					1=>0,
					2=>0,
					3=>0,
					4=>0,
					5=>0,
					6=>0,
					7=>0,
					8=>1,
					9=>1,
					10=>1,
					11=>1,
					12=>1,
					13=>1,
					14=>2,
				),
				3=>array(
					1=>0,
					2=>0,
					3=>0,
					4=>0,
					5=>0,
					6=>0,
					7=>0,
					8=>0,
					9=>0,
					10=>1,
					11=>1,
					12=>1,
					13=>1,
					14=>1,
				),
				4=>array(
					1=>0,
					2=>0,
					3=>0,
					4=>0,
					5=>0,
					6=>0,
					7=>0,
					8=>0,
					9=>0,
					10=>0,
					11=>0,
					12=>1,
					13=>1,
					14=>1,
				),
			  ),
		),
	),
);
