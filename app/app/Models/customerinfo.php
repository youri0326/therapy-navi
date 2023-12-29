<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class customerinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'customerinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'customerid';

    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function accountinfo() // 親テーブル(accountinfo)
    {
        // belongsTo('モデル', '外部キー', 'カスタムキー');
        return $this->belongsTo('App\Models\accountinfo', 'accountid', 'accountid');
    }

    public function reservation() // 子テーブル
    {
        
        return $this->hasMany('App\Models\reserveinfo', 'customerid', 'customerid');
    }
}