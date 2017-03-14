<?php namespace Face\FaceVideo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFaceFacevideo extends Migration
{
	public function up() {
		Schema::create('face_facevideo_', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id'); 
			$table->string('title'); 
			$table->text('description')->nullable();
			$table->string('link');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable(); 
		});
	}
	public function down() { Schema::dropIfExists('face_facevideo_');

}
}
