<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\accountinfo;

class storeinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'storeinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'storeid';
    
    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function accountinfo()
    {
        return $this->belongsTo('App\Models\accountinfo');
    }

    public function storephotoinfo()
    {
        return $this->hasOne('App\Models\storephotoinfo', 'storeid', 'storeid');
    }
    public function storemenuinfo()
    {
        return $this->hasOne('App\Models\storemenuinfo', 'storeid', 'storeid');
    }
    public function stationinfo()
    {
        return $this->hasOne('App\Models\stationinfo', 'storeid', 'storeid');
    }



    public function searchStore($address, $storename, $budget, $comment)
    {
        $searchStore = DB::table('storeinfo');
        if ($address != "") {
            $searchStore->where('address', 'like', '%'.$address.'%');
        }
        
        if ($storename != "") {
            $searchStore->where('storename', 'like', '%'.$storename.'%');
        }
        
        if ($budget != "") {
            $searchStore->where('budget', 'like', '%'.$budget.'%');
        }

        if ($comment != "") {
            $searchStore->where('comment', 'like', '%'.$comment.'%');
        }

        // 値を取得しリターン
        return $searchStore->get();
    }
}