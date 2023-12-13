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

class attendinfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'attendinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'attendid';
    
    protected $fillable = ['workingdate', 'attendance_status','starttime','endtime','breakstart','breakend']; // 可変項目

    // プライマリーキーがオートインクリメントのため 設定をオン
    public $incrementing = true;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;


    public function staffinfo()
    {
        return $this->belongsTo('App\Models\staffinfo', 'staffid', 'staffid');
    }


}