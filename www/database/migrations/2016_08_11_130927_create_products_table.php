<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    const MODEL = 'product';
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
            $table->unsignedInteger(CreateCategoriesTable::FOREIGN_KEY);
            $table->foreign(CreateCategoriesTable::FOREIGN_KEY)
                ->references(CreateCategoriesTable::PRIMARY_KEY)
                ->on(CreateCategoriesTable::TABLE)
                ->onDelete('cascade');

            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY);
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)
                ->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');

            // Data
            $table->string('title')->unique();
            $table->text('content');
            $table->text('pictures');
            $table->double('price');
            $table->double('btw');
            $table->double('sale');
            $table->boolean('stock');

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
