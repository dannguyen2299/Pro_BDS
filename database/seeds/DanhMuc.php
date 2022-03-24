<?php

use Illuminate\Database\Seeder;

class DanhMuc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danh_muc')->delete();
        DB::table('danh_muc')->insert([
            [
                'idDanhMuc'=>1,
                'idDanhMucCha'=>-1,
                'TieuDeDanhMuc'=>'Nhà đất bán',
                'TieuDeDanhMuc_Slug'=>'nha-dat-ban',
                'MoTaDanhMuc'=>'nhà đất bán',
                'NoiDungDanhMuc'=>'nhà đất bán',
                'ViTriTrenMainMenu'=>1,
                'HienThiTrenMainMenu'=>1,
                'ViTriTrenHeadMenu'=>0,
                'HienThiTrenHeadMenu'=>0
            ],

            [
                'idDanhMuc'=>2,
                'idDanhMucCha'=>-1,
                'TieuDeDanhMuc'=>'Nhà đất cho thuê',
                'TieuDeDanhMuc_Slug'=>'nha-dat-cho-thue',
                'MoTaDanhMuc'=>'nhà đất cho thuê',
                'NoiDungDanhMuc'=>'nhà đất bán',
                'ViTriTrenMainMenu'=>2,
                'HienThiTrenMainMenu'=>1,
                'ViTriTrenHeadMenu'=>0,
                'HienThiTrenHeadMenu'=>0
            ],

            [
                'idDanhMuc'=>3,
                'idDanhMucCha'=>-1,
                'TieuDeDanhMuc'=>'Dự án',
                'TieuDeDanhMuc_Slug'=>'du-an',
                'MoTaDanhMuc'=>'nhà đất bán',
                'NoiDungDanhMuc'=>'dự án',
                'ViTriTrenMainMenu'=>3,
                'HienThiTrenMainMenu'=>1,
                'ViTriTrenHeadMenu'=>0,
                'HienThiTrenHeadMenu'=>0
            ],

            [
                'idDanhMuc'=>4,
                'idDanhMucCha'=>-1,
                'TieuDeDanhMuc'=>'Tin tức',
                'TieuDeDanhMuc_Slug'=>'tin-tuc',
                'MoTaDanhMuc'=>'nhà đất bán',
                'NoiDungDanhMuc'=>'tin tức',
                'ViTriTrenMainMenu'=>4,
                'HienThiTrenMainMenu'=>1,
                'ViTriTrenHeadMenu'=>0,
                'HienThiTrenHeadMenu'=>0
            ],
            
            [
                'idDanhMuc'=>5,
                'idDanhMucCha'=>1,
                'TieuDeDanhMuc'=>'Bán căn hộ chung cư',
                'TieuDeDanhMuc_Slug'=>'ban-can-ho-chung-cu',
                'MoTaDanhMuc'=>'bán căn hộ chung cư',
                'NoiDungDanhMuc'=>'bán căn hộ chung cư',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>1,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>6,
                'idDanhMucCha'=>1,
                'TieuDeDanhMuc'=>'Bán nhà riêng',
                'TieuDeDanhMuc_Slug'=>'ban-nha-rieng',
                'MoTaDanhMuc'=>'bán nhà riêng',
                'NoiDungDanhMuc'=>'bán nhà riêng',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>2,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>7,
                'idDanhMucCha'=>1,
                'TieuDeDanhMuc'=>'Bán nhà mặt phố',
                'TieuDeDanhMuc_Slug'=>'ban-nha-mat-pho',
                'MoTaDanhMuc'=>'bán nhà mặt phố',
                'NoiDungDanhMuc'=>'bán nhà mặt phố',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>3,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>8,
                'idDanhMucCha'=>1,
                'TieuDeDanhMuc'=>'Bán đất',
                'TieuDeDanhMuc_Slug'=>'ban-dat',
                'MoTaDanhMuc'=>'bán đất',
                'NoiDungDanhMuc'=>'bán đất',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>4,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>9,
                'idDanhMucCha'=>2,
                'TieuDeDanhMuc'=>'Cho thuê căn hộ chung cư',
                'TieuDeDanhMuc_Slug'=>'cho-thue-can-ho-chung-cu',
                'MoTaDanhMuc'=>'Cho thuê căn hộ chung cư',
                'NoiDungDanhMuc'=>'Cho thuê căn hộ chung cư',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>1,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>10,
                'idDanhMucCha'=>2,
                'TieuDeDanhMuc'=>'Cho thuê nhà riêng',
                'TieuDeDanhMuc_Slug'=>'cho-thue-nha-rieng',
                'MoTaDanhMuc'=>'Cho thuê nhà riêng',
                'NoiDungDanhMuc'=>'Cho thuê nhà riêng',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>2,
                'HienThiTrenHeadMenu'=>1
            ],

            [
                'idDanhMuc'=>11,
                'idDanhMucCha'=>2,
                'TieuDeDanhMuc'=>'Cho thuê nhà mặt phố',
                'TieuDeDanhMuc_Slug'=>'cho-thue-nha-mat-pho',
                'MoTaDanhMuc'=>'Cho thuê nhà mặt phố',
                'NoiDungDanhMuc'=>'Cho thuê nhà mặt phố',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>3,
                'HienThiTrenHeadMenu'=>1,
            ],

            [
                'idDanhMuc'=>12,
                'idDanhMucCha'=>2,
                'TieuDeDanhMuc'=>'Cho thuê văn phòng',
                'TieuDeDanhMuc_Slug'=>'cho-thue-van-phong',
                'MoTaDanhMuc'=>'Cho thuê văn phòng',
                'NoiDungDanhMuc'=>'Cho thuê văn phòng',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>4,
                'HienThiTrenHeadMenu'=>1,
            ],

            [
                'idDanhMuc'=>13,
                'idDanhMucCha'=>3,
                'TieuDeDanhMuc'=>'Dự án căn hộ chung cư',
                'TieuDeDanhMuc_Slug'=>'du-an-can-ho-chung-cu',
                'MoTaDanhMuc'=>'Dự án căn hộ chung cư',
                'NoiDungDanhMuc'=>'Dự án căn hộ chung cư',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>1,
                'HienThiTrenHeadMenu'=>1,
            ],

            [
                'idDanhMuc'=>14,
                'idDanhMucCha'=>3,
                'TieuDeDanhMuc'=>'Dự án cao ốc văn phòng',
                'TieuDeDanhMuc_Slug'=>'du-an-cao-oc-van-phong',
                'MoTaDanhMuc'=>'Dự án cao ốc văn phòng',
                'NoiDungDanhMuc'=>'Dự án cao ốc văn phòng',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>2,
                'HienThiTrenHeadMenu'=>1,
            ],

            [
                'idDanhMuc'=>15,
                'idDanhMucCha'=>3,
                'TieuDeDanhMuc'=>'Trung tâm thương mại',
                'TieuDeDanhMuc_Slug'=>'trung-tam-thuong-mai',
                'MoTaDanhMuc'=>'Dự án trung tâm thương mại',
                'NoiDungDanhMuc'=>'Dự án trung tâm thương mại',
                'ViTriTrenMainMenu'=>0,
                'HienThiTrenMainMenu'=>0,
                'ViTriTrenHeadMenu'=>3,
                'HienThiTrenHeadMenu'=>1,
            ],

        ]);

    }
}
