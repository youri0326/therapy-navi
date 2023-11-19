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
        //更新したい値を引数にとり、$this->storeidに代入し、privateプロパティを更新
        $this->storeid = $storeid;
    }

    //accountidゲッター
    public function getAccountId(){
        return $this->accountid;
    }

    //accountidセッター
    public function setAccountId($accountid){
        //更新したい値を引数にとり、$this->storeidに代入し、privateプロパティを更新
        $this->accountid = $accountid;
    }

    //storenameゲッター
    public function getStoreName(){
        return $this->storename;
    }

    //storenameセッター
    public function setStoreName($storename){
        //更新したい値を引数にとり、$this->storenameに代入し、privateプロパティを更新
        $this->storename = $storename;
    }

    //adressゲッター
    public function getAdress(){
        return $this->adress;
    }

    //addressセッター
    public function setAdress($adress){
        //更新したい値を引数にとり、$this->addressに代入し、privateプロパティを更新
        $this->address = $address;
    }

    //accountidゲッター
    public function getBudget(){
        return $this->budget;
    }

    //accountidセッター
    public function setAccountId($budget){
        //更新したい値を引数にとり、$this->budgetに代入し、privateプロパティを更新
        $this->budget = $budget;
    }

    //commentゲッター
    public function getComment(){
        return $this->comment;
    }

    //commentセッター
    public function setComment($comment){
        //更新したい値を引数にとり、$this->commentに代入し、privateプロパティを更新
        $this->comment = $comment;
    }

    //paymentゲッター
    public function getPayment(){
        return $this->accountid;
    }

    //paymentセッター
    public function setPayment($payment){
        //更新したい値を引数にとり、$this->paymentに代入し、privateプロパティを更新
        $this->payment = $payment;
    }

    //storemenuListゲッター
    public function getStoreMenuList(){
        return $this->getStoreMenuList;
    }

    //storemenuListセッター
    public function setStoreMenuList($storemenuList){
        //更新したい値を引数にとり、$this->storemenuListに代入し、privateプロパティを更新
        $this->storemenuList = $storemenuList;
    }

    //storephotoListゲッター
    public function getStorePhotoList(){
        return $this->storephotoList;
    }

    //storephotoListセッター
    public function setStorePhotoList($storephotoList){
        //更新したい値を引数にとり、$this->storephotoListに代入し、privateプロパティを更新
        $this->storephotoList = $storephotoList;
    }

    //stationListゲッター
    public function getStationList(){
        return $this->stationList;
    }

    //stationListセッター
    public function setStationList($stationList){
        //更新したい値を引数にとり、$this->stationListに代入し、privateプロパティを更新
        $this->stationList = $stationList;
    }

    //staffListゲッター
    public function getStaffList(){
        return $this->staffList;
    }

    //staffListセッター
    public function setStaffList($staffList){
        //更新したい値を引数にとり、$this->staffListに代入し、privateプロパティを更新
        $this->staffList = $staffList;
    }
}
