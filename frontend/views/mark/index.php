<?php
use app\models\Subject;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */
/* @var $form yii\widgets\ActiveForm */
?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">            
		<!--overview start-->
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header"><i class="fa fa-table"></i> Marks</h3>
				<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="#">Home</a></li>
					<li><i class="fa fa-table"></i>Marks</li>												  	
				</ol>					
			</div>
		</div>
		
		<?php if(Yii::$app->session->getFlash('success')): ?>
			<div class="alert alert-success fade in">
			  <button data-dismiss="alert" class="close close-sm" type="button">
				<i class="fa fa-times"></i>
			  </button>
			  <strong>Success!</strong> <?php echo Yii::$app->session->getFlash('success'); ?>
			</div>
		<?php endif; ?>
		
		<div class="row">
			<div class="col-lg-12">
				<a style="margin-bottom: 15px;" class="btn btn-primary pull-right" href="<?php echo yii::$app->homeUrl; ?>mark/create" title="Enter Marks">Enter Marks</a>
			</div>
		</div>
		<div class="row">				
			<div class="col-lg-12">
				<section class="panel">
					<div class="table-responsive">
						<table class="table" id="example">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Student Name</th>
							  <?php $subject = Subject::find()->all();								 
							  foreach($subject as $subject): ?>
										<th><?php echo $subject['subject_name']; ?></th>
							  <?php endforeach; ?>
							  <th>Action</th>								  
							</tr>
						  </thead>
						  <tbody>
							<?php $i = 1;
							foreach($model as $row): ?>
							<tr>
							  <td><?php echo $i; ?></td>
							  <?php $student = Student::find()->where(['id' => $row['student_id']])->all();?>								  
							  <td><?php echo $student[0]['student_name']; ?></td>
							  <?php $mark = json_decode($row['mark']);
							  foreach ($mark as $mark): ?>								  
							  <td><?php echo $mark; ?></td>
							  <?php endforeach; ?>
							  <td>
								<a href="<?php echo yii::$app->homeUrl; ?>mark/view/<?php echo $row['id']; ?>" title="View">
									<span class="fa fa-eye"></span>
								</a> 
								<a href="<?php echo yii::$app->homeUrl; ?>mark/update/<?php echo $row['id']; ?>" title="Update">
									<span class="fa fa-edit"></span>
								</a> 
								<a href="<?php echo yii::$app->homeUrl; ?>mark/delete/<?php echo $row['id']; ?>" title="Delete" 
								onclick='return confirm("Are you sure you want to delete this item?")' data-method="post">
									<span class="fa fa-trash-o"></span>
								</a>
							    </td>								  
							</tr>
							<?php $i++; endforeach; ?>
						  </tbody>
						</table>
					</div>
				</section>
			</div>
		</div>
  	</section>
</section>
