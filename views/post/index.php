<?php

$this->title = 'Блоги';
?>
<div id="">
	<?php echo $this->render('/site/_posts', array('data' =>$data,'pagination'=>$pagination)); ?>
</div>
