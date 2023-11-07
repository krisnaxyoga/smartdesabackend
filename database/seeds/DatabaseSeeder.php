<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
                // $this->call(MerchantsSeeder::class);
                // $this->call(MerchantUsersSeeder::class);
                // $this->call(SchedulesTableSeeder::class);
                // $this->call(ScheduleRatesTableSeeder::class);
                // $this->call(ShuttleAreasTableSeeder::class);
                // $this->call(AreasTableSeeder::class);
                // $this->call(PortsTableSeeder::class);
                // $this->call(CountriesTableSeeder::class);
                // $this->call(PromosTableSeeder::class);
                // $this->call(CategoriesTableSeeder::class);
                $this->call(GolonganDarahTableSeeder::class);
                $this->call(KeluargaTableSeeder::class);
                $this->call(KeluargaSejahteraTableSeeder::class);
                $this->call(PendudukPendidikanTableSeeder::class);
                $this->call(PendudukPendidikanKkTableSeeder::class);
                $this->call(PendudukSexTableSeeder::class);
                $this->call(PendudukStatusTableSeeder::class);
                $this->call(PendudukUmurTableSeeder::class);
                $this->call(PendudukWarganegaraTableSeeder::class);
                $this->call(DesaPamongTableSeeder::class);
                $this->call(PendudukTableSeeder::class);
                $this->call(PendudukKawinTableSeeder::class);
                $this->call(UsersTableSeeder::class);
                $this->call(TempatDilahirkanTableSeeder::class);
                $this->call(SakitMenahunTableSeeder::class);
                $this->call(PenolongKelahiranTableSeeder::class);
                $this->call(CacatTableSeeder::class);
                $this->call(CaraKbTableSeeder::class);
                $this->call(KtpStatusTableSeeder::class);
                $this->call(PendudukPekerjaanTableSeeder::class);
                $this->call(PendudukHubunganTableSeeder::class);
                $this->call(PendudukAgamaTableSeeder::class);
                $this->call(WilayahTableSeeder::class);
                $this->call(ProgramTableSeeder::class);
                $this->call(AnalisisRefSubjekTableSeeder::class);
                $this->call(PendudukMapTableSeeder::class);
                $this->call(JenisKelahiranTableSeeder::class);
                $this->call(StatusDasarTableSeeder::class);
                $this->call(TipeLokasiTableSeeder::class);
                $this->call(LokasiTableSeeder::class);
                $this->call(TipeGarisTableSeeder::class);
                $this->call(TipeAreaTableSeeder::class);
                $this->call(GarisTableSeeder::class);
                $this->call(AreaTableSeeder::class);
                $this->call(KelompokTableSeeder::class);
                $this->call(KelompokMasterTableSeeder::class);
                $this->call(KelompokAnggotaTableSeeder::class);
                $this->call(KategoriArtikelTableSeeder::class);
                $this->call(ArtikelTableSeeder::class);
                $this->call(HalamanTableSeeder::class);
                $this->call(PengajuanSuratTableSeeder::class);
                $this->call(KepalaDusunTableSeeder::class);
                $this->call(JenisSuratTableSeeder::class);
                $this->call(DesaTableSeeder::class);
                $this->call(BidangEplanningTableSeeder::class);
                $this->call(PengaduanCategoriesTableSeeder::class);
                $this->call(PengaduanTableSeeder::class);
                $this->call(ProvincesTableSeeder::class);
                $this->call(RegenciesTableSeeder::class);
                $this->call(DistrictsTableSeeder::class);
                $this->call(PendudukPendatangTableSeeder::class);
                $this->call(DetailPendudukPendatangTableSeeder::class);
                $this->call(KategoriInventarisTableSeeder::class);
                $this->call(SumberInventarisTableSeeder::class);
                $this->call(UnitInventarisTableSeeder::class);
                $this->call(RkpSumberDanaTableSeeder::class);
                $this->call(KegiatanEplanningTableSeeder::class);
                $this->call(RkpDesaTableSeeder::class);
                $this->call(VillagesTableSeeder::class);
                $this->call(BarangTableSeeder::class);
                $this->call(KategoriBarangTableSeeder::class);
        $this->call(SukuTableSeeder::class);
    }
}
