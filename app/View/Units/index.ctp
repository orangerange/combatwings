<?php echo $this->Html->script( 'index', array( 'inline' => false ) ); ?>
<a href='/units/input'>ユニットを追加する</a>
<div>
  <h2>※ユニットの検索</h2>
  <button id="clear" type="button">クリア</button>
  <button id="artillery" type="button">爆撃機護衛機</button>
  <button id="rocket" type="button">ロケット戦闘機</button>
  <button id="modified" type="button">修正値機体</button>
  <?php echo $this->Form->create('Unit'); ?>
  <table>
	  <tr>
		  <th>
			  <h3>ユニット名</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('name', ['type' => 'text']); ?>
		  </td>
		  <th>
			  <h3>陣営</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('nationality', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Nationality'], 'empty' => '全て']); ?>
		  </td>
		  <th>
			  <h3>種別</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('type', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Type'], 'empty' => '全て']); ?>
		  </td>
		  <th>
			  <h3>対象年代</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('search_period', ['type' => 'select', 'options' => $configure['Master']['Period'], 'empty' => '全ての年代で検索']); ?>
		  </td>
		  <th>
			  <h3>シナリオ</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('senario', ['type' => 'select', 'options' => $configure['Master']['Senario'], 'empty' => '全て']); ?>
		  </td>
	  </tr>
  </table>
  <table>
	  <tr>
		  <th rowspan="6">
			  <h3>ソート</h3>
		  </th>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort1'], 'empty' => 'なし']); ?>
		  </td>
	  </tr>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort2'], 'hiddenField'=>false]); ?>
		  </td>
	  </tr>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort3'], 'hiddenField'=>false]); ?>
		  </td>
	  </tr>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort4'], 'hiddenField'=>false]); ?>
		  </td>
	  </tr>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort5'], 'hiddenField'=>false]); ?>
		  </td>
	  </tr>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('sort', ['type' => 'radio', 'options' => $configure['Master']['Unit']['Sort6'], 'hiddenField'=>false]); ?>
		  </td>
	  </tr>
  </table>
  <table>
	  <tr>
		  <td>
			  <?php echo $this->Form->input('limit', ['type' => 'select', 'options' => $configure['Master']['Unit']['Limit']]); ?>
			  <?php echo $this->Form->button('検索', ['type' => 'submit']); ?>
			  <a href='/units/index'>リセット</a>
		  </td>
	  </tr>
  </table>	
</div>
<?php echo $this->Form->input('submit_type', ['type' => 'hidden','value'=>'search']); ?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Form->create('Unit'); ?>
<h3>ユニット一覧　<?php echo $this->Paginator->counter(array('format' => __('総件数  {:count}件')));?></h3>
<h3>※期間について　a: ～1943年10月　b: 1943年11月～1944年1月　c: 1944年2月～　</h3>
  <p>
  <?php
	  echo $this->Paginator->prev('前へ' . __(''), array(), null, array('class' => 'prev disabled'));
	?>
	<?php echo $this->Paginator->numbers(); ?>
	<?php
	  echo $this->Paginator->next(__('') . ' 次へ', array(), null, array('class' => 'next disabled'));
	?>
	<?php
	  echo $this->Paginator->counter(array(
		  'format' => __('{:page}/{:pages}ページを表示')
	  ));
	?>
	<?php echo $this->Form->input('submit_type', ['type' => 'hidden','value'=>'calculate']); ?>
	<?php echo $this->Form->input('calculate_flg', ['type' => 'hidden','id'=>'calculate_flg','value'=>$calculateFlg]); ?>
	<?php echo $this->Form->input('period', ['type' => 'select', 'options' => $configure['Master']['Period']]); ?>
	サイの和<?php echo $this->Form->input('dice_sum', ['type' => 'number','style'=>'width:50px;']); ?>
	<?php echo $this->Form->input('calculate_type', ['type' => 'select', 'options' => $configure['Master']['Calculate']['Type']]); ?>
	<?php echo $this->Form->input('attacker', ['type' => 'select', 'options' => $configure['Master']['Calculate']['Attacker']]); ?>
	<?php echo $this->Form->input('ss_target', ['type' => 'select', 'options' => $configure['Master']['Calculate']['SSTarget']]); ?>
	<?php echo $this->Form->button('計算', ['type' => 'submit',]); ?>
  </p>
<div class="list">
<table>
    <thead>
	<tr>
		<th rowspan="2">
	    </th>
		<th rowspan="2">
			画像
	    </th>
	    <th rowspan="2">
			機種名
	    </th>
	    <th rowspan="2">
			陣営
	    </th>
	    <th rowspan="2">
			種別
	    </th>
	    <th rowspan="2">
			期間
	    </th>
	    <th colspan="2">
			速度
	    </th>
	    <th rowspan="2">
			航続力
	    </th>
	    <th rowspan="2">
			航続力</br>(増槽なし)
	    </th>
	    <th colspan="2">
			空戦能力
	    </th>
		 <th rowspan="2">
	    </th>
	</tr>
	<tr>
		<th>
			(戦闘)
		</th>
		<th>
			(巡航)
		</th>
		<th>
			F
		</th>
		<th>
			B
		</th>
	</tr>
    </thead>
    <tbody>
      <?php foreach($units as $_unit) :?>
		<tr>
			<td rowspan="3">
			  <dt>
				  <?php
					echo $this->Form->input('Unit.selected_units.' . $_unit['Unit']['id'], array(
					  'type' => 'number',
					  'style'=>'width:50px;',
				  ));
				  ?>
			  </dt>
			</td>
			<td rowspan="3">
				<dt><a href="javascript:w=window.open('<?php echo $_unit['Unit']['url']; ?>','','scrollbars=yes,toolbar=yes,Width=1400,Height=600');w.focus();"><img src="/img/picture/<?php echo $_unit['Unit']['id']; ?>/<?php echo $_unit['Unit']['picture_name']; ?>" alt="画像なし"></a></dt>
			</td>
			<td rowspan="3">
				<?php echo h($_unit['Unit']['name']) ;?>
			</td>
			<td rowspan="3">
				<?php
				$nationality = $_unit['Unit']['nationality'];
				echo Configure::read("Master.Unit.Nationality.$nationality"); 
				?>
			</td>
			<td rowspan="3">
				<?php
				$type = $_unit['Unit']['type'];
				echo Configure::read("Master.Unit.Type.$type");
				?>
			</td>
			<td>
				a
			</td> 
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['fighting_speed_1']) ? h($_unit['Unit']['fighting_speed_1']) : '-';?>
			  </td>
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['crusing_speed_1']) ? h($_unit['Unit']['crusing_speed_1']) : '-';?>
			  </td>
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['crusing_range_1']) ? h($_unit['Unit']['crusing_range_1']) : '-';?>
			  </td>
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['crusing_range_notank_1']) ? h($_unit['Unit']['crusing_range_notank_1']) : '-';?>
			  </td>
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['unti_fighter_1']) ? h($_unit['Unit']['unti_fighter_1']) : '-';?>
			  </td>
			  <td <?php if (empty($_unit['Unit']['fighting_speed_1'])) :?> class="grayout"<?php endif; ?>>
				  <?php echo !empty($_unit['Unit']['unti_bomber_1']) ? h($_unit['Unit']['unti_bomber_1']) : '-';?>
			  </td>
			</div>
			<td rowspan="3">
				<a href="/units/edit/<?php echo $_unit['Unit']['id'] ;?>">編集</a>
			</td>
		</tr>
		<tr>
			<td>
				b
			</td>
			<div>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['fighting_speed_2']) ? h($_unit['Unit']['fighting_speed_2']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_speed_2']) ? h($_unit['Unit']['crusing_speed_2']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_range_2']) ? h($_unit['Unit']['crusing_range_2']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_range_notank_2']) ? h($_unit['Unit']['crusing_range_notank_2']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['unti_fighter_2']) ? h($_unit['Unit']['unti_fighter_2']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_2'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['unti_bomber_2']) ? h($_unit['Unit']['unti_bomber_2']) : '-';?>
			</td>
			
		</tr>
		<tr>
			<td>
				c
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['fighting_speed_3']) ? h($_unit['Unit']['fighting_speed_3']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_speed_3']) ? h($_unit['Unit']['crusing_speed_3']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_range_3']) ? h($_unit['Unit']['crusing_range_3']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['crusing_range_notank_3']) ? h($_unit['Unit']['crusing_range_notank_3']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['unti_fighter_3']) ? h($_unit['Unit']['unti_fighter_3']) : '-';?>
			</td>
			<td <?php if (empty($_unit['Unit']['fighting_speed_3'])) :?> class="grayout"<?php endif; ?>>
				<?php echo !empty($_unit['Unit']['unti_bomber_3']) ? h($_unit['Unit']['unti_bomber_3']) : '-';?>
			</td>
		</tr>
	  <?php endforeach ;?>
    </tbody>
</table>
<?php echo $this->Form->end(); ?>
</div>