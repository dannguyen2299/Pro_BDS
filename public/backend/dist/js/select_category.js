$(document).ready(function(){
    $('.category').on('change',function(){
        var action=$(this).attr('id');
        var id_dm=$(this).val();
        var _token=$('input[name="_token"]').val();
        var result='';
        if(action=='txt_hinhthuc'){
            result='txt_loaibds';
        }
        $.ajax({
            url:'/select_category',
            method:'post',
            data:{action:action,id_dm:id_dm,_token:_token},
            success:function(data)
            {
                $('#'+result).html(data);
            }
        });
    });
});