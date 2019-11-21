<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('code');
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->date('dated')->nullable();
            $table->integer('uploaded_by')->nullable();
            $table->string('scouted_by')->nullable();
            $table->string('spec_tag')->nullable();
            $table->string('spec_tag_parsed')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
