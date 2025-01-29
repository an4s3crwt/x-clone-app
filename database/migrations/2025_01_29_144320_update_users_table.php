<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string("username")->unique()->after('id');
            $table->string('avatar')->nullable()->after('name');
            $table->text('banner')->nullable()->after('avatar');
            $table->string('description')->nullable()->after('password');
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'avatar', 'banner', 'description']);
        });
    }
};
