<?php

class OptionsController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPermissions()
	{
    $model = Options::model()->find( 'name="field-permissions"' );
    if($model==null):
      $model = new Options();
    endif;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Option']))
		{
      $attributes = $_POST['Option'];
      $attributes['name'] = 'field-permissions';
			$model->attributes = $attributes;
			$model->save();
		}
    

		$this->render('permissions',array(
			'model'=>$model,
		));

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}