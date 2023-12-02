<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\accountinfo;
use App\Models\stationinfo;
use App\Models\storemenuinfo;
use App\Models\storephotoinfo;

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



    public function searchStore($address,$station, $storename, $budget, $comment)
    {
        // $searchStore = new storeinfo();
        $searchStore = DB::table('storeinfo');
        // $searchStore->join('stationinfo', 'storeinfo.storeid', '=', 'stationinfo.storeid')
        // ->join('storemenuinfo', 'storeinfo.storeid', '=', 'storemenuinfo.storeid')
        // ->join('storephotoinfo', 'storeinfo.storeid', '=', 'storephotoinfo.storeid');

        if ($address != "") {
            $searchStore->where('address', 'like', '%'.$address.'%');
        }
        if ($station != "") {
             $searchStore->where('station', 'like', '%'.$station.'%');
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