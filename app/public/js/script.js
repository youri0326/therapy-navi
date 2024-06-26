document.addEventListener("DOMContentLoaded", function(){

   var fv = document.querySelector('.mv');
   var header = document.querySelector('header');



   window.addEventListener('scroll', function(){

    var fvBottom = fv.getBoundingClientRect().bottom;

    if (fvBottom <= 0) {
      header.classList.add('action');

    } else {
      header.classList.remove('action');
    }
   });


});




$(function () {
  // ハンバーガーメニュー
  $(".js-hamburger,.js-drawer").click(function () {
    $(".js-hamburger").toggleClass("is-active");
    $(".js-drawer").fadeToggle();
  });
});


$(function () {
  $(".js-accordion__item:first-child .js-accordion__content").css(
    "display",
    "block"
  );
  $(".js-accordion__item:first-child .js-accordion__title").addClass("is-open");
  $(".js-accordion__title").on("click", function () {
    $(this).toggleClass("is-open");
    $(this).next().slideToggle(300);
  });
});


/*すライダー*/

// $('.slider').slick({
//   autoplay: false,//自動的に動き出すか。初期値はfalse。
//   infinite: false,//スライドをループさせるかどうか。初期値はtrue。
//   slidesToShow: 3,//スライドを画面に3枚見せる
//   slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
//   prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
//   nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
//   dots: false,//下部ドットナビゲーションの表示
//   variableWidth: true,
//   responsive: [
//     {
//     breakpoint: 769,//モニターの横幅が769px以下の見せ方
//     settings: {
//       slidesToShow: 1,//スライドを画面に2枚見せる
//       slidesToScroll: 1,//1回のスクロールで2枚の写真を移動して見せる
//       variableWidth: false
//     }
//   }

// ]
// });


// /* PCデザインをタブレットで縮小表示
// ***************************************************************/
// // デバイスに応じてビューポートを設定
// function judgeDevice() {
//   let ua = navigator.userAgent;

//   if ((ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0) && ua.indexOf('Mobile') > 0) {
//       $("meta[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0');
//   } else if (ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0) {
//       //PCサイズをここで調整
//       $("meta[name='viewport']").attr('content', 'width=1480');
//   } else {
//       $("meta[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0');
//   }
// }

// // 画面サイズに応じてビューポートを設定
// function judgeWindowSize() {
//   const windowWidth = $(window).width();
//   //PC・SPサイズをここで調整
//   if (windowWidth <= 760) {
//       $("meta[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0');
//   } else if (windowWidth > 760 && windowWidth <= 1480) {
//       $("meta[name='viewport']").attr('content', 'width=1480');
//   } else {
//       $("meta[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0');
//   }
// }

// // ウィンドウサイズが変更されたらjudgeWindowSizeを呼び出す
// $(window).resize(function () {
//   judgeWindowSize();
// });




// #から始まるURLがクリックされた時
jQuery('a[href^="#"]').click(function() {
  // .headerクラスがついた要素の高さを取得
  let header = jQuery(".header").innerHeight();
  let speed = 300;
  let id = jQuery(this).attr("href");
  let target = jQuery("#" == id ? "html" : id);
  // トップからの距離からヘッダー分の高さを引く
  let position = jQuery(target).offset().top - header;
  // その分だけ移動すればヘッダーと被りません
  jQuery("html, body").animate(
    {
      scrollTop: position
    },
    speed
  );
  return false;
});