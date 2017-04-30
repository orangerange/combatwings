<!DOCTYPE html>
<html lang="ja">
    <head>
	<meta http-equiv="Content-Script-Type" content="text/javascript">
<?php echo $this->Html->charset(); ?>
<?php echo $this->Html->meta('icon');?>
<?php echo $this->fetch('meta');?>
<?php echo $this->Html->css('base-style.css'); ?>
<?php echo $this->fetch('css');?>
<?php echo $this -> Html -> script('jquery-3.1.1.min'); ?>
<?php echo $this->fetch('script');?>
    </head>
    <body>
		<div id="contents">
	<?php echo $this->fetch('content'); ?>
		</div>
	</body>
</html>
