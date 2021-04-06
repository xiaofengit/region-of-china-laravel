<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->unsignedBigInteger('code')->unqiue()->primary()->comment('代码，6位，不足6位补充0');
            $table->string('name')->comment('名称');
            $table->unsignedBigInteger('parent_code')->nullable()->comment('父ID');
            $table->enum('type', ['country', 'province', 'city', 'district', 'street'])->comment('类型：国家、省、市、县（区）、镇（乡、街道）');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
