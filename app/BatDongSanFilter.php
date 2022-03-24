<?php

namespace App;

class BatDongSanFilter extends QueryFilter
{
    
    public function form($form)
    {
        return $this->builder->where('HinhThuc', $form);
    }

    public function type($type)
    {
       
        return $this->builder->where('LoaiBDS', $type);
    }

    public function province($province)
    {
        return $this->builder->where('id_TinhThanh', $province);
    }

    public function district($district)
    {
        return $this->builder->where('id_QuanHuyen', $district);
    }

    public function ward($ward)
    {
        return $this->builder->where('id_XaPhuong', $ward);
    }

    public function bedroom($bedroom)
    {
        return $this->builder->where('SoPhongNgu', $bedroom);
    }

    public function floor($floor)
    {
        return $this->builder->where('SoTang', $floor);
    }
}