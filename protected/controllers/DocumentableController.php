<?php

class DocumentableController extends Controller
{
	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionView()
	{
		// get the params documentable_type & id
		$model = new Documentable();
		$documentableType = $_GET['documentableType'];
		$documentableId = $_GET['documentableId'];
		$model->attributes = array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId);
		$this->layout = false;
		$this->render('_view', array('model'=>$model));
	}

	public function actionDelete()
	{
		$this->render('delete');
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