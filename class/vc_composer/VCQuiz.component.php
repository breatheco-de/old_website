<?php

namespace VCComponent;

class VCQuiz{
    
    const BASE_NAME = 'vcquiz';
    private $quizzes = array();
    
    function __construct(){
        
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
        $this->getQuizzesOptions();
        //die(print_r($this->quizzes));
	    array_unshift($this->quizzes,array("#"=>'Select a quiz'));

	   vc_map( array(
	      "name" => __( "Quiz", "breathecode" ),
	      "base" => self::BASE_NAME,
	      "category" => __( "BreatheCode", "breathecode"),
	      "params" => array(
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Quiz Box Heigh", "breathecode" ),
		            "param_name" => "quizheight",
		            "value" => __( "300", "breathecode" ),
		            "description" => __( "The height of the quiz box", "breathecode" )
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => "Quiz Slug",
		            "param_name" => "quizeslug",
		            "value" => $this->quizzes,
		            "description" => __( "You have to pick one from the quiz list", "breathecode" )
		         )
	        )
	   ) );
    }
    
	function render( $atts , $content = null) 
	{
	    extract( shortcode_atts( array(
	      'quizheight' => '300',
	      'quizeslug' => 'a'
	   ), $atts ) );
	   
	   $srcURL = ASSETS_URL.'quiz/app?slug='.$quizeslug;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$quizheight.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}
	
	function getQuizzesOptions(){
	   $quizzesJSON = @file_get_contents(ASSETS_URL.'quiz/quizzes.php');
	   if($quizzesJSON)
	   {
	       $quizzes = json_decode($quizzesJSON);
	       $this->quizzes = array();
	       foreach($quizzes as $q)
	       {
	           $this->quizzes[$q->info->name.' ('.$q->info->slug.')'] = $q->info->slug;
	       }
	   }
	}
}