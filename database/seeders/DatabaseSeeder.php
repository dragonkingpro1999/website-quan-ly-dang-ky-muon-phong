<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(loai_phong::class);
        $this->call(phong::class);
        $this->call(chuc_nang::class);
        $this->call(chuc_nang_phong::class);
        $this->call(vai_tro::class);
        $this->call(vai_tro_muon_phong::class);
        $this->call(don_vi::class);
        $this->call(nguoi_dung::class);
        $this->call(thiet_bi::class);
        $this->call(thiet_bi_phong::class);
        $this->call(muon_phong::class);
        $this->call(quyen::class);
        $this->call(phan_quyen::class);
        $this->call(quan_ly_phong::class);
        $this->call(nam_hoc::class);
        $this->call(hoc_ky::class);

        $this->call(tg_mo_hoc_ky::class);
        $this->call(cai_dat_gioi_thieu::class);
        $this->call(cai_dat_lien_he::class);
        $this->call(bang_ron::class);
        $this->call(thanh_truot::class);
        $this->call(cai_dat_thoi_gian_muon_phong::class);
        $this->call(setting_mail::class);
        $this->call(tin_tuc::class);
        $this->call(setting_ldap::class);
    }
}
