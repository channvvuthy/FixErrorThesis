<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_name');
            $table->string('category');
                $table->string('keyword');
            $table->string('top_page');
            $table->string('sub_page');
            $table->string('dateline');
            $table->string('base_name');
            $table->string('layout_name');
            $table->string('member_name');
            $table->string('leader_check_result');
            $table->string('leader_check_description');
            $table->string('qc_check_name');
            $table->string('qc_check_result');
            $table->string('qc_check_description');
            $table->string('qc_second_check_name');
            $table->string('qc_second_check_result');
            $table->string('qc_second_check_description');
            $table->string('date_upload');
            $table->string('upload_status');
            $table->string('group_name');
            $table->boolean('status')->default(0);
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
        Schema::drop('orders');
    }
}
