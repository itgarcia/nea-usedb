<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('databases', function (Blueprint $table) {
            $table->id();
            $table->string('ec', 100);
            $table->string('island', 100);
            $table->string('region', 50);
            $table->string('province', 100);
            $table->string('district', 100);
            $table->string('citymun', 100);
            $table->string('brgy', 100);
            $table->string('sitio', 100);
            $table->string('status', 100)->nullable();
            $table->date('energdate')->nullable();
            $table->string('brgycert', 100);
            $table->string('epelecsol', 100)->nullable();
            $table->string('epelecsolspecific', 100)->nullable();
            $table->string('eptargetyear', 100)->nullable();
            $table->integer('eptotalhouse')->nullable();
            $table->decimal('frprojcost', 9, 2)->nullable();
            $table->string('frgenfundsource', 100)->nullable();
            $table->string('frfundsource', 1000)->nullable();
            $table->string('frfundstatus', 100)->nullable();
            $table->string('icpeaceorder', 100)->nullable();
            $table->string('icrightway', 100)->nullable();
            $table->string('icnoroad', 100)->nullable();
            $table->string('icscathouse', 100)->nullable();
            $table->string('icislandbrgymun', 100)->nullable();
            $table->string('icremote', 100)->nullable();
            $table->string('icothers', 100)->nullable();
            $table->string('remarks', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databases');
    }
};
