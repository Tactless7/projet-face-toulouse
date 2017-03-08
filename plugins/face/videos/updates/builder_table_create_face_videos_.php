<?php namespace face\Videos\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFaceVideos extends Migration
{
    public function up()
    {
        Schema::create('face_videos_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('face_videos_');
    }
}
