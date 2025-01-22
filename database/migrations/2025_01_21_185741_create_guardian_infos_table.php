<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student_records')->onDelete('cascade');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone');
            $table->string('alternate_phone')->nullable();
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
        Schema::dropIfExists('guardian_infos');
    }
}
