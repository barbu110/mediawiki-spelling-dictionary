<?php

class SpecialViewByLanguage extends SpecialPage {

	public function __construct() {
		parent::__construct( 'ViewByLanguage' );
	}

	public function execute( $sub ) {
		$out = $this->getOutput();
		$out->setPageTitle( $this->msg( 'title-view-by-language' ) );
		$out->addWikiMsg( 'view-by-lang-intro' );
		$formDescriptor = array(
			'language' => array(
				'type' => 'select',
				'label-message' => 'sd-admin-select-language',
				'required' => true,
				'options' => array(
					'English' => 'en',
					'French' => 'fr',
					'Hindi' => 'hi'
				),
			)
			);
		$form = HTMLForm::factory( 'vform', $formDescriptor, $this->getContext(), 'add-word' );
		$form->setSubmitText( wfMessage( 'sd-admin-view-selected-language' )->text() );
		//Callback function
		$form->setSubmitCallback( array( 'SpecialSpellingDictionaryViewByLanguage', 'show' ) );

		$form->show();
	}

	static function show( $formData ) {
		$out->addHTML ( AdminRights::displayByLanguage( $formData ) );
	}
}
