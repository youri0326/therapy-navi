<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store
{
    private $storeid;
    private $accountid;
    private $storename;
    private $address;
    private $budget;
    private $comment;
    private $payment;
    private $storemenuList;
    private $storephotoList;
    private $stationList;
    private $staffList;

    public function __construct($storeid,$accountid,$storename,$address,$budget,$comment,$payment,$storemenuList,$storephotoList,$stationList,$staffList) {
        $this->$storeid = $storeid;
        $this->$accountid = $accountid;
        $this->$storename = $storename;
        $this->$address = $address;
        $this->$budget = $budget;
        $this->$comment = $comment;
        $this->$payment = $payment;
        $this->$storemenuList = $storemenuList;
        $this->$storephotoList = $storephotoList;
        $this->$stationList = $stationList;
        $this->$staffList = $staffList;
    }
    //storeidゲッター
    public function getStoreId(){
        return $this->storeid;
    }

    //storeidセッター
    public function setStoreId($storeid){
        //更新したい値を引数にとり、$this->priceに代入し、privateプロパティを更新
        $this->storeid = $storeid;
    }
}
