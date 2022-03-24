<?php

function GetCategory($mang,$parent,$shift,$id_select){
    foreach ($mang as $value) {
        # code...
        if($value['idDanhMucCha']==$parent)
        {
            if($value['idDanhMuc']==$id_select){
                echo "<option selected value=".$value['idDanhMuc'].">".$shift.$value['TieuDeDanhMuc']."</option>";
            }
            else{
                echo "<option value=".$value['idDanhMuc'].">".$shift.$value['TieuDeDanhMuc']."</option>";
            }

            GetCategory($mang,$value['idDanhMuc'],$shift."---|",$id_select);
        }
    }
}


function GetCategory1($mang,$parent,$shift,$id_select){
    foreach ($mang as $value) {
        # code...
        if($value['idDanhMucCha']==$parent)
        {
            if($value['idDanhMuc']==$id_select){
                echo "<option selected value=".$value['idDanhMuc'].">".$shift.$value['TieuDeDanhMuc']."</option>";
            }
            else{
                echo "<option value=".$value['idDanhMuc'].">".$shift.$value['TieuDeDanhMuc']."</option>";
            }

            GetCategory($mang,$value['idDanhMuc'],$shift."--| ",$id_select);
        }
    }
}


