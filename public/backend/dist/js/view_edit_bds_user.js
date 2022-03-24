$('#txt_gia').simpleMoneyFormat();
        $(document).ready(function(){
            var url=window.location.pathname;
            var idBDS=url.substring(url.lastIndexOf('=')+1);
            $("#txt_id_bds").val(idBDS);
            $.ajax({
                url:'/get_id_bds_user',
                type:'post',
                data:{idBDS:idBDS},
                success:function(result){
                    $("#txt_tieude").val(result.bds.TieuDeBDS);
                    $("#tieude_slug").val(result.bds.TieuDeBDS_Slug);
                    $("#txt_mota").val(result.bds.MoTaBDS);
                    $("#txt_noidung").val(result.bds.NoiDungBDS);
                    $("#txt_diachi").val(result.bds.DiaChiBDS);
                    $("#txt_mattien").val(result.bds.MatTien);
                    $("#txt_duongvao").val(result.bds.DuongVao);
                    var huongnha="";
                        huongnha+="<option value='KXĐ'";
                        if(result.bds.HuongNha=="KXĐ"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">---KXĐ---</option>";

                        huongnha+="<option value='Đông'";
                        if(result.bds.HuongNha=="Đông"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông</option>";
                        huongnha+="<option value='Tây'";
                        if(result.bds.HuongNha=="Tây"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây</option>";
                        huongnha+="<option value='Nam'";
                        if(result.bds.HuongNha=="Nam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Nam</option>";
                        huongnha+="<option value='Bắc'";
                        if(result.bds.HuongNha=="Bắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Bắc</option>";
                        huongnha+="<option value='ĐôngBắc'";
                        if(result.bds.HuongNha=="ĐôngBắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông - Bắc</option>";
                        huongnha+="<option value='TâyBắc'";
                        if(result.bds.HuongNha=="TâyBắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây - Bắc</option>";

                        huongnha+="<option value='TâyNam'";
                        if(result.bds.HuongNha=="TâyNam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây - Nam</option>";

                        huongnha+="<option value='ĐôngNam'";
                        if(result.bds.HuongNha=="ĐôngNam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông - Nam</option>";
                        $("#txt_huongnha").html(huongnha);

                        var huongbancong="";
                        huongbancong+="<option value='KXĐ'";
                        if(result.bds.HuongBanCong=="KXĐ"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">---KXĐ---</option>";

                        huongbancong+="<option value='Đông'";
                        if(result.bds.HuongBanCong=="Đông"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông</option>";
                        huongbancong+="<option value='Tây'";
                        if(result.bds.HuongBanCong=="Tây"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây</option>";
                        huongbancong+="<option value='Nam'";
                        if(result.bds.HuongBanCong=="Nam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Nam</option>";
                        huongbancong+="<option value='Bắc'";
                        if(result.bds.HuongBanCong=="Bắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Bắc</option>";
                        huongbancong+="<option value='ĐôngBắc'";
                        if(result.bds.HuongBanCong=="ĐôngBắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông - Bắc</option>";
                        huongbancong+="<option value='TâyBắc'";
                        if(result.bds.HuongBanCong=="TâyBắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây - Bắc</option>";

                        huongbancong+="<option value='TâyNam'";
                        if(result.bds.HuongBanCong=="TâyNam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây - Nam</option>";

                        huongbancong+="<option value='ĐôngNam'";
                        if(result.bds.HuongBanCong=="ĐôngNam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông - Nam</option>";
                        $("#txt_huongbancong").html(huongbancong);
                        $("#txt_sotang").val(result.bds.SoTang);
                        $("#txt_sophongngu").val(result.bds.SoPhongNgu);
                        $("#txt_sotoilet").val(result.bds.SoToilet);
                        $("#txt_noithat").val(result.bds.NoiThat);
                        $("#txt_phaply").val(result.bds.ThongTinPhapLy);
                        $("#txt_tenlienhe").val(result.bds.TenLienHe);
                        $("#txt_diachilienhe").val(result.bds.DiaChiLienHe);
                        $("#txt_dienthoailienhe").val(result.bds.DienThoai);
                        $("#txt_emaillienhe").val(result.bds.emailUser);
                }
            });
        });