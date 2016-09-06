<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\Subject;

/* @var $this yii\web\Update */
/* @var $model app\models\Marks */
/* @var $form yii\widgets\ActiveForm */
?>

<!--main content start-->
<section id="main-content">
  	<section class="wrapper">
	  	<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header"><i class="fa fa-table"></i> Update Marks</h3>
				<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="#">Home</a></li>
					<li><i class="fa fa-table"></i>Marks</li>
					<li><i class="fa fa-table"></i>Update Marks</li>
				</ol>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">                             
					</header>
					<div class="panel-body">
						<?php $form = ActiveForm::begin([
							'options' => ['class' => 'form-horizontal'],
							'fieldConfig' => ['options' => ['tag'=>false ]]							
						]); ?>
								
						<div class="form-group">
							  <label class="col-sm-2 control-label">Student Name</label>
							  <div class="col-sm-10">									  
								<?php $items = ArrayHelper::map(Student::find()->all(), 'id', 'student_name'); ?>
								<?= $form->field($model, 'student_id')->dropDownList($items,['prompt' => 'Select Student','class' => 'form-control m-bot15','disabled' => 'disabled'])->label(false); ?>
								  <?= $form->field($model, 'student_id')->hiddenInput(['maxlength' => true,'class' => 'form-control'])->label(false); ?>
							  </div>							  
						 </div> 							
						<?php $mark = json_decode($model->mark);
						
						foreach ($mark as $key => $mark): ?>
							<div class="form-group">
							<?php $subject = Subject::find()->where(['subject_id' => $key])->all(); ?>
							  <label class="col-sm-2 control-label"><?php echo $subject[0]['subject_name'] ; ?></label>
							  <div class="col-sm-10">
								   <input value="<?php echo $mark; ?>" type="text" name="mark[<?php echo $key; ?>]" class="form-control"/>							   
							  </div>
							</div>
						<?php endforeach; ?>
						
						 <a href="<?php echo Yii::$app->homeUrl;?>mark" class="btn btn-primary">Back</a>
						 <?= Html::submitButton($model->isNewRecord ? 'Enter' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					  
						 <?php ActiveForm::end(); ?>
					</div>
				</section>
			</div>
		</div>	  
	</section>
</section>
<!--main content end-->
