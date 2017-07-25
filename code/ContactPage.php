<?php
class ContactPage extends Page {

	static $db = array(
		'HeadlineContactForm' => 'Varchar(255)',
		'ContactFormThankYou' => 'HTMLText',
		'Lat' => 'Varchar(255)',
		'Long' => 'Varchar(255)',
		'Zoom' => 'Int'
	);
	
	public static $has_one = array(
	);
	

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldsToTab('Root.Contactform', array(
			TextField::create('HeadlineContactForm', 'Headline contact form'),
			HTMLEditorField::create('ContactFormThankYou', 'Thank you text after user has sent the form.')
		));

		$fields->addFieldToTab('Root.Main', $mapField = GoogleMapField::create($this, 'Map'));

		return $fields;
	}
	
	public function Link() {
		return parent::Link();
	} 
	
	

}

class ContactPage_Controller extends Page_Controller {

	public static $allowed_actions = array( 
		'ContactForm',
		'doSubmit'
	);

	public function init() {
		parent::init();
	}

	public function ContactForm() {
		
		$form = new ContactForm($this, 'ContactForm');

		$form->disableSecurityToken();
		$form->clearMessage();

		return $form;
	}
	
}