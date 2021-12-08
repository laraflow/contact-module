<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Core\Supports\Constant;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Temporary Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        //Table Structure
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3', 10)->nullable();
            $table->string('numeric_code', 10)->nullable();
            $table->string('iso2', 10)->nullable();
            $table->string('phonecode')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('native')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->json('timezones')->nullable();
            $table->json('translations')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->string('emojiU')->nullable();
            $table->string('emoji')->nullable();
            $table->enum('enabled', array_keys(Constant::ENABLED_OPTIONS))
                            ->default(Constant::ENABLED_OPTION)->nullable();
            $table->foreignId('created_by')->index()->nullable();
            $table->foreignId('updated_by')->index()->nullable();
            $table->foreignId('deleted_by')->index()->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Temporary Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        //Remove Table Structure
        Schema::dropIfExists('countries');

        //Temporary Disable Foreign Key Constraints
        Schema::enableForeignKeyConstraints();
    }
}
