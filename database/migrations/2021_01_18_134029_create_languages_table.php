<?php

use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale')->unique();
            $table->enum('direction', ['ltr', 'rtl'])->default('ltr');
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Language::create([
            'name' => 'العربية',
            'locale' => 'ar',
            'direction' => 'rtl',
        ]);
        Language::create([
            'name' => 'English',
            'locale' => 'en',
            'direction' => 'ltr',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
