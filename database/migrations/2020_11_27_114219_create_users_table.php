<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('roles_id');
            $table->foreign('roles_id')->references('id')->on('roles');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birthdate');
            $table->text('address');
            $table->text('valid_id');
            $table->string('email')->unique();
            $table->boolean('status')->default(false);
            $table->string('phone_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $preData =
            [
                'roles_id'=> 1,
                'tag_id'=> 1,
                'first_name'=> 'John Cena',
                'middle_name'=> 'Brax',
                'last_name'=> 'Zoe',
                'birthdate'=>\Carbon\Carbon::now(),
                'valid_id'=> 'none.jpg',
                'address'=> '#234 Batol Imelda Samal, Bataan',
                'email'=> 'j.doe@trycatch.com',
                'phone_number'=> '09123456789',
                'password'=> Hash::make('123'),
            ];
        DB::table('users')->insert($preData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
