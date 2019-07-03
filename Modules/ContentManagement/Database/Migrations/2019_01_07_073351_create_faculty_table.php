<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable()->default(null);
            $table->string('designation')->nullable()->default(null);
            $table->string('department')->nullable()->default(null);
            $table->string('qualification')->nullable()->default(null);
            $table->string('area_of_interest')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('facebook_url')->nullable()->default(null);
            $table->string('twitter_url')->nullable()->default(null);
            $table->string('linkned_url')->nullable()->default(null);
            $table->string('contact_number')->nullable()->default(null);
            $table->string('attachment')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->enum('is_active', [0,1])->default(0);
            $table->integer('create_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
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
        Schema::dropIfExists('faculty');
    }
}
