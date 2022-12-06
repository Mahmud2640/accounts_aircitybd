<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('code')->nullable();
            $table->string('passport_number')->nullable();
            $table->integer('airline_id')->nullable();
            $table->integer('sector_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('refered_by')->nullable();
            $table->string('payment_states')->nullable();
            $table->string('states')->nullable();
            $table->text('passport_copy')->nullable();
            $table->text('ticket_copy')->nullable();
            $table->text('visa_copy')->nullable();
            $table->text('id_copy')->nullable();
            $table->text('others_copy')->nullable();
            $table->double('pay', 8, 2)->default(0);
            $table->double('due', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('amount', 8, 2)->default(0);
            $table->double('purchase', 8, 2)->default(0);
            $table->string('purchase_by')->nullable();
            $table->dateTime('flight_date')->nullable();
            $table->string('type')->default('New air ticket');
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
        Schema::dropIfExists('tickets');
    }
}
