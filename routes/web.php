<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('','frontend\IndexController@Index');//All-View trang chu
Route::post('/danh_muc','frontend\IndexController@danh_muc');//All-Ham lay danh muc
Route::get('{slug_category}.html','frontend\IndexController@GetCategorys');//All-View theo danh muc
Route::get('tin-tuc','frontend\IndexController@tin_tuc');//All-View list tin tuc
Route::post('/tin_tuc','frontend\IndexController@Tintuc');//All-Lay tat ca tin tuc
Route::post('/featured_estate','frontend\IndexController@featured_estate');//All-Lay bds noi bat
Route::get('dang-nhap','Auth\AuthController@Login')->middleware('CheckLogout');//All-View dang nhap
Route::post('/dang-nhap','Auth\AuthController@login_auth')->name('login');//All-Ham xu ly danh nhap
Route::get('dang-ky','Auth\AuthController@Signup');//All-View dang ky
Route::post('/dang-ky','Auth\AuthController@Register')->name('register');//All-Ham xu ly dang ky
Route::get('/validate-email','Auth\AuthController@validate_email');//All-Ham xu ly validate trung email
Route::get('/validate-phone','Auth\AuthController@validate_phone');//All-Ham xu ly validate trung sdt
Route::get('logout','Auth\AuthController@Logout');//All-Ham dang xuat
Route::get('{idNew}/{slug_new}.html','frontend\ChiTietTinTucController@view_new_detail');//Chi tiet tin tuc
Route::post('/new_relate','frontend\ChiTietTinTucController@new_relate');//Tin tuc lien qua
Route::get('{date_time}/{id_bds}/{slug_estate}','frontend\ChiTietBDSController@view_estate_detail');
Route::post('/select_location','backend\BatDongSanController@Select_Location');
Route::post('/select_category','backend\BatDongSanController@select_category');
Route::get('search','frontend\FilterController@filter_estate')->name('filterEstate');

Route::get('quen-mat-khau','frontend\MailController@forgetPass');//All-view quen mat khau
Route::post('/recover-pass','frontend\MailController@recoverPass');
Route::get('update-new-pass','frontend\MailController@update_new_pass');
Route::post('/reset_new_pass','frontend\MailController@update_pass');

Route::group(['middleware'=>'CheckLogin'],function(){
    Route::get('trang-ca-nhan','frontend\InfoUserController@info_user');//Login-View trang ca nhan
    Route::post('/infoUser','frontend\InfoUserController@GetInfoUser');//Login-Lay thong tin User theo id
    Route::post('/edit_user','frontend\InfoUserController@EditUser')->name('editUser');//Login-Ham sua User
    Route::post('/editPassword','frontend\InfoUserController@EditPassword')->name('changePass');//Login-Ham thay doi Pass
    Route::get('danh-sach-tin-dang','frontend\BatDongSanUserController@ListEstateUser');//Login-Ham hien thi danh sach tin dang theo User
    Route::get('list_bds_user_ajax','frontend\BatDongSanUserController@List_Estate_User')->name('ListEstateUser');//Login-Ham xu ly lay danh sach tin dang theo id User

    Route::post('/add-estate','backend\BatDongSanController@Add_Estate')->name('add_estate');//Admin/Nhan vien-Ham them bds moi
    Route::post('/image-estate','backend\BatDongSanController@image_estate');//Login-Ham luu nhieu anh luc them moi bds
    Route::get('dang-tin','frontend\DangTinController@dang_tin');//All-View dang tin bds

    //Login-Ham list select Hinh thuc bds
   //Login-Ham list select quan huyen

    Route::post('/recharge','frontend\NapTienController@recharge')->name('recharge');//Ham them thong tin nap tien

    Route::get('chinh-sua-bat-dong-san/id={idBDS}','frontend\BatDongSanUserController@EditBDS_User');
    Route::post('/get_id_bds_user','frontend\BatDongSanUserController@GetIDBDS_User');
    Route::post('/remote_image','backend\BatDongSanController@remote_image');
    Route::post('/edit_bds_user','frontend\BatDongSanUserController@EditEstate_User')->name('edit_estate_user');
    Route::post('/editImage','backend\BatDongSanController@editImage');
    Route::post('/del_bds_user','frontend\BatDongSanUserController@Delete_BDS_User');

    Route::get('/repost/id={idBDS}','frontend\RepostController@Edit_repost');
    Route::post('/add_repost','frontend\RepostController@add_repost')->name('addRepost');
});

// END

//Phan backend
Route::group(['prefix'=>'admin','middleware'=>'CheckLogin'],function(){
Route::group(['middleware'=>'auth.role'],function(){ //Role Admin, Nhan vien
    Route::get('','backend\IndexController@Index');//Admin/Nhan Vien-View trang quan tri
    // Role Admin
    Route::group(['middleware'=>'adminRole'],function(){
        Route::get('user','backend\UserController@GetUser');//Admin-View danh sach User
        Route::post('assign_role','backend\UserController@assign_role');//Admin-Ham doi quyen User
        Route::post('/delete_user','backend\UserController@delete_user');//Admin-Ham xoa User
        Route::post('/view_users','backend\UserController@view_users');//Admin-Ham xem chi tiet User

        Route::post('/delete-category','backend\DanhMucController@DeleteCategory');//Admin-Ham xoa danh muc
        Route::post('/delete-new','backend\TinTucController@DeleteNews');//Admin-Ham xoa tin tuc

        // Route::get('edit-bat-dong-san/id={idBDS}','backend\BatDongSanController@View_Edit_Estate');//Admin-view sua bds
        // Route::post('/get-id-bds','backend\BatDongSanController@Get_Estate');//Admin-Lay thong tin bds theo id
        // Route::post('/edit_estate','backend\BatDongSanController@edit_estate')->name('edit_estate');//Admin-Ham sua bds

        //Admin-Xoa nhieu hinh anh trong sua bds
        //Admin-Ham luu anh da sua bds

        Route::post('/delete_estate','backend\BatDongSanController@delete_estate');//Admin-Xoa bds
        Route::get('recharge','backend\NapTienController@View_Recharge');//Admin-View trang list thong tin nap tien
        Route::get('recharge_ajax','backend\NapTienController@List_Recharge')->name('naptien.data');//Admin-Hàm hien thị thong tin nap tien
        Route::post('/ajax_recharge','backend\NapTienController@ajax_recharge');//Ham nap tien
        Route::post('/del_recharge','backend\NapTienController@del_recharge');
    });
    // End role admin
    //Danh muc

        //List Danh Muc
        Route::get('danhmuc-ajax','backend\DanhMucController@ListCategory')->name('danhmuc.data');
        Route::get('list-category',function(){
            return view('backend.danh-muc.list_danh_muc');
        });
        //End List Danh Muc

        //Add Danh Muc
        Route::get('add-category','backend\DanhMucController@GetCategorys');
        Route::post('/add-category','backend\DanhMucController@AddCategory')->name('addCate');
        // End Add Danh muc

        //Edit Danh muc
        Route::get('edit-category/id={idDanhMuc}','backend\DanhMucController@EditCategory');
        Route::post('/get-id','backend\DanhMucController@GetIDDanhMuc');
        Route::post('/edit-category','backend\DanhMucController@EditDanhMuc')->name('editCategory');
        // End Edit
    // End danh muc

    // Tin tức
        // List tin tuc
        Route::get('tintuc-ajax','backend\TinTucController@ListTinTuc')->name('dataTinTuc');
        Route::get('list-news',function(){
            return view('backend.tin-tuc.list_tin_tuc');
        });
        // End list tin tuc
        // Lay danh sach danh muc
        Route::post('/get-category','backend\TinTucController@GetCate')->name('getCate');
        // End
        // Them tin tuc
        Route::get('add-news','backend\TinTucController@AddTinTuc');
        Route::post('/add-news','backend\TinTucController@AddNews')->name('addNews');
        // End them tin tuc
        //Chinh sua tin tuc
        Route::get('edit-news/id={idTinTuc}','backend\TinTucController@ViewEdit');
        Route::post('/get-id-new','backend\TinTucController@GetIDNews');
        Route::post('/edit-news','backend\TinTucController@EditNews')->name('editNews');
        // End chinh sua tin tuc
    // End tin tức
    // Bat dong san
     // List danh sách bất động sản
        Route::get('bds-ajax','backend\BatDongSanController@Bds_Ajax')->name('dataBDS');
        Route::get('estate','backend\BatDongSanController@ListBDS');
        Route::post('/approve_estate','backend\BatDongSanController@approve_estate');//Admin/Nhan vien - Ham duyet bai dang
        Route::post('/remove_estate','backend\BatDongSanController@remove_estate');//Admin/Nhan vien - Ham go bai dang

        Route::post('/estate_detail','backend\BatDongSanController@estate_detail');

        Route::get('post-estate','backend\BatDongSanController@PostEstate');//Admin/Nhan vien - Ham hien thi trang them moi bds


     // End list
});

});
