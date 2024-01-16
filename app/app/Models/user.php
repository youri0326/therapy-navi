<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class user extends Authenticatable
{
    // このモデルの対象のテーブル
    protected $table = 'userinfo';

    // プライマリキーを指定
    protected $primaryKey = 'userid';

    protected $fillable = [
        'loginid',
        'password',
        'email',
        'phone',
        'authority',
    ];

    protected $hidden = [
        'password',
    ]; 
    
    // プライマリーキーがオートインクリメントのため設定をオン
    public $incrementing = true;
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;

    public function storeinfo()
    {
        return $this->hasOne('App\Models\storeinfo', 'userid', 'userid');
    }
    public function customerinfo()
    {
        return $this->hasOne('App\Models\customerinfo', 'userid', 'userid');
    }
}