<?php



class CartTemplate extends Template {

		// Component styles.
		private $css = array(
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/styles.css",
			),
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/creditcard.css"
			),
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/menu.css"
			)
			
		);
		

		// Component scripts.
		private $core = array(
			"/content/libraries/component/BaseComponent.js"
		);

		private $module = array(			
			// all custom below here.
			"PageUI.js",
			"module.js",
			"menu.js",
			"OrderUI.js",
			"modal.js",
			"LineComponents.js",
			"creditCardTemplate.js"
		);



		public function __construct($cart) {
			parent::__construct("Cart-Summary");
			
			$this->addStyles($this->css);

			$scripts = array();
			
			foreach($this->core as $name) {
				$scripts [] = array("src" => $name);			
			}
			foreach($this->module as $name) {
				$scripts [] = array("src" => "/modules/square/assets/js/".$name);			
			}
			
			
			$this->addScripts($scripts);
		}
}
?>