
$(document).ready(function(){
    var money=$("#txt_loaitin").val();
    var startDay=new Date($("#txt_ngaybatdau").val());
    var startEnd=new Date($("#txt_ngayketthuc").val());
    var millisBetween = startEnd.getTime() - startDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    console.log(startDay);
    console.log(startEnd);
    console.log(days);
    console.log(money);
    var sumMoney=money*days;
    console.log(sumMoney);
    var kq="Giá tiền "+days+" ngày là: "+parseInt(sumMoney).toLocaleString()+" đ";
    $(".sumMoney").html(kq);
    $("#txt_money").val(sumMoney);
   $(".money").change(function(){
    var money=$("#txt_loaitin").val();
    var startDay=new Date($("#txt_ngaybatdau").val());
    var startEnd=new Date($("#txt_ngayketthuc").val());
    var millisBetween = startEnd.getTime() - startDay.getTime();
    if(millisBetween<=0){
        alert("Khong dc so am");
    }
    else{
        var days = millisBetween / (1000 * 3600 * 24);

    }
    console.log(startDay);
    console.log(startEnd);
    console.log(days);
    console.log(money);
    var sumMoney=money*days;
    console.log(sumMoney);
    var kq="Giá tiền "+days+" ngày là: "+parseInt(sumMoney).toLocaleString()+" đ";
    $(".sumMoney").html(kq);
    $("#txt_money").val(sumMoney);
});

});
