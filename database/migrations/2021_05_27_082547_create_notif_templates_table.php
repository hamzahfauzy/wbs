<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notif_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notif_event_id')->constrained()->cascadeOnDelete();
            $table->string('send_to'); // guest, admin, pengawas
            $table->text('template_text');
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
        Schema::dropIfExists('notif_templates');
    }
}
