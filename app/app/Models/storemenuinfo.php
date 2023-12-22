<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\storeinfo;

class storemenuinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'storemenuinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'storemenuid';
    
    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo()
    {
        return $this->belongsTo('App\Models\storeinfo', '', '');
    }

    public function reserveinfo()
    {
        return $this->HasMany('App\Models\reserveinfo', 'storemenuid', 'storemenuid');
    }

    public function storeMenuById($storeid)
    {
        return storemenuinfo::where('storeid', '=', $storeid)->get();
    }
}