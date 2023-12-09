<?php

// accountinfo.phpからコピーして作成
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\attendinfo;

// ファイル名とクラス名を同じにする
class staffinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'staffinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'staffid';
    
    // プライマリーキーはオートインクリメント
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo() // 親テーブルの名前
    {
        return $this->belongsTo('App\Models\storeinfo'); //親テーブルのパスを引数に指定する
    }

    public function attendinfo() // 子テーブルの名前
    {
        return $this->hasMany('App\Models\attendinfo', 'staffid', 'staffid');
    }
}