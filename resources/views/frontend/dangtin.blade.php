@extends('frontend.master.master')
{{-- @extends('frontend.layout.layout') --}}
@section('title','Dang tin')
@section('content')

<script src="../backend/dist/js/readmoney.js"></script>
<script src="../backend/dist/js/to_slug.js"></script>
<script src="../backend/dist/js/validate_add_bds.js"></script> 
<script src="../backend/dist/js/money.js"></script>

<style>
    label.error {
    color:red!important;
    font-size: 13px;
}
</style>

    <section class="bds-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about pt-5">
            <div class="container pt-lg-5 py-3">
            </div>
        </div>
    </section>
    <section class="bds-breadcrumb">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span>Đăng tin</li>
                <!-- <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Contact Us</li> -->
            </ul>
        </div>
    </section>
    <!-- contacts -->
    <section class="bds-contact-7 pt-5 pb-5" id="contact">
        <div class="contacts-9 pt-lg-5 pt-md-4">
            <div class="container-fluid">
                <div class="top-map">
                    <div class="row map-content-9">
                        <div class="col-lg-9">
                            <div class="contact-form">
                                <h5 class="mb-2">Đăng tin rao bán, cho thuê nhà đất</h5>
                                {{-- <p class="mb-4">Đăng tin</p> --}}
                                @csrf
                                <form id="frm_add_bds" name="frm_add_bds" class="dropzone" action="{{ route('add_estate') }}" method="post" enctype="multipart/form-data" role="form">

                                    <input type="hidden" class="id_bds" name="id_bds" id="id_bds">
                                    <div class="form-group">
                                        <label for="txt_tieude">Tiêu đề (<span class="text-danger">*</span>)</label>
                                        <input type="text" class="form-control" id="txt_tieude" name="txt_tieude" placeholder="Tiêu đề bất động sản..." onkeyup="to_slug();" >
                                        <div id="show_error"></div>
                                    </div>
                                    <input type="hidden" id="tieude_slug" name="tieude_slug" />
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_hinhthuc">Hình thức (<span class="text-danger">*</span>)</label>
                                                <select class="form-control select2 category parent_cate" name="txt_hinhthuc" id="txt_hinhthuc">
                                                    <option value="0">---Hình thức---</option>
                                                    @foreach ($category as $row)
                                                        <option value="{{ $row->idDanhMuc }}">{{ $row->TieuDeDanhMuc }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="show_error1"></div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_loaibds">Loại (<span class="text-danger">*</span>)</label>
                                                <select class="form-control select2 kind" name="txt_loaibds" id="txt_loaibds">
                                                    
                                                </select>
                                                <div id="show_error2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_tinhthanh">Tỉnh/Thành phố (<span class="text-danger">*</span>)</label>
                                                <select class="form-control select2 choose city" name="txt_tinhthanh" id="txt_tinhthanh">
                                                    <option value="">---Tỉnh/Thành---</option>
                                                    @foreach ($city as $row)
                                                       <option value="{{ $row->id }}">{{ $row->name }}</option> 
                                                    @endforeach
                                                </select>
                                                {{-- <div id="show_error2"></div> --}}
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_quanhuyen">Quận/Huyện (<span class="text-danger">*</span>)</label>
                                                <select class="form-control select2 choose districts" name="txt_quanhuyen" id="txt_quanhuyen">
                                                    
                                                </select>
                                                {{-- <div id="show_error4"></div> --}}
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_phuongxa">Phường/Xã (<span class="text-danger">*</span>)</label>
                                                <select class="form-control select2 wards" name="txt_phuongxa" id="txt_phuongxa">
                                                    
                                                </select>
                                                {{-- <div id="show_error5"></div> --}}
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_dientich">Diện tích (m²)</label>
                                                <input type="number" min="0" value="0" step="0.1"  class="dientich form-control" id="txt_dientich" name="txt_dientich" placeholder="Diện tích...">
                                                <div id="show_error3"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_gia">Giá</label>
                                                <input type="text" class="form-control" id="txt_gia" name="txt_gia" placeholder="Giá..." onkeyup="viewGiaTien();" onkeypress="return onlyNumberKey(event)" maxlength="19">
                                               

                                                <div class="text-danger" id="txt_sotien"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Đơn vị</label>
                                                <select class="form-control" name="txt_donvi" id="txt_donvi" onchange="viewGiaTien1();">
                                                    <option value="VNĐ">VNĐ</option>
                                                    <option value="m²">Giá/m²</option>
                                                    <option value="tháng">Giá/tháng</option>
                                                </select>
                                            </div>
                                        </div>
                                       <input type="hidden" name="txt_showMoney" id="txt_showMoney">
                                       <input type="hidden" name="txt_giaBDS" id="txt_giaBDS">
                                    </div>
                                 
                                   
                                  
                                    <div class="form-group">
                                        <label for="txt_diachi">Địa chỉ (<span class="text-danger">*</span>)</label>
                                        <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" placeholder="Địa chỉ...">
                                        <div id="show_error5"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ảnh đại diện</label>
                                        <div>
                                          <input id="select_file" type="file" name="select_file" class="form-control hidden" style="display: none;"
                                            onchange="changeImg(this)">
                                        <img id="avatar" class="thumbnail" width="200px" height="150px" src="../backend/dist/img/import-img.png" style="cursor: pointer;border-style:groove;">
                                        </div>
                                        <div id="show_error3"></div>
                                        

                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" id="txt_mota" name="txt_mota" rows="5" placeholder="Mô tả..."></textarea>
                                        <div id="show_error6"></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control" id="summernote" name="txt_noidung" rows="5" placeholder="Nội dung..."></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_mattien">Mặt tiền (m)</label>
                                                <input type="number" min="0" step="0.1" value="0" class="form-control" id="txt_mattien" name="txt_mattien" placeholder="Mặt tiền...">
                                                <div id="show_error7"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_duongvao">Đường vào (m)</label>
                                                <input type="number" min="0" step="0.1" value="0" class="form-control" id="txt_duongvao" name="txt_duongvao" placeholder="Đường vào...">
                                                <div id="show_error8"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_huongnha">Hướng nhà</label>
                                                <select class="form-control" name="txt_huongnha" id="txt_huongnha">
                                                    <option value="KXĐ">---KXĐ---</option>
                                                    <option value="Đông">Đông</option>
                                                    <option value="Tây">Tây</option>
                                                    <option value="Nam">Nam</option>
                                                    <option value="Bắc">Bắc</option>
                                                    <option value="ĐôngBắc">Đông - Bắc</option>
                                                    <option value="TâyBắc">Tây - Bắc</option>
                                                    <option value="TâyNam">Tây - Nam</option>
                                                    <option value="ĐôngNam">Đông - Nam</option>
                                                </select>
                                                {{-- <div id="show_error12"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_huongbancong">Hướng ban công</label>
                                                <select class="form-control" name="txt_huongbancong" id="txt_huongbancong">
                                                    <option value="KXĐ">---KXĐ---</option>
                                                    <option value="Đông">Đông</option>
                                                    <option value="Tây">Tây</option>
                                                    <option value="Nam">Nam</option>
                                                    <option value="Bắc">Bắc</option>
                                                    <option value="ĐôngBắc">Đông - Bắc</option>
                                                    <option value="TâyBắc">Tây - Bắc</option>
                                                    <option value="TâyNam">Tây - Nam</option>
                                                    <option value="ĐôngNam">Đông - Nam</option>
                                                </select>
                                                {{-- <div id="show_error13"></div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_sotang">Số tầng</label>
                                                <input type="number" min="0" class="form-control" value="0" id="txt_sotang" name="txt_sotang" placeholder="Số tầng...">
                                                <div id="show_error9"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_sophongngu">Số phòng ngủ</label>
                                                <input type="number" min="0" class="form-control" value="0" id="txt_sophongngu" name="txt_sophongngu" placeholder="Số phòng ngủ...">
                                                <div id="show_error10"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_sotoilet">Số Toilet</label>
                                                <input type="number" class="form-control" value="0" id="txt_sotoilet" name="txt_sotoilet" placeholder="Số toilet...">
                                                <div id="show_error11"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label>Nội thất</label>
                                        <textarea class="form-control" id="txt_noithat" name="txt_noithat" rows="3" placeholder="Nội thất"></textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Thông tin pháp lý</label>
                                        <textarea class="form-control" id="txt_phaply" name="txt_phaply" rows="3" placeholder="Ví dụ: Đã có sổ hồng, Sổ đỏ,..."></textarea>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                                            <span>Upload file</span>
                                        </div>
                                        <div class="dropzone-previews"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_tenlienhe">Tên liên hệ</label>
                                                <input type="text" class="form-control" id="txt_tenlienhe" name="txt_tenlienhe" placeholder="Tên liên hệ...">
                                                <div id="show_error12"></div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="txt_diachilienhe">Địa chỉ</label>
                                                <input type="text" class="form-control" id="txt_diachilienhe" name="txt_diachilienhe" placeholder="Địa chỉ liên hệ...">
                                                <div id="show_error13"></div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_dienthoailienhe">Điện thoại</label>
                                                <input type="text" class="form-control" id="txt_dienthoailienhe" name="txt_dienthoailienhe" placeholder="Điện thoại liên hệ...">
                                                <div id="show_error14"></div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="txt_emaillienhe">Email</label>
                                                <input type="text" class="form-control" id="txt_emaillienhe" name="txt_emaillienhe" placeholder="Email...">
                                                {{-- <div id="show_error"></div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_loaitin">Loại tin rao</label>
                                                <select class="form-control money" name="txt_loaitin" id="txt_loaitin">
                                                    <option value="20000">Tin thường</option>
                                                    <option value="50000">Tin VIP</option>
                                                </select>
                                                {{-- <div id="show_error"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_ngaybatdau">Ngày bắt đầu</label>
                                                <input type="date" class="form-control money" id="txt_ngaybatdau" name="txt_ngaybatdau" 
                                                value="{{ $date }}"
                                                >
                                                <div id="show_error15"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_ngayketthuc">Ngày kết thúc</label>
                                                <input type="date" class="form-control money" id="txt_ngayketthuc" name="txt_ngayketthuc" 
                                                value="{{ $date_end }}"
                                                >
                                                <div id="show_error16"></div>
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="txt_money" id="txt_money" />
                                        <div class="form-group">
                                            <p class="sumMoney text-danger"></p>
                                        </div>
                                        
                                    </div>

                                    <button type="submit" id="btn_add_dm" class="btn btn-primary btn-style pull-right mt-3">Submit</button>
                                </form>
                            </div>
                        </div>

                        @include('frontend.layout.layout')
                        
                    </div>
                    
                </div>
            </div>

        </div>
    </section>
    <!-- //contacts -->
    <section class="bds-contact-7 pt-3 pb-5" id="contact">
        <div class="row">
            <div class="col-lg-9">
                <div class="container-fluid">
                    <div class="contact-form">
                        <h5 class="mb-2">Bảng báo giá tin đăng</h5>
                        <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Loại Tin</th>
                            <th scope="col">Giá Tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Tin thường</td>
                            <td>20,000 VNĐ/ngày</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Tin VIP</td>
                            <td>50,000 VNĐ/ngày</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    {{-- <script>
        $(document).ready(function () { 
            $("#box_info").hide();
    
            $("#btn_naptien").click(function(){
                $("#box_info").show();
                $("#box_bank").hide();
                var sotien=$("#txt_numberMoney").val();
                var money=parseInt(sotien).toLocaleString()+" VNĐ";
                $("#txt_money").html(money);
                var numberRan= Math.floor(Math.random() * (999999 - 100000)) + 100000;
                var numRan="Nap BDS "+numberRan;
                $("#txt_numRan").html(numRan);
                $("#numRan1").html(numberRan);
                $("#txt_moneyHidden").val(sotien);
            });
         });
    </script> --}}
    <script src="../backend/dist/js/select_location.js"></script>
    <script src="../backend/dist/js/select_category.js"></script> 
    
<script>
    Dropzone.autoDiscover = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
        
    var myDropzone = new Dropzone("div#dropzoneDragArea", { 
        
        url: "{{ url('/image-estate') }}",
        previewsContainer: 'div.dropzone-previews',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        paramName: "file",
        parallelUploads: 100,
        maxFiles: 100,
        params: {
            _token: token
        },
         // The setting up of the dropzone
        init: function() {
            var myDropzone = this;
            //form submission code goes here
            $("form[name='frm_add_bds']").submit(function(event) {
                //Make sure that the form isn't actully being sent.
                event.preventDefault();
    
                URL = $("#frm_add_bds").attr('action');
                formData = $('#frm_add_bds').serialize();
                $('.alert').remove();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    processData: false,
                    cache:false,
                    success: function(result){
                        console.log(result);
                        if(result[0].success == "success"){
                            
                            var id_bds = result[0].id_bds;
                            $("#id_bds").val(id_bds);
                            myDropzone.processQueue();
                            toastr.success('Đăng tin thành công. Tin đăng của bạn đang chờ duyệt!','Thông báo');
                            
                            // window.location.href='../admin/estate';
                            location.reload(); 

                        }
                        else if(result[0].err=="err"){
                            // toastr.wa('Đăng tin thành công. Tin đăng của bạn đang chờ duyệt!','Thông báo');
                            toastr.warning('Tài khoản của bạn không đủ tiền đăng tin', 'Thông báo!')
                        }
                        
                        else
                        {
                            for(var i=0;i<result.length;i++){
                            if(result[i].txt_tieude){
                                $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_tieude+'</p>');
                            }
                            if(result[i].txt_hinhthuc){
                                $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_hinhthuc+'</p>');
                            }
                            if(result[i].txt_loaibds){
                                $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_loaibds+'</p>');
                            }
                            if(result[i].txt_dientich){
                                $("#show_error3").append('<p class="alert alert-danger">'+result[i].txt_dientich+'</p>');
                            }
                            // if(result[i].txt_gia){
                            //     $("#show_error4").append('<p class="alert alert-danger">'+result[i].txt_gia+'</p>');
                            // }
                            if(result[i].txt_diachi){
                                $("#show_error5").append('<p class="alert alert-danger">'+result[i].txt_diachi+'</p>');
                            }
                            if(result[i].txt_mota){
                                $("#show_error6").append('<p class="alert alert-danger">'+result[i].txt_mota+'</p>');
                            }
                            if(result[i].txt_mattien){
                                $("#show_error7").append('<p class="alert alert-danger">'+result[i].txt_mattien+'</p>');
                            }
                            if(result[i].txt_duongvao){
                                $("#show_error8").append('<p class="alert alert-danger">'+result[i].txt_duongvao+'</p>');
                            }
                            if(result[i].txt_sotang){
                                $("#show_error9").append('<p class="alert alert-danger">'+result[i].txt_sotang+'</p>');
                            }
                            if(result[i].txt_sophongngu){
                                $("#show_error10").append('<p class="alert alert-danger">'+result[i].txt_sophongngu+'</p>');
                            }
                            if(result[i].txt_sotoilet){
                                $("#show_error11").append('<p class="alert alert-danger">'+result[i].txt_sotoilet+'</p>');
                            }
                           
                            if(result[i].txt_tenlienhe){
                                $("#show_error12").append('<p class="alert alert-danger">'+result[i].txt_tenlienhe+'</p>');
                            }
                            if(result[i].txt_diachilienhe){
                                $("#show_error13").append('<p class="alert alert-danger">'+result[i].txt_diachilienhe+'</p>');
                            }
                            if(result[i].txt_dienthoailienhe){
                                $("#show_error14").append('<p class="alert alert-danger">'+result[i].txt_dienthoailienhe+'</p>');
                            }
                            if(result[i].txt_ngaybatdau){
                                $("#show_error15").append('<p class="alert alert-danger">'+result[i].txt_ngaybatdau+'</p>');
                            }
                            if(result[i].txt_ngayketthuc){
                                $("#show_error16").append('<p class="alert alert-danger">'+result[i].txt_ngayketthuc+'</p>');
                            }
                        }
                    }
                    }
                 });
            });
    
            //Gets triggered when we submit the image.
            this.on('sending', function(file, xhr, formData){
            //fetch the user id from hidden input field and send that userid with our image
              let id_bds = document.getElementById('id_bds').value;
               formData.append('id_bds', id_bds);
               
            });
            
            this.on("success", function (file, response) {
                //reset the form
                $('#frm_add_bds')[0].reset();
                //reset dropzone
                $('.dropzone-previews').empty();
            });
    
            this.on("queuecomplete", function () {
            
            });
            
            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function(file) {
              // Gets triggered when the form is actually being sent.
              // Hide the success button or the complete form.
              
            });
            
            this.on("successmultiple", function(files, response) {
              // Gets triggered when the files have successfully been sent.
              // Redirect user or notify of success.
              
            });
            
            this.on("errormultiple", function(files, response) {
              // Gets triggered when there was an error sending the files.
              // Maybe show form again, and notify user of error
            });
        }
        });
    });
    </script>
   <script>
       $(function() {
            $("input.dientich").bind("change keyup input", function() {
            var position = this.selectionStart - 1;
            var fixed = this.value.replace(/[^0-9\.]/g, "");
            if (fixed.charAt(0) === ".")
            fixed = fixed.slice(1);
            var pos = fixed.indexOf(".") + 1;
            if (pos >= 0)
            fixed = fixed.substr(0, pos) + fixed.slice(pos).replace(".", "");
            if (this.value !== fixed) {
            this.value = fixed;
            this.selectionStart = position;
            this.selectionEnd = position;
            }
        });
    });
   </script>

<script>
    $(document).ready(function(){
        $.ajax({
            type:'post',
            url:'/infoUser',
            success:function(result){
                console.log(result);
                var str="";
                // for(var i=0;i<result.user.length;i++){
                   str+= "<h5 class='text-center'>Thông tin cá nhân</h5>";

                        str+="<h5 class='mt-4 pt-lg-3 text-center'>"+result.user.Ho+" "+result.user.Ten+"</h5>";
                        str+="<p style='font-size: 14px;'><span></span> Tài khoản tin rao: "+parseInt(result.user.SoTien).toLocaleString()+" đ</p>";
                            

                        str+="<p><span class='fa fa-phone'></span> <strong class='txt_info'>Tel :</strong>";
                            str+="<a class='txt_info' href='tel:"+result.user.Phone+"'> "+result.user.Phone+"</a></p>";

                        str+="<p> <span class='fa fa-envelope'></span> <strong class='txt_info'>Email :</strong>";
                            str+="<a class='txt_info' href='mailto:"+result.user.email+"'> "+result.user.email+"</a></p>";

                            str+="<p class='title'>Quản lý thông tin cá nhân</p>";
                            str+="<ul>";
                                str+="<a href='../trang-ca-nhan'><li>Thay đổi thông tin cá nhân</li></a>";
                                str+="<a href='' data-toggle='modal' data-target='#exampleModal'><li>Thay đổi mật khẩu</li></a>";
                                str+="<a href='' data-toggle='modal' data-target='#exampleModal12'><li>Nạp tiền</li></a>";

                            str+="</ul>";

                            str+="<p class='title'>Quản lý tin đăng</p>";
                            str+="<ul>";
                                str+="<a href='../danh-sach-tin-dang'><li>Danh sách tin đăng</li></a>";
                                str+="<a href='../dang-tin'><li>Đăng tin</li></a>";
                               
                            str+="</ul>";
                // }

                    $("#info_user").html(str);
            }
            
        })
    });
</script>

<script>
    $(function(){
        $(".form_password .eye").click(function(){
            let $this=$(this);
            if($this.hasClass('active')){
                $this.parents(".form_password").find('input').attr('type','password');
                $this.removeClass('active');
            }
            else{
                $this.parents(".form_password").find('input').attr('type','text');
                $this.addClass('active');
            }
            // alert("12");
        });
    });
</script>
<script>
    $(function(){
        $("#frm_changePass").submit(function(e){
            var route=$("#frm_changePass").data('route');
            var form=$(this);
            $('.text-danger').remove();
            $.ajax({
                type:'post',
                url:route,
                data:form.serialize(),
                success:function(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].password_old){
                            $("#show_errors").append('<p class="text-danger">'+result[i].password_old+'</p>');
                        }
                        if(result[i].err){
                            $("#show_errors").append('<p class="text-danger">'+result[i].err+'</p>');

                        }
                        if(result[i].password){
                            $("#show_errors1").append('<p class="text-danger">'+result[i].password+'</p>');
                        }
                        // if(result[i].password_confirm){
                        //     $("#show_errors2").append('<p class="text-danger">'+result[i].password_confirm+'</p>');
                        // }
                        if(result[i].success){
                            toastr.success(result[i].success,'Thong bao');
                            
                        }
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>


   @endsection