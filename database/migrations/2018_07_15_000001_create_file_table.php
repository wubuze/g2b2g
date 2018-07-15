<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->engine = 'innodb';

            $table->unsignedBigInteger('id', true);

            $table->string ('dir',16)->comment('文件夹')->nullable();
            $table->text('file')->comment('文件名')->nullable();
            $table->text('type')->comment('文件类型')->nullable();
            $table->text('url')->comment('文件url')->nullable();
            $table->smallInteger('using')->comment('引用次数')->default(0);

            $table->index('dir');
            $table->index('using');

        });


        Schema::create('file_group', function (Blueprint $table) {
            $table->engine = 'innodb';

            $table->unsignedInteger('id')->comment('model的id');
            $table->string('model',16)->comment('model名称');
            $table->unsignedBigInteger('file_id')->comment('文件id');

            $table->unique(['model', 'id', 'file_id'], 'id');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file');
        Schema::dropIfExists('file_group');
    }
}

