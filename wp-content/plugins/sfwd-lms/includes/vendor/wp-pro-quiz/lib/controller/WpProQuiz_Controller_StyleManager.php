<?php
class WpProQuiz_Controller_StyleManager extends WpProQuiz_Controller_Controller {
	
	public function route() {
		$this->show();
	}
	
	private function show() {
		global $learndash_assets_loaded;
		
		//wp_enqueue_style(
		//	'wpProQuiz_front_style', 
		//	plugins_url('css/wpProQuiz_front'. ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min') .'.css', WPPROQUIZ_FILE),
		//	array(),
		//	LEARNDASH_SCRIPT_VERSION_TOKEN
		//);
		//$learndash_assets_loaded['styles']['wpProQuiz_front_style'] = __FUNCTION__;
		
		$filepath = SFWD_LMS::get_template( 'learndash_quiz_front.css', null, null, true );
		if ( !empty( $filepath ) ) {
			wp_enqueue_style( 'learndash_quiz_front_css', learndash_template_url_from_path( $filepath ), array(), LEARNDASH_SCRIPT_VERSION_TOKEN );
			$learndash_assets_loaded['styles']['learndash_quiz_front_css'] = __FUNCTION__;
		} 
		
		
		$view = new WpProQuiz_View_StyleManager();
		
		$view->show();
	}
}