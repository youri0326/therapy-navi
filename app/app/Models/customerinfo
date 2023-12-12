<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reserveinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'customerinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'customerid';

    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function accountinfo() // 子テーブル(accountinfo)
    {
        // belongsTo('モデル', '外部キー', 'カスタムキー');
        return $this->belongsTo('App\Models\accountinfo', 'accountid', 'accountid');
    }


}