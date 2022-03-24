$(document).ready(function(){
        
    $("#frm_add_bds").validate({
   rules:{
       txt_tieude:{
           required:true,
           minlength:6,
           maxlength:100,
       },
       txt_hinhthuc:{
           required:true,
       },
       txt_loaibds:{
           required:true,
       },
     
       select_file:{
           extension: "jpeg|png|jpg",
       },
       txt_mota:{
           required: true,
           maxlength:3000,
       },
     
       txt_mattien:{
           digits: true,
           min:0,
       },
       txt_duongvao:{
           digits: true,
           min:0,
       },
       txt_sotang:{
           digits: true,
           min:0,
       },
       txt_sophongngu:{
           digits: true,
           min:0,
       },
       txt_sotoilet:{
           digits: true,
           min:0,
       },
       txt_tenlienhe:{
           required: true,  
       },
       txt_diachilienhe:{
           required: true,
           
       },
       txt_dienthoailienhe:{
           required: true,  
       },
       txt_emaillienhe:{
           email:true,
       }

   },
   messages:{
       txt_tieude:{
           required:"*Vui lòng nhập vào trường này",
           minlength:"*Không nhỏ hơn 6 ký tự",
           maxlength:"*Không lớn hơn 100 ký tự",
       },
       txt_hinhthuc:{
           required:"*Vui lòng nhập vào trường này",
       },
       txt_loaibds:{
           required:"*Vui lòng nhập vào trường này",
       },
      
       
       select_file:{
           extension:"*File ảnh phải đúng định dạng: jpg,png,jpeg",
       },
       txt_mota:{
           required:"*Vui lòng nhập vào trường này",
           maxlength:"*Không lớn hơn 3000 ký tự",
       },
       txt_mattien:{
           digits:"*Dữ liệu nhập phải là số",
           min:"*Dữ liệu nhập không được số âm",
       },
       txt_duongvao:{
           digits:"*Dữ liệu nhập phải là số",
           min:"*Dữ liệu nhập không được số âm",
       },
       txt_sotang:{
           digits:"*Dữ liệu nhập phải là số",
           min:"*Dữ liệu nhập không được số âm",
       },
       txt_sophongngu:{
           digits:"*Dữ liệu nhập phải là số",
           min:"*Dữ liệu nhập không được số âm",
       },
       txt_sotoilet:{
           digits:"*Dữ liệu nhập phải là số",
           min:"*Dữ liệu nhập không được số âm",
       },
       txt_tenlienhe:{
           required:"*Vui lòng nhập vào trường này",
       },
       txt_diachilienhe:{
           required:"*Vui lòng nhập vào trường này",
       },
       txt_dienthoailienhe:{
           required:"*Vui lòng nhập vào trường này",
       },
       txt_emaillienhe:{
           email:"*Email khong đúng định dạng",
       }
   }
});
});

function onlyNumberKey(evt) {
      
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
    return true;
}