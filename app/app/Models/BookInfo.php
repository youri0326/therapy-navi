<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookInfo extends Model
{
    use HasFactory;
    
    // このモデルの対象のテーブル
    protected $table = 'bookinfo';
    
    // プライマリキーを指定
    protected $primarykey = 'isbn';
    
    // プライマリーキーがオートインクリメントではないため設定をオフ
    public $incrementing = false;
    
    // データの作成日時、更新日時がデフォルトで自動更新されるので、オフ
    public $timestamps = false;
}
