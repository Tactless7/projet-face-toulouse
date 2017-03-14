<?php namespace Face\FaceVideo;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
	public function registerComponents()
	{
		return
		[

		'Face\FaceVideo\Components\LastVideo'=>'lastVideo'

		];
	}

	public function registerSettings()
	{

	}
}
