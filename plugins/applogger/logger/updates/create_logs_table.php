<?php namespace AppLogger\Logger\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use AppUser\User\Models\User;

/**
 * CreateLogsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
class CreateLogsTable extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('applogger_logger_logs', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('time_of_arrival')->nullable();
            $table->boolean('is_late')->default(false);
            $table->timestamps();
            $table->foreignIdFor(User::class);
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('applogger_logger_logs');
    }
};
