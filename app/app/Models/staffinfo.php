<?php

// accountinfo.phpからコピーして作成
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\attendinfo;
use App\Models\storeinfo;
use App\Models\reserveinfo;

// ファイル名とクラス名を同じにする
class staffinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'staffinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'staffid';
    
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
    public function reserveinfo()
    {
        return $this->hasMany('App\Models\reserveinfo', 'staffid', 'staffid');
    }

    //対象の店舗スタッフの該当月の日付別の勤怠詳細(勤務時間)を取得するための関数
    public function getAttendanceDetailByStaff($staffid,$selectedDate)
    {
        // スタッフ情報と勤怠情報を取得
        $staff = staffinfo::with(['attendinfo' => function ($query) use ($selectedDate) {
            $query->whereYear('workingdate', $selectedDate->year)
                ->whereMonth('workingdate', $selectedDate->month);
        }])->where('staffid',$staffid)->first();

        return $staff;
    }

}