function to_slug() {
    var txt_tieude, tieude_slug;
    txt_tieude = $("#txt_tieude").val();
    // Chuyển hết sang chữ thường
    tieude_slug = txt_tieude.toLowerCase();

    // xóa dấu
    tieude_slug = tieude_slug.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    tieude_slug = tieude_slug.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    tieude_slug = tieude_slug.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    tieude_slug = tieude_slug.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    tieude_slug = tieude_slug.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    tieude_slug = tieude_slug.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    tieude_slug = tieude_slug.replace(/(đ)/g, 'd');

    // Xóa ký tự đặc biệt
    tieude_slug = tieude_slug.replace(/([^0-9a-z-\s])/g, '');

    // Xóa khoảng trắng thay bằng ký tự -
    tieude_slug = tieude_slug.replace(/(\s+)/g, '-');

    // xóa phần dự - ở đầu
    tieude_slug = tieude_slug.replace(/^-+/g, '');

    // xóa phần dư - ở cuối
    tieude_slug = tieude_slug.replace(/-+$/g, '');

    // return
    //$("#txt_slug_category").val() = txt_slug_category;
    document.getElementById('tieude_slug').value = tieude_slug;
}