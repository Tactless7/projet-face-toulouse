<?php namespace Mooncode\Blog\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('mooncode_blog_posts');
        DbDongle::convertTimestamps('mooncode_blog_categories');
    }

    public function down()
    {
        // ...
    }
}
