<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->string('barcode_no')->nullable();
            $table->string('barcode')->nullable();
            $table->bigInteger('category_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('unit_id');
            $table->integer('opening_stock');
            $table->integer('remainder_quantity')->default(0);
            $table->decimal('purchase_price',12,2);
            $table->decimal('sale_price',12,2);
            $table->decimal('discount',10,2)->nullable();
            $table->string('notes')->nullable();
            $table->string('model_no')->nullable();
            $table->integer('current_stock')->default(0);
            $table->integer('sale_quantity')->default(0);
            $table->decimal('total_purchase_price',12,2)->default(0);
            $table->decimal('total_sale_price',12,2)->default(0);
            $table->decimal('remaining_price',12,2)->default(0);
            $table->integer('purchase_quantity')->nullable();

            $table->enum('type',['regular','serialize','service'])->default('regular');
            $table->enum('stock_check',['Yes','No'])->default('No');
            $table->integer('items_in_box')->nullable();

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
        Schema::dropIfExists('products');
    }
}
