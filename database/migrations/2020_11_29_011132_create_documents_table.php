<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("full_name");
            $table->text('purpose');
            $table->string("title")->nullable();
            $table->string("guardian_name")->nullable();
            $table->string("civil_status")->nullable();
            $table->string('contact_number')->nullable();
            $table->string('business_type')->nullable();
            $table->string('business_location')->nullable();
            $table->string('sketch_map')->nullable();
            $table->string('business_ownership')->nullable();
            $table->string('business_ownership_other')->nullable();
            $table->integer('age')->nullable();
            $table->bigInteger('residence_number')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
