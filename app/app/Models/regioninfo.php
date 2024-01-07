<?php

namespace App\Models;

use App\Models\prefectureinfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// 都道府県テーブル

class regioninfo extends Model
{
    // このモデルの対象のテーブル
    protected $table = 'regioninfo';

    // プライマリキーを指定
    protected $primaryKey = 'regionid';

    protected $fillable = [
        'name',
    ];
    public function prefectureinfo()
    {
        return $this->hasMany('App\Models\prefectureinfo', 'regionid', 'regionid');
    }

}
