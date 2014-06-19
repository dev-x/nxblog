<?php

$this->title = 'Блоги';
?>
<div style="background-color:#fefeff;" class="row wrap">	
	<div class="col-sm-9">
		<div style="background-color:#00A87B; border-radius:2%;" class="col-sm-12"><h1 style="text-align:center;font-size:50px;color:white;">Пости</h1></div>
		<?php echo $this->render('/site/_posts', array('data' =>$data,'pagination'=>$pagination)); ?>
	</div>
	<div class="col-sm-3">
		<?php echo $this->render('/user/_sidebar', array('postSidebar' =>$postSidebar)); ?>
	</div>
</div>