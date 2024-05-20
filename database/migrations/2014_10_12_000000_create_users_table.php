<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('ic', 12)->nullable();
            $table->integer('age')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('contact', 15)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum("role", [User::ROLE_ADMIN, User::ROLE_TEACHER]);
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
        Schema::dropIfExists('users');
    }
};
