{{--
    プログラム名		：storeSearch.blade.php
    プログラム説明	：検索した店舗の一覧表示を行う
    作成日時			：
    作成者			：吉池悠理
--}}
@extends('customers.layouts.app')

@section('title', 'トップページ')

@section('content')

<section class="inner">
	<h1 class="search__answer__title">サロンを探す</h1>
				
	@if($storeList->count() > 0)
		<p class="search__answer__text">{{$address}}の３件の検索結果</p>
			@foreach($storeList as $store)
				<div class="search__answer__contents">
					<div class="search__answer__content__box">
						<h2 class="search__answer__content__box__title"><a href ="{{asset('/customers/storeDetail')}}?storeid={{$store->storeid}}">{{$store->storename}}</a></h2>
						@if($store->storephotoinfo->where('imgrole', 0)->count() > 0)
							@foreach($store->storephotoinfo->where('imgrole', 0) as $photo)
										@php
										$photopath = $photo->photopath;
										if(str_contains($photopath, '.jpg')){
											$photoName = str_replace('.jpg', '', $photopath);
										}
										elseif(str_contains($photopath, '.png')){
											$photoName = str_replace('.png', '', $photopath);
										}
										@endphp
										<img src="{{asset($photo->photopath)}}" alt="{{ $photoName }}">
									@endforeach
						@endif
						<div class="search__answer__content__text__box">
							<ul class="search__answer__content">
								<li class="search__answer__content__list">
									<p class="search__answer__content__list__title">アクセス</p>
									@if($store->stationinfo->count() > 0)
										<p class="search__answer__content__list__text">
											@foreach($store->stationinfo as $station)
												{{ $station->stationname }}/
											@endforeach
										</p>
									@endif
								</li>
							</ul>
							<ul>
								<li class="search__answer__content__list">
									<p class="search__answer__content__list__title">主なメニュー</p>
									<ul class="search__answer__content__list__text">
										@if($store->storemenuinfo->where('servicerole', 0)->count() > 0)
											@foreach($store->storemenuinfo as $menu)
												<li>・{{ $menu->servicename }}/{{ $menu->amount }}円</li>
											@endforeach
										@endif
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>	
				@endforeach

 
			<div class="pagination">
						{{ $storeList->links() }}
			</div>
		@else
			<div class="research_title">
				<h3>ご指定の条件に該当するお店は見つかりませんでした。</h3>
				<p>検索条件を変更して、再度検索してください。</p>
			</div>
			@include('customers.layouts.storeSearchForm')
		@endif
		@endsection