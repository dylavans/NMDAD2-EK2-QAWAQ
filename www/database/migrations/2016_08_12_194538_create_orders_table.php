<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    const MODEL = 'order';
    const TABLE = self::MODEL.'s';
    const PRIMARY_KEY = 'id';
    const FOREIGN_KEY = self::MODEL.'_'.self::PRIMARY_KEY;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key
            $table->increments(self::PRIMARY_KEY);

            // Foreign Keys
            $table->unsignedInteger(CreateCustomersTable::FOREIGN_KEY);
            $table->foreign(CreateCustomersTable::FOREIGN_KEY)
                ->references(CreateCustomersTable::PRIMARY_KEY)
                ->on(CreateCustomersTable::TABLE)
                ->onDelete('cascade');

            $table->unsignedInteger(CreateProductsTable::FOREIGN_KEY);
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
                ->onDelete('cascade');

            // Data

            // Meta Data
            $table->timestamps(); // 'created_at', 'updated_at'
            $table->softDeletes(); // 'deleted_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE);
    }
}
