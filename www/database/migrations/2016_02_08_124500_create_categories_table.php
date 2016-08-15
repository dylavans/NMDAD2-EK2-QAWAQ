<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    const MODEL = 'category';
    const TABLE = 'categories';
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

            // Data
            $table->string('name')->unique();
            $table->text('description');

            // Meta Data
            $table->timestamps(); // 'created_at', 'updated_at'
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
