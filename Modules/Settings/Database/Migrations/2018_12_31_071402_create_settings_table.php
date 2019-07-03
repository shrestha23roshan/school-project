<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->nullable()->default(null);
            $table->string('site_email')->nullable()->default(null);
            $table->string('site_phone')->nullable()->default(null);
            $table->string('site_address')->nullable()->default(null);
            $table->string('site_description')->nullable()->default(null);
            $table->string('site_logo')->nullable()->default(null);
            $table->string('site_favicon')->nullable()->default(null);
            $table->string('site_copyright')->nullable()->default(null);
            $table->string('facebook_url')->nullable()->default(null);
            $table->string('linkedin_url')->nullable()->default(null);
            $table->string('twitter_url')->nullable()->default(null);
            $table->string('google_plus_url')->nullable()->default(null);
            $table->string('youtube_url')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
