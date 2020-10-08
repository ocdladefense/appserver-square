<?php



class OrderTemplate extends Template {

		// Component styles.
		private $css = array(
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/creditcard.css",
			),
			array(
				"active" => true,
				"href" => "/modules/square/assets/css/sq-payment-form.css"
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
			"sq-payment-form"
		);



		public function __construct($orderNumb) {
			parent::__construct("Order-Summary/".$orderNumb);
			
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