<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\accountinfo;
use App\Models\stationinfo;
use App\Models\storemenuinfo;
use App\Models\storephotoinfo;
use App\Models\staffinfo;

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
        // return $this->hasMany('App\Models\storephotoinfo');
        return $this->hasMany('App\Models\storephotoinfo', 'storeid', 'storeid');
        // return $this->hasMany('App\Models\storephotoinfo', 'storeid');
    }
    public function storemenuinfo()
    {
        return $this->hasMany('App\Models\storemenuinfo', 'storeid', 'storeid');
    }
    public function stationinfo()
    {
        return $this->hasMany('App\Models\stationinfo', 'storeid', 'storeid');
    }

    public function staffinfo()
    {
        return $this->hasMany('App\Models\staffinfo', 'storeid', 'storeid');
    }

    //店舗情報を検索する関数
    public function searchStore($address,$station, $storename, $comment)
    {
        $searchStore = storeinfo::query();
 
        if (!empty($address)) {
            $searchStore = $searchStore->where('address', 'like', '%'.$address.'%');
        }
        if (!empty($station)) {
            $searchStore->orWhereHas('stationinfo', function ($searchStore) use ($station) {
                $searchStore->where('station', 'like', '%' . $station . '%');
            });
        }
        
        if (!empty($storename)) {
            $searchStore->where('storename', 'like', '%'.$storename.'%');
        }

        if (!empty($comment)) {
            $searchStore->where('comment', 'like', '%'.$comment.'%');
        }

        $searchStore = $searchStore->with(['stationinfo', 'storephotoinfo','storemenuinfo'])->get();

        // 値を取得しリターン
        return $searchStore;
    }

    //対象の店舗の該当月の各スタッフの日付別の勤怠情報(勤怠の可否)を取得するための関数
    public function getAttendanceList($storeid,$selectedDate)
    {
        // スタッフ情報と勤怠情報を取得
        $store = storeinfo::with(['staffinfo.attendinfo' => function ($query) use ($selectedDate) {
            $query->whereYear('workingdate', $selectedDate->year)
                ->whereMonth('workingdate', $selectedDate->month);
        }])->where('storeid',$storeid)->first();

        return $store;
    }
}