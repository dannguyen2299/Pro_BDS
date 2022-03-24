$(document).ready(function(){
  if($("#txt_gia").val()==""){
    $("#txt_sotien").html("");
  }
  else{

    viewGiaTien1();
  }
});
function viewGiaTien(){
    var formatter = new Intl.NumberFormat({
            style: 'currency',
            
        });
    var donVi1="";
    var donVi2=" nghìn";
    var donVi3=" triệu";
    var donVi4=" tỷ";
    var txt_gia=$("#txt_gia").val();
    var a=txt_gia.toString().replace(/,/g,'').length;
    var b=txt_gia.toString().replace(/,/g,'');
    $("#txt_giaBDS").val(b)
    if(a>=1 && a<=3){
        $("#txt_sotien").html(formatter.format(b)+donVi1);
        $("#txt_showMoney").val(formatter.format(b)+donVi1);
        
    }
    else if(a>=4 && a<=6){
        $("#txt_sotien").html(formatter.format(b)+donVi2);
      $("#txt_showMoney").val(formatter.format(b)+donVi2);
    }
    else if(a>=7 && a<=9){
      var d=Math.trunc(Number(b)/1000);
      $("#txt_sotien").html(formatter.format(d)+donVi3);
      $("#txt_showMoney").val(formatter.format(d)+donVi3);
    }
    else if(a>=10){
      var d=Math.trunc(Number(b)/1000000);
      $("#txt_sotien").html(formatter.format(d)+donVi4);
      $("#txt_showMoney").val(formatter.format(d)+donVi4);
    }
    else{
        $("#txt_sotien").html("");
        $("#txt_showMoney").val("");
    }
  }
  

  function viewGiaTien1(){
    var txt_donvi=$("#txt_donvi").val();
    if(txt_donvi=="VNĐ"){
      var formatter = new Intl.NumberFormat({
            style: 'currency',
            
        });
      var donVi1="";
      var donVi2=" nghìn";
      var donVi3=" triệu";
      var donVi4=" tỷ";
      var txt_gia=$("#txt_gia").val();
      var a=txt_gia.toString().replace(/,/g,'').length;
      var b=txt_gia.toString().replace(/,/g,'');
      $("#txt_giaBDS").val(b)

      if(a>=1 && a<=3){
        $("#txt_sotien").html(formatter.format(b)+donVi1);
        $("#txt_showMoney").val(formatter.format(b)+donVi1);
      }
      else if(a>=4 && a<=6){
        $("#txt_sotien").html(formatter.format(b)+donVi2);
        $("#txt_showMoney").val(formatter.format(b)+donVi2);
      }
      else if(a>=7 && a<=9){
        var d=Math.trunc(Number(b)/1000);
        $("#txt_sotien").html(formatter.format(d)+donVi3);
        $("#txt_showMoney").val(formatter.format(d)+donVi3);
      }
      else if(a>=10){
        var d=Math.trunc(Number(b)/1000000);
        $("#txt_sotien").html(formatter.format(d)+donVi4);
        $("#txt_showMoney").val(formatter.format(d)+donVi4);
      }
      else{
        $("#txt_sotien").html("");
        $("#txt_showMoney").val("");
      }
    }
    else if(txt_donvi=="m²"){
      var formatter = new Intl.NumberFormat({
            style: 'currency',
            
      });
      var donVi1="";
      var donVi2=" nghìn";
      var donVi3=" triệu";
      var donVi4=" tỷ";
      var txt_gia=$("#txt_gia").val();
     
      var a=txt_gia.toString().replace(/,/g,'').length;
      var b=txt_gia.toString().replace(/,/g,'');
      $("#txt_giaBDS").val(b)
      if(a>=1 && a<=3){
        $("#txt_sotien").html(formatter.format(b)+donVi1+"/m²");
        $("#txt_showMoney").val(formatter.format(b)+donVi1+"/m²");
      }
      else if(a>=4 && a<=6){
        $("#txt_sotien").html(formatter.format(b)+donVi2+"/m²");
        $("#txt_showMoney").val(formatter.format(b)+donVi2+"/m²");
      }
      else if(a>=7 && a<=9){
        var d=Math.trunc(Number(b)/1000);
        $("#txt_sotien").html(formatter.format(d)+donVi3+"/m²");
        $("#txt_showMoney").val(formatter.format(d)+donVi3+"/m²");
      }
      else if(a>=10){
        var d=Math.trunc(Number(b)/1000000);
        $("#txt_sotien").html(formatter.format(d)+donVi4+"/m²");
        $("#txt_showMoney").val(formatter.format(d)+donVi4+"/m²");
      }
      else{
        $("#txt_sotien").html("");
        $("#txt_showMoney").val("");
      }
    }
    else if(txt_donvi=="tháng"){
      var formatter = new Intl.NumberFormat({
            style: 'currency',
            
      });
      var donVi1="";
      var donVi2=" nghìn";
      var donVi3=" triệu";
      var donVi4=" tỷ";
      var txt_gia=$("#txt_gia").val();

      var a=txt_gia.toString().replace(/,/g,'').length;
      var b=txt_gia.toString().replace(/,/g,'');
      $("#txt_giaBDS").val(b)
      if(a>=1 && a<=3){
        $("#txt_sotien").html(formatter.format(b)+donVi1+"/tháng");
        $("#txt_showMoney").val(formatter.format(b)+donVi1+"/tháng");
      }
      else if(a>=4 && a<=6){
        $("#txt_sotien").html(formatter.format(b)+donVi2+"/tháng");
        $("#txt_showMoney").val(formatter.format(b)+donVi2+"/tháng");
      }
      else if(a>=7 && a<=9){
        var d=Math.trunc(Number(b)/1000);
        $("#txt_sotien").html(formatter.format(d)+donVi3+"/tháng");
        $("#txt_showMoney").val(formatter.format(d)+donVi3+"/tháng");
      }
      else if(a>=10){
        var d=Math.trunc(Number(b)/1000000);
        $("#txt_sotien").html(formatter.format(d)+donVi4+"/tháng");
        $("#txt_showMoney").val(formatter.format(d)+donVi4+"/tháng");
      }
      else{
        $("#txt_sotien").html("");
        $("#txt_showMoney").val("");
      }
    }
 
  }