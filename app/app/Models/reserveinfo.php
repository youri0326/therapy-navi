<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\customerinfo;
use App\Models\accountinfo;
use App\Models\stationinfo;
use App\Models\storemenuinfo;
use App\Models\storephotoinfo;
use App\Models\staffinfo;

class reserveinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'reserveinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'reserveid';

    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    protected $fillable = [
        'customerid', 'storemenuid', 'staffid', 'reservedate', 'reservetime', 'addcomment'
    ];

    public function customerinfo() // 親テーブル(customerinfo)
    {
        // belongsTo('モデル', '外部キー', 'カスタムキー');
        return $this->belongsTo('App\Models\customerinfo', 'customerid', 'customerid');
    }


    public function storemenuinfo() // 親テーブル(storemenuinfo)
    {
        // belongsTo('モデル', '外部キー', 'カスタムキー');
        return $this->belongsTo('App\Models\storemenuinfo', 'storemenuid', 'storemenuid');
    }
    public function staffinfo() // 親テーブル(staffinfo)
    {
        // belongsTo('モデル', '外部キー', 'カスタムキー');
        return $this->belongsTo('App\Models\staffinfo', 'staffid', 'staffid');
    }
}
