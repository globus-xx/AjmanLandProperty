<?php

class DocumentableController extends Controller
{
	public function actionCreate()
	{
		$model = new Documentable();
		$attributes = $_POST['Documentable'];
		$model->attributes = $attributes;
		$model->save();
		$this->layout = false;
		$documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
		$model = new Documentable();
		$model->attributes = array(	'documentable_type'=>$documentableType, 
																'documentable_id'=>$documentableId);
		$documentables = Documentable::model()->with('document')->findAllByAttributes(array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId));

		$this->render('_view', array('model'=>$model, 'documentables'=>$documentables));

		//$this->render('create');
	}

	public function actionView()
	{
		// get the params documentable_type & id
		$model = new Documentable();
		$documentableType = $_GET['documentableType'];
		$documentableId = $_GET['documentableId'];
                
		$documentables = Documentable::model()->with('document')->findAllByAttributes(array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId));
		$model->attributes = array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId);
		$this->layout = false;
                
		$this->render('_view', array('model'=>$model, 'documentables'=>$documentables));
                
	}

	public function actionDelete()
	{
		Documentable::model()->deleteByPk($_POST['id']);
		$this->layout = false;
		echo true;
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