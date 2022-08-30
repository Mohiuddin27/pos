<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartytypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partytypes', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('restored_by')->nullable();
            $table->date('restored_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->enum('status',['Inactive','Active'])->default('Active');
            $table->enum('is_deleted',['Yes','No'])->default('No');
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
        Schema::dropIfExists('partytypes');
    }
}
