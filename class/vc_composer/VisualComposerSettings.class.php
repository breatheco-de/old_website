<?php

require("component.autoload.php");

class VisualComposerSettings {

	private $excerciseClasses = array(
		"html" => 'html',
		"css" => 'css',
		"layouts" => 'layouts',
		"forms" => 'forms',
		"arrays" => 'arrays',
		"events" => 'events',
		"scaffolding" => 'scaffolding',
		"bootstrap" => 'bootstrap',
		"the-dom" => 'the-dom',
		"jquery-dom" => 'jquery-dom',
		"from-js-to-php" => 'from-js-to-php',
		"object-oriented-programing" => 'object-oriented-programing',
		"jquery-ajax" => 'jquery-ajax'
	);

	function __construct() {
		$codeHighliter = new VCComponent\VCCodeHighlighter();
		$codeREPL = new VCComponent\VCCodeREPL();
		$codePreview = new VCComponent\VCCodePreview();
		$codeClassroom = new VCComponent\VCReplitClassRoom();
		$codeReplitExercise = new VCComponent\VCReplitExercise($this->excerciseClasses);
		$codeRegexTester = new VCComponent\VCRegexTester();
		$codeSQLTester = new VCComponent\VCMySQLTester();
		
	}

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_coderepl extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_codepreview extends WPBakeryShortCode {}
    class WPBakeryShortCode_codehighliter extends WPBakeryShortCode {}
}
