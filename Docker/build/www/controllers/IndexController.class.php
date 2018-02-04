<?php


class IndexController{

	public function indexAction($params){
		
		$name = "Yves";




		$v = new View("default","front");
		$v->assign("name", $name);
		

	}


	

}