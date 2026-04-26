<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Tambahan kolom ke tabel sekolah yang sudah ada
     * (jalankan setelah migrasi sekolah awal)
     */
    public function up(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            // Kepala sekolah
            $table->string('foto_kepsek')->nullable()->after('nip_kepsek');
            $table->text('sambutan_kepsek')->nullable()->after('foto_kepsek');

            // Identitas tambahan
            $table->string('website')->nullable()->after('email');
            $table->string('kode_pos')->nullable()->after('website');
            $table->string('kelurahan')->nullable()->after('kode_pos');
            $table->string('kecamatan')->nullable()->after('kelurahan');
            $table->string('kota')->default('Kota Kediri')->after('kecamatan');
            $table->string('provinsi')->default('Jawa Timur')->after('kota');
            $table->decimal('latitude', 10, 7)->nullable()->after('provinsi');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            // Media sosial
            $table->string('facebook')->nullable()->after('longitude');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('instagram');

            // Operasional
            $table->string('tahun_berdiri')->nullable()->after('youtube');
            $table->string('tahun_ajaran_aktif')->nullable()->after('tahun_berdiri'); // contoh: 2024/2025
            $table->string('semester_aktif')->nullable()->after('tahun_ajaran_aktif'); // 1 atau 2
        });
    }

    public function down(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->dropColumn([
                'foto_kepsek', 'sambutan_kepsek', 'website', 'kode_pos',
                'kelurahan', 'kecamatan', 'kota', 'provinsi',
                'latitude', 'longitude',
                'facebook', 'instagram', 'youtube',
                'tahun_berdiri', 'tahun_ajaran_aktif', 'semester_aktif',
            ]);
        });
    }
};