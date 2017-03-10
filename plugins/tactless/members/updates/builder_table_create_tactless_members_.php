<?php namespace Tactless\Members\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTactlessMembers extends Migration
{
    public function up()
    {
        Schema::create('tactless_members_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job');
            $table->string('role')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tactless_members_');
    }
}
