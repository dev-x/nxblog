<?php

$this->title = 'Блоги';
?>

	
<div style="margin-top:-50px;background-color:#fefeff; box-shadow:
   0 1px 3px rgba(0, 0, 0, .3),
   -13px 0 10px -13px rgba(0, 0, 0, .8),
   13px 0 10px -13px rgba(0, 0, 0, .8),
   0 0 30px rgba(0, 0, 0, .1) inset;" class="row wrap">	
   <h1 style="text-align:center;font-size:50px; color: black;"><font>Posts</font></h1>
	<div class="col-sm-9">
		<?php echo $this->render('/site/_posts', array('data' =>$data,'pagination'=>$pagination)); ?>
	</div>
	<div class="col-sm-3">
		<?php echo $this->render('/user/_sidebar', array('postSidebar' =>$postSidebar)); ?>
	</div>
</div>