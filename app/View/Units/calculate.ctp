<?php if($calculate['Type'] == Configure::read('Master.Calculate.TypeKey.Fight')) :?>
<div class="list">
<table>
	<thead>
		<tr>
			<th>
			</th>
			<th>
			  連合<?php if($calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.US')) :?>(攻撃)<?php else :?>(防御)<?php endif ;?>
			</th>
			<th>
			  枢軸<?php if($calculate['Attacker'] == Configure::read('Master.Calculate.AttackerKey.SS')) :?>(攻撃)<?php else :?>(防御)<?php endif ;?><?php if($calculate['SSTarget'] == Configure::read('Master.Calculate.SSTargetKey.Fighter')) :?>(対戦闘機)<?php else :?>(対爆撃機)<?php endif ;?>
			</th>
		</tr>
		<tr>
			<th>
			  参加戦力
			</th>
			<td>
				<?php foreach($usUnits as $_unit) :?>
				  <?php echo $_unit['Unit']['name'];?>(<?php echo Configure::read('Master.Unit.Type.' . $_unit['Unit']['type']);?>)×<?php echo $_unit['Unit']['num'];?></br>
				  空戦能力<?php echo $_unit['Unit']['one_power'];?>×<?php echo $_unit['Unit']['num'];?>=<?php echo $_unit['Unit']['power'];?></br>
				<?php endforeach ;?>
			</td>
			<td>
				<?php foreach($ssUnits as $_unit) :?>
				  <?php echo $_unit['Unit']['name'];?>(<?php echo Configure::read('Master.Unit.Type.' . $_unit['Unit']['type']);?>)×<?php echo $_unit['Unit']['num'];?></br>
				  空戦能力<?php echo $_unit['Unit']['one_power'];?>×<?php echo $_unit['Unit']['num'];?>=<?php echo $_unit['Unit']['power'];?></br>
				<?php endforeach ;?>
			</td>
		</tr>
		<tr>
			<th>
			  空戦能力合計
			</th>
			<td>
				<?php echo $usPowerSum;?>
			</td>
			<td>
				<?php echo $ssPowerSum;?>
			</td>
		</tr>
		<tr>
			<th>
			  戦力比
			</th>
			<td>
				<?php echo $usRatio;?>
			</td>
			<td>
				<?php echo $ssRatio;?>
			</td>
		</tr>
		<tr>
			<th>
			  損害ポイント
			</th>
			<td>
				<?php echo $usDamage;?>
			</td>
			<td>
				<?php echo $ssDamage;?>
			</td>
		</tr>
	</thead>
</table>
<div class="list">
<?php endif ;?>