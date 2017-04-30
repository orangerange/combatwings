<?php echo $this->Html->script( 'input', array( 'inline' => false ) ); ?>
<h1>ユニット<?php if(isset($editFlg) && $editFlg): ?>編集<?php else : ?>登録<?php endif; ?></h1>
<?php echo $this->Form->create('Unit', ['type'=>'file', 'novalidate'=>true]); ?>
  
<?php echo $this->Session->flash(); ?>
<?php if(isset($newId)): ?><a href="/units/edit/<?php echo $newId ;?>" target=”_blank”>登録したユニットを編集</a><?php endif; ?>
<table>
    <tr>
	<th>
	    機種名
	</th>
	<td>
	    <?php echo $this->Form->input('name', ['type'=>'text']); ?>
	</td>
    </tr>
    <tr>
	<th>
	    陣営
	</th>
	<td>
	    <?php echo $this->Form->input('nationality', ['type'=>'radio', 'options'=>$configure['Master']['Unit']['Nationality']]); ?>
	</td>
    </tr>
    <tr>
	<th>
	    種別
	</th>
	<td>
	    <?php echo $this->Form->input('type', ['type'=>'radio', 'options'=>$configure['Master']['Unit']['Type']]); ?>
	</td>
    </tr>
    <tr>
	<th>
	    参考画像
	</th>
	<td>
		<?php if(isset($editFlg) && $editFlg): ?>
		<p><img src="/img/picture/<?php echo $this->request->data['Unit']['id']; ?>/<?php echo $this->request->data['Unit']['picture_name']; ?>" alt="画像なし"></p>
		<?php endif; ?>
	    <?php echo $this->Form->input('picture', ['type'=>'file']); ?>
	</td>
    </tr>
    <tr>
	<th>
	    参考url
	</th>
	<td>
		<?php if(isset($editFlg) && $editFlg): ?>
		  <p><a href="<?php echo $this->request->data['Unit']['url']; ?>" target="_blank"><?php echo $this->request->data['Unit']['url']; ?></a></p>
		<?php endif; ?>
	    <?php echo $this->Form->input('url', ['type'=>'text', 'style'=>'width:600px;']); ?>
	</td>
    </tr>
  </table>
    <tr>
      <th>
	<h2 Align='Center'>※期間別スペック</h2>
  
<?php for($i=1; $i<=3; $i++): ?>
<table style='float:left;'>
    <tr>
	<th>
	    <h2>期間<?php echo $configure['Master']['Period'][$i]; ?><?php if ($i==1) : ?><button id='copy_<?php echo $i; ?>' type='button'>全年代にコピー</button><?php elseif($i==2) : ?><button id='copy_2_1' type='button'>aにコピー</button>　<button id='copy_2_3' type='button'>cにコピー</button><?php endif; ?></h2> 
		<tr>
		  <th>
			※この期間は存在しない
		  </th>
		  <td>
			<?php echo $this->Form->checkbox('none_' . $i) ;?>
		  </td>
		</tr>
		    </th>
		    </tr>
		    <tr>
			<th>
			    戦闘速度
			</th>
			<td>
	    <?php echo $this->Form->input('Unitspec.' . $i. '.fighting_speed'); ?>
			</td>
		    </tr>
		    <tr>
			<th>
			    巡航速度
			</th>
			<td>
	    <?php echo $this->Form->input('Unitspec.' . $i. '.crusing_speed'); ?>
			</td>
		    </tr>
		    <tr>
			<th>
			    航続力
			</th>
			<td>
	    <?php echo $this->Form->input('Unitspec.' . $i. '.crusing_range'); ?>
			</td>
		    </tr>
		    <tr>
			  <th>
				  航続力(増槽なし)
			  </th>
			  <td>
		  <?php echo $this->Form->input('Unitspec.' . $i. '.crusing_range_notank'); ?>
			  </td>
		    </tr>
		    <tr>
			<th>
			    戦闘力(対戦闘機)
			</th>
			<td>
	    <?php echo $this->Form->input('Unitspec.' . $i. '.unti_fighter'); ?>
			</td>
		    </tr>
		    <tr>
			<th>
			    戦闘力(対爆撃機)
			</th>
			<td>
	    <?php echo $this->Form->input('Unitspec.' . $i. '.unti_bomber'); ?>
			</td>
		    </tr>
</table>
<?php endfor; ?>
<table  style='clear:left; '>
		    <tr>
			<td>
			 <a href='/units/index'>一覧へ戻る</a>
			  <?php echo $this->Form->button('登録', ['type' => 'submit', 'onclick'=>'return check();']); ?>
			</td>
		    </tr>
		    </table>

<?php echo $this->Form->end(); ?>