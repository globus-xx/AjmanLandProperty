<?php

class ReportGeneratorController extends Controller
{
	public function actionList()
	{
		$this->render('List');
	}

	public function actionCreateForContract()
	{
		$this->render('createForContract');
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionUpdateForContract()
	{
		$this->render('updateForContract');
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