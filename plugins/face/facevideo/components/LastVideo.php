<?php namespace Face\FaceVideo\Components;

use Cms\Classes\ComponentBase;
use Face\FaceVideo\Models\Facevideo;


class LastVideo extends ComponentBase
{

	public $lastVideos;

	public function componentDetails(){
		return [
		'name'=>'Last video',
		'description'=>'get last video'


		];
	}
	public function defineProperties(){

		

	
	}

	public function onRun(){

		$this->lastVideos = $this->loadLastVideo();
	}



	protected function loadLastVideo(){



	}

}