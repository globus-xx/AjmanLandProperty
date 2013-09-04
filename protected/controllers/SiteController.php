<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        $model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('index.php/site/page?view=about');
		}
		// display the login form
		$this->render('index',array('model'=>$model));

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        
        public function actionProfile($id,$mess="")
	{                               
		$userdata = Users::model()->findAllByAttributes(array("id"=>$id));   
                $userprofile = Profiles::model()->findAllByAttributes(array("user_id"=>$id)); 
		$this->render('/user/edit-user-profile',array('userdata'=>$userdata,'mess'=>$mess,'userprofile'=>$userprofile));                
	}
        
       public function actionsendEmail()
        {
           $this->load->library('email');

                        $config['protocol']='sendmail';
                        $config['charset']='utf-8';
//                        $config['smtp_host']='mail.eim.ae';
//                        $config['smtp_port']='25';
                        $config['mailtype'] = 'html';

                        
                        $this->email->initialize($config);
                        
                                                                                                
                        $this->email->from("it@ajmanland.gov.ae", "emazoo");
                        $this->email->to("emady87@yahoo.com"); 
                        

                        $this->email->subject('Email Test');
                        $this->email->message('<b>Testing the email .</b>');	

                        
                        if(!$this->email->send())
                        echo $this->email->print_debugger();    
        }
        
        
        public function actionupdateUser()
        {                          
                $id=$_POST['id'];
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                
                
                $userdata = Users::model()->findAllByAttributes(array("id"=>$id)); 
                
                
                foreach($userdata as $row)                
                    {
                    $dbpassword=$row->password;                    
                }
                
                
                if($_POST['userpassword']!=$dbpassword)
                {
                $userpass=md5($_POST['userpassword']);
                }
                else
                    $userpass=$_POST['userpassword'];
                
                
                $useremail=$_POST['useremail'];
                
            
                                       
            
                $post=Users::model()->findByPk($id);                
                $post->password=$userpass;      
                $post->email=$useremail;  
                $post->save(); // save the change to database
                
                
                $post= Profiles::model()->findByPk($id);                
                $post->lastname=$lname;      
                $post->firstname=$fname;  
                $post->save(); // save the change to database
                
                $mess=" تم تعديل المعلومات بنجاح !!!";
                
                //$this->actionProfile($id,$mess);
		$userdata = Users::model()->findAllByAttributes(array("id"=>$id));     
                $userprofile = Profiles::model()->findAllByAttributes(array("user_id"=>$id)); 
                 
                
                        
                                         
		$this->render('/user/edit-user-profile',array('userdata'=>$userdata,'mess'=>$mess,'userprofile'=>$userprofile));  
                
        }
        
        
        
        
        
        
}
