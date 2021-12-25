<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Supports\Constant;

class CreateContactsDetailsTable extends Migration
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
        Schema::create('contacts_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id');
            $table->date('birth')->nullable();
            $table->date('anniversary')->nullable();
            $table->string('location')->nullable();
            $table->string('mileage')->nullable();
            $table->string('hobby')->nullable();
            $table->string('sensitivity', 50)->nullable();
            $table->string('priority', 10)->nullable();
            $table->string('language')->nullable();
            $table->json('website')->nullable();
            $table->foreignId('gender_id')->nullable();
            $table->foreignId('blood_group_id')->nullable();
            $table->foreignId('religion_id')->nullable();
            $table->foreignId('relation_id')->nullable();
            $table->foreignId('occupation_id')->nullable();
            $table->foreignId('group_id')->nullable();
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
        Schema::dropIfExists('contacts_details');

        //Temporary Disable Foreign Key Constraints
        Schema::enableForeignKeyConstraints();
    }
}
