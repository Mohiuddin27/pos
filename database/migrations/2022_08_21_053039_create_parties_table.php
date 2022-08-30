<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('mobile_no')->unique();
            $table->string('alternative_mobile_no')->unique();
            $table->text('address')->nullable();
            $table->string('district')->nullable();
            $table->string('country')->nullable();
            $table->decimal('credit_limit')->nullable();
            $table->decimal('current_due')->default(0.0);
            $table->decimal('opening_due')->default(0.0);
            $table->string('party_type');
            $table->string('party_variety');
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
        Schema::dropIfExists('parties');
    }
}





















