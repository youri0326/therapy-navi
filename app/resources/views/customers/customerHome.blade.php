{{--
    プログラム名		：customerHome.blade.php
    プログラム説明	：顧客側トップページ

--}}
@extends('customers.layouts.app_home')

@section('title', 'トップページ')

@section('content')
<main>
    <div class="mv">
      <div class="mv__inner">
        <div class="mv__img md-none">
          <img src="{{asset('storage/img/mv-pc.png')}}" alt="" loading="lazy" />
		  
        </div>
        <div class="mv_img_box_contents md-show">
          <div class="mv_img_box">
            <figure class="mv_img01">
              <img src="{{asset('storage/img/mv_sp.png')}}" alt="">
            </figure>
            <figure class="mv_img02">
              <img src="{{asset('storage/img/illust4231thumb.gif')}}" alt="">
            </figure>
            <figure class="mv_img03">
              <img src="{{asset('storage/img/illust4237thumb.gif')}}" alt="">
            </figure>
          </div>
        </div>
      </div>
    </div>
	<section class="search__section">
      <div class="search__section__inner inner">
        <h1>整体・マッサージの店舗を探す</h1>
        <div class="search__section__contents__wrap">
          <form action="{{route('customer.storeSearch')}}">
            <input type="text" name="address" placeholder="お住まいの地域を入力">
            <input type="text" name="station" placeholder="駅名">
            <input type="submit" value="検索" class="search__button">
          </form>
        </div>
      </div>
    </section>
    <section class="prefectures__section">
      <div class="prefectures__section__inner inner">
        <h2>▼都道府県から探す</h2>
        <div class="prefectures__section__contents__wrap">
			@foreach ($regions as $region)
			<div class="kousinetsu prefectures__section__content">
				<h3>{{ $region->name }}</h3>
				<ul class="prefectures__section__list">
					@foreach ($prefectures[$region->regionid] as $prefecture)
						<li class="prefectures__section__link"><a href="{{route('customer.storeSearch')}}?address={{ $prefecture->name }}">{{ $prefecture->name }}</a></li>
					@endforeach
				</ul>
			</div>
			@endforeach
		</div>
      </div>
    </section>
</main>
@endsection