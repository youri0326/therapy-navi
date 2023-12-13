<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class accountinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'accountinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'accountid';
    
    // プライマリーキーがオートインクリメントではないため設定をオフ
    public $incrementing = false;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo()
    {
        return $this->hasOne('App\Models\storeinfo', 'accountid', 'accountid');
    }
}