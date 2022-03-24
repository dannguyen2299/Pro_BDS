$(document).ready(function(){

    $('.choose').on('change',function(){
        var action=$(this).attr('id');
        var matp=$(this).val();
        
        var _token=$('input[name="_token"]').val();
        var result='';
        var url=window.location.pathname;
        var idBDS=url.substring(url.lastIndexOf('=')+1);
        $("#txt_id_bds").val(idBDS);
        if(action=='txt_tinhthanh'){
            result='txt_quanhuyen';
        }
        else{
            result='txt_phuongxa';
        }
        $.ajax({
            url:'/select_location',
            method:'post',
            data:{action:action,matp:matp,_token:_token,idBDS:idBDS},
            success:function(data){
                $('#'+result).html(data);
            }
        });
    });
});