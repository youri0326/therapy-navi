<?php

namespace App\Models;

use App\Models\regioninfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// 都道府県テーブル

class prefectureinfo extends Model
{
    // このモデルの対象のテーブル
    protected $table = 'prefectureinfo';
    
    // プライマリキーを指定
    protected $primaryKey = 'prefectureid';

    protected $fillable = [
        'name',
        'regionid',
    ];

    public function regioninfo()
    {
        return $this->belongsTo('App\Models\regioninfo', 'regionid', 'regionid');
    }
}
