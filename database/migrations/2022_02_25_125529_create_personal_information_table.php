<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                    ->constrained()
                    ->onDelete('cascade');
            $table->string("first_name");
            $table->string("last_name");
            $table->date("birth_date");
            $table->string("phone_number")->unique();
            $table->string("post_code");
            $table->string("city");
            $table->string("street");
            $table->integer("street_number");
            $table->integer("floor");
            $table->integer("door");
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
        Schema::dropIfExists('personal_information');
    }
}
