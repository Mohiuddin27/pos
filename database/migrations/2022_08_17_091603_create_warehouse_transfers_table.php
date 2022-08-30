<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('transferDate');
            $table->bigInteger('current_warehouse_id');
            $table->bigInteger('product_id');
            $table->integer('current_stock');
            $table->integer('remaining_stock');
            $table->bigInteger('transfer_warehouse_id');
            $table->integer('transfer_stock');

            $table->enum('status',['Inactive','Active'])->default('Active');
            $table->enum('is_deleted',['Yes','No'])->default('No');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('restored_by')->nullable();
            $table->dateTime('restored_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('warehouse_transfers');
    }
}
