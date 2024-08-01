<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Courier;
use App\Models\Status;
use Illuminate\Support\Facades\Http;

if (!function_exists('brandInRandom')) {
    function brandInRandom($limit)
    {
        $data = Brand::inRandomOrder();
        if ($limit) {
            $data = $data->limit($limit);
        }
        $data = $data->get();
        return $data;
    }
}

if (!function_exists('categoryInRandom')) {
    function categoryInRandom($limit)
    {
        $data = Category::inRandomOrder();
        if ($limit) {
            $data = $data->limit($limit);
        }
        $data = $data->get();
        return $data;
    }
}

if (!function_exists('allBrand')) {
    function allBrand()
    {
        $data = Brand::orderBy('name', 'asc')->get();
        return $data;
    }
}

if (!function_exists('allCategory')) {
    function allCategory()
    {
        $data =  Category::orderBy('name', 'asc')->get();
        return $data;
    }
}

if (!function_exists('populerBrand')) {
    function populerBrand()
    {
        $data =  Brand::orderBy('name', 'asc')->get();
        return $data;
    }
}

if (!function_exists('allCourier')) {
    function allCourier()
    {
        $data =  Courier::orderBy('name', 'asc')->get();
        return $data;
    }
}

if (!function_exists('getColorStatus')) {
    function getColorStatus($id_status)
    {
        $color = '';
        if ($id_status == 1) $color = 'warning';
        if ($id_status == 2) $color = 'info';
        if ($id_status == 3) $color = 'success';
        if ($id_status == 4) $color = 'success';
        if ($id_status == 5) $color = 'success';
        if ($id_status == 6) $color = 'success';
        if ($id_status == 7) $color = 'danger';
        return $color;
    }
}

if (!function_exists('allStatusOrder')) {
    function allStatusOrder()
    {
        $data = Status::orderBy('id', 'asc')->get();
        return $data;
    }
}

if (!function_exists('getCityRajaOngkir')) {
    function getCityRajaOngkir($id_city)
    {
        $api_key = '4618e86ae5108c96e2bb230e660fa7db';
        $city = Http::withHeaders([
            'key' => $api_key,
        ])->get('https://api.rajaongkir.com/starter/city?id=' . $id_city)['rajaongkir']['results'];
        return $city;
    }
}

if (!function_exists('getProvinceRajaOngkir')) {
    function getProvinceRajaOngkir($id_province)
    {
        $api_key = '4618e86ae5108c96e2bb230e660fa7db';
        $province = Http::withHeaders([
            'key' => $api_key,
        ])->get('https://api.rajaongkir.com/starter/province?id=' . $id_province)['rajaongkir']['results'];
        return $province;
    }
}
