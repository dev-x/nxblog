<?php
	use yii\helpers\Html;
?>

<script type="text/javascript">
	/*	var visible = true;
	function showFun() {
		if(visible) {
			document.getElementById('infoTwo' ).style.display = 'none';
			document.getElementById('disp' ).firstChild.nodeValue = "Відкрити";
			visible = false;
		} else {
			document.getElementById('infoTwo' ).style.display = 'block';
			document.getElementById('disp' ).firstChild.nodeValue = "Закрити";
			visible = true;
		}
	}
*/
</script>
<style>
	#infoTwo{
		display:none;
	}
</style>
<div class="profil">
<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>

	<div id="osnovna">
		<div class="page-header clearfix">
			<div style="width:93%;float:left;font-color:green;" class="col-sm-11"><p style="font-size:18px;"><?php echo HTML::a('Основна інформація ');?></p></div>
			<div style="width:5%;float:left;" class="col-sm-1">
				<?php
					if (Yii::$app->user->id === $modelUser->id){
						echo HTML::a('Update ',array('edit','id'=>$modelUser->id));
                        //HTML::url('site/addvk')
                        //
                        //\Yii::$app->getUrlManager()->createUrl();
                        echo HTML::a('Add VK',
                            'http://oauth.vk.com/authorize?client_id=4190651&redirect_uri='.\Yii::$app->getUrlManager()->createAbsoluteUrl('site/addvk').'&scope=offline&display=page&response_type=code');
                    }
					?>
			</div>
		</div>
			<div style="margin-left:20px;">
			<table>
				<tr>
					<td>Ім'я: </td><td><strong><?= $modelUser->first_name; ?></strong></td>
				</tr>	
				<tr>	
					<td>Прізвище: </td><td><strong><?= $modelUser->last_name; ?></strong></td>
				</tr>
				<tr>
					<td><?php if($modelUser->mobil != 0){ echo "Мобільний:</td><td><strong>".$modelUser->mobil.""; }else{}; ?></strong></td>
				</tr>		
				<tr>		
					<td><?php if($modelUser->email != null){ echo "email:</td><td><strong>".$modelUser->email.""; } ?></strong></td>
				</tr>
			</table>
		</div>
	</div>
	<?php if(($modelUser->city && $modelUser->vnz && $modelUser->groupVnz && $modelUser->skype && $modelUser->myCredo && $modelUser->myInfo != null ) && ($modelUser->birthday != 0000-00-00)){ ?>
	<div id="drygor">
	<div class="page-header clearfix">
	
			<div style="width:93%;float:left;font-color:green;" class="col-sm-11"><p style="font-size:18px;"><?php echo HTML::a('Інша інформація ');?></p></div>
			<div style="width:5%;float:left;" class="col-sm-1">
				<a type="submit"><p id="disp">Відкрити</p></a>
			</div>
	</div>
	<div id="infoTwo" style="margin-left:20px;">
		<?php if($modelUser->city != null){ echo "Місто:<strong>".$modelUser->city."</br>"; } ?></strong>
		<?php if($modelUser->vnz != null){ echo "ВНЗ:<strong>".$modelUser->vnz."</br>"; } ?></strong>
		<?php if($modelUser->groupVnz != null){ echo "Група:<strong>".$modelUser->groupVnz."</br>"; } ?></strong>
		<?php if($modelUser->birthday != 0000-00-00){ echo "Дата народження:<strong>".$modelUser->birthday."</br>"; } ?></strong>
		<?php if($modelUser->skype != null){ echo "Skype:<strong>".$modelUser->skype."</br>"; } ?></strong>
		<?php if($modelUser->myCredo != null){ echo "Кредо:<strong>".$modelUser->myCredo."</br>"; } ?></strong>
		<?php if($modelUser->myInfo != null){ echo "Інформація про мене:<strong>".$modelUser->myInfo."</br>"; } ?></strong>
	</div>
	</div>
	<?php } ?>
</div>
<div class="avatar">
	<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
</div>