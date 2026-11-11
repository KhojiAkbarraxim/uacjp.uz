<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * The public Members page groups people into Executive, Ambassador and Staff.
 * The admin also offered Featured, General and Alumni, and the column defaulted
 * to General, so a member could be saved into a bucket the site never renders -
 * invisible, with nothing in the panel to say so.
 *
 * Move anyone left on a legacy type into Staff, the generic visible bucket, and
 * make that the new default. Names, roles, photos and affiliations are untouched.
 */
return new class extends Migration
{
    private const LEGACY = ['Featured', 'General', 'Alumni'];

    public function up(): void
    {
        if (! Schema::hasTable('members')) {
            return;
        }

        DB::table('members')->whereIn('type', self::LEGACY)->update(['type' => 'Staff']);

        Schema::table('members', function (Blueprint $table) {
            $table->string('type')->default('Staff')->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('members')) {
            return;
        }

        Schema::table('members', function (Blueprint $table) {
            $table->string('type')->default('General')->change();
        });

        // Which members used to be Featured, General or Alumni was not recorded,
        // so those rows stay on Staff.
    }
};
