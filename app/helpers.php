<?php

use App\Models\Order;
use App\Models\Purchases;
use App\Models\temp;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

function rp($num){
    return "Rp " . number_format($num,0,',','.');
}

function ref($type){
    if($type == "PR"){
        $model = Purchases::class;
    }elseif($type == "OD"){
        $model = Order::class;
    }else{
        return 00000;
    }
    $count = $model::count() + 1 ;
    $datePart = date('dmy');
    $countPart = str_pad($count, 3, '0', STR_PAD_LEFT);
    $typePart = $type;
    return "{$typePart}{$countPart}{$datePart}";

}

function tgl($date)
{
    $englishMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $indonesianMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $formattedDate = str_replace($englishMonths, $indonesianMonths, date('d F, Y', strtotime($date)));
    return $formattedDate; // Output: 22 Mei, 2023
}
function usaha(){
    $data['nama'] = env('APP_COMPANY_NAME');
    $data['alamat'] = env('APP_COMPANY_ADDRESS');
    $data['hp'] = env('APP_COMPANY_PHONE');
    return $data;
}
function formatAmount($amount) {
    if ($amount >= 1000) {
        $suffixes = ['', 'K', 'M', 'B', 'T'];
        $suffixIndex = 0;
        
        while ($amount >= 1000) {
            $amount /= 1000;
            $suffixIndex++;
        }
        
        return round($amount, 2) . $suffixes[$suffixIndex];
    }
    
    return $amount;
}

