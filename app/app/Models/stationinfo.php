<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\storeinfo;

class stationinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'stationinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'stationid';
    
    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo()
    {
        return $this->belongsTo('App\Models\storeinfo');
    }

    public function searchStationById($storeid)
    {
        return stationinfo::where('storeid', '=', $storeid)->get();
    }
}