<?php

class CartTemplate extends Template {

		// Component styles.
		private $css = array(
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/styles.css",
			)/*,
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/carCreateStyles.css"
			),
			array(
				"active" => true,
				"href" => "/content/libraries/view/loading.css"
			)*/
		);
		

		// Component scripts.
		private $core = array(
			
			//"/content/libraries/database/DBQuery.js",
			"/content/libraries/component/BaseComponent.js"//,
			//"/content/libraries/form/FormParser.js",
			//"/content/libraries/form/FormSubmission.js"
		);

		/*
		<script src="/modules/car/assets/js/InfiniteScroller.js"></script>
		<script src="/modules/car/assets/js/PageUI.js"></script>
		<script src="/modules/car/assets/js/module.js"></script>
		<!--<script src="/modules/car/assets/js/CreateCarUI.js"></script>
		<script src="/modules/car/assets/js/CarCreateModule.js"></script>-->
		*/
		private $module = array(
			//"InfiniteScroller.js", // maybe
			
			// all custom below here.
			//"PageUI.js",
			//"CreateCarUI.js",
			//"CarCreateModule.js",
			"module.js"
		);



		public function __construct($cart) {
			parent::__construct("Cart-Summary");
			
			$this->addStyles($this->css);

			$scripts = array();
			
			foreach($this->core as $name) {
				$scripts [] = array("src" => $name);			
			}
			foreach($this->module as $name) {
				$scripts [] = array("src" => "/modules/car/assets/js/".$name);			
			}
			
			
			$this->addScripts($scripts);
		}
}
?>