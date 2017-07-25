<?php

class ContactForm extends BootstrapAjaxForm {
	
	function __construct($controller, $name) {
	
		$fields = new FieldList(
			TextField::create("Name")->addExtraClass('span2')->setTitle(_t("ContactForm.NAME", "Nombre")),
			EmailField::create("Email")->addExtraClass('span2')->setTitle(_t("ContactForm.EMAIL", "Email")),
			TextareaField::create("Message")->addExtraClass('span4')->setTitle(_t("ContactForm.MESSAGE", "Mensaje")),
			HiddenField::create('SecurityID')->setValue(Session::get('SecurityID'))
		);
			
		$actions = new FieldList(FormAction::create("doSubmit")->setTitle(_t("ContactForm.SEND", "Enviar"))->addExtraClass('btn') );
		$validator = new RequiredFields(array('Name','Email','Message'));
		parent::__construct($controller, $name, $fields, $actions, $validator);
			
	} 
	
	public function doSubmit($data, $form) {

	
		
	if ($this->sendEnquiryMail($data, $form)) {
		
	 	$ajaxData = array(
	 		'valid' => true,
	 		'html' => '<div class="alert">'.PartnerPage::get()->First()->ContactFormThankYou.'</div>'
	 	);
		
	} else {
		// Couldnt write
	 	$ajaxData = array(
	 		'valid' => true,
	 		'html' => '<div class="alert alert-danger">Ups!</div>'
	 	);
	}

 	$response = new SS_HTTPResponse(json_encode($ajaxData));
 	$response->addHeader("Content-type", "application/json");
 	return $response;


	}
	
	
	
	function sendEnquiryMail($data, $form) { 

		$From = $data['Email'];
		$To = 'name@domain.com';
		$Subject = "Contact Form [Domain.com]";
		$email = new Email($From, $To, $Subject, '', '', '', 'webmaster@domain.com');
		$email->setTemplate('ContactEmail');
		$email->populateTemplate($data);
		if ( $email->send() ) {
			return true;
		} else {
			return false;
		}

	}

	function forTemplate(){ 
		
		$this->applyBootstrap();
		// Important für Ajax forms!
		$this->setupFormErrors();
		
		$return = $this->renderWith('ContactForm');
		//Now that we're rendered, clear message
		$this->clearMessage();
		
		return $return;
	}
}