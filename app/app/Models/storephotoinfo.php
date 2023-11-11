<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\storeinfo;

class storephotoinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'storephotoinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'storephotoid';
    
    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo()
    {
        return $this->belongsTo('App\Models\storeinfo');
    }

    public function searchStorePhotoById($storeid)
    {
        return storephotoinfo::where('storeid', '=', $storeid)->get();
    }
}