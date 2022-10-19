<script setup></script>
<template>
    <article class="border-top border-dark">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img :src="'/img/footer-img.jpg'" class="active d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item">
              <img :src="'/img/top-img1.jpg'" class="active d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item ">
              <img :src="'/img/top-img2.jpg'" class="d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item ">
              <img :src="'/img/top-img3.jpg'" class="d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item ">
              <img :src="'/img/top-img4.jpg'" class="d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item ">
              <img :src="'/img/top-img5.jpg'" class="d-block w-100 img-fluid top-img" alt="...">
            </div>
            <div class="carousel-item ">
              <img :src="'/img/top-img6.jpg'" class="d-block w-100 img-fluid top-img" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </article>
      <!-- / トップスライド -->
      <div class="container-fluid">
        <article class="message-section" id="about">
          <h2 class="pt-5 text-center fw-bold d-block">
            ABOUT
          </h2>
          <section class="about-section mt-4 mx-auto">
            <div class="row justify-content-center">
              <div class="col-md-6 about-box col-padding-0 light_blue_background p-3">
                <h4 class="text-center">🌍Space Land🌍とは<br>（スペースランド）</h4>
                <p class="text-center">
                  日本の伝統和紙を使った<br>
                  手作りのかわいい動物などのキャラクターです。<br>
                  デザイナーの生まれ故郷の<br>
                  ユネスコ無形文化遺産の細川紙なども組み込み、アレンジした作品となります。<br>
                  主にSpace Cat(スペースニャンコ）からのスタートです。<br>
                  みんなが笑顔になって、癒されることを願っています🇯🇵❤️<br>
                </p>
              </div>
              <div class="col-md-6 text-left col-padding-0">
                <img :src="'/img/top-page-qa-space-land.jpg'" class="about-img">
              </div> 
            </div> 
          </section>
          <section class="about-section mt-5">
            <div class="row">
              <div class="col-md-6 about-box col-padding-0 light_blue_background p-3">
                <h4 class="text-center">🌍Space Catとは🐈‍⬛️🌍</h4>
                <p class="text-center">
                  異次元空間の遠い遠い宇宙から<br>
                  地球人の笑顔が見たくてやってきました。
                </p>
              </div>
              <div class="col-md-6 text-left col-padding-0">
                <img :src="'/img/top-page-qa-space-cat.jpg'" class="about-img">
              </div> 
            </div> 
          </section>
          <section class="about-section mt-5">
            <div class="row">
              <div class="col-md-6 about-box col-padding-0 light_blue_background p-3 ">
                <h4 class="text-center">
                  🌍スペースキャット🐱🌍シリーズはのキャラクターは
                  手足がありません。
                </h4>
                <p class="text-center">
                    その理由は香箱座りをしているからです。<br>
                    猫の香箱座りとは最上級のリラックスしているときなのです😻💖💖💖<br>
                    香箱とは、お香を入れる箱で<br>
                    裕福な家の娘が嫁入りするときの道具の１つでもありました。<br>
                    そして千代紙の香箱のなかで、<br>
                    かわいく地球人を見つめています😻<br>
                  </p>
              </div>
              <div class="col-md-6 text-left col-padding-0">
                <img :src="'/img/test3.jpg'" class="about-img">
              </div> 
            </div> 
          </section>
          <section class="mt-5 ">
            <div class="text-center">
              <video :src="'/img/item-discribe.mp4'" controls class="video-size"></video>
            </div>
            <p>※重箱の中に和菓子のように収まりました🐱💕</p>
          </section>
          <section class="mt-5">
            <div class="text-center">
              <video :src="'/img/top_view2.mp4'" controls class="video-size"></video>
            </div>
            <p>※日本の季節の行事です。七夕です。着せ替えのできるシリーズです。</p>
          </section>
          <section class="mt-5">
            <div class="text-center">
              <video :src="'/img/top_page2.mp4'" controls class="video-size"></video>
            </div>
            <p>※スペースキャットの紹介動画です。最後に登場したキャラクターは「和紙（わし）が大将」です。</p>
          </section>
          <div class="button_wrapper my-5 text-center">
            <button type="button" onclick="location.href='online_store'" class="btn btn-primary d-inline-block btn-hover w-25">ONLINE STOREを見る</button>  
          </div>
        </article>
      </div>
      <article class="light_blue_background">
        <div class="container-fluid">
          <h2 class="pt-5 pb-4  text-center fw-bold d-block">
            NEWS
          </h2>
          <div class="row">
            <section class="col-lg-4 col-md-6 col-padding-1">
              <img :src="'/img/many_cat1.jpg'" class="news-img d-block w-100">
              <div class="bg-white p-3 news-content ">
                <span class="ml-1 d-inline-block">5月19日</span>
                <h5 class="pl-1">デザインフェスvol.55出展</h5>
                <p class="pl-1">さわって楽しむやわらかフィギュアもにまるず！デザインフェスタvol.55に出展します！ 新作「クリームうさぎ」「クリームとら」「クリームシロクマ」が登場します！ 会場：東京ビ</p>
              </div>
            </section>
            <section class="col-lg-4 col-md-6">
              <img :src="'/img/many_cat2.jpg'" class="news-img d-block w-100">
              <div class="bg-white p-3 news-content">
                <span>1月21日</span>
                <h5>HMJ 冬 2022 出展</h5>
                <p>さわって楽しむやわらかフィギュアもにまるず！ 「HandMade In Japan Fes 冬(2022) 」に出展します！ 会場：東京ビッグサイト西1・2ホール ブース番号: F-13 出展日:2022年 1月</p>
              </div>
            </section>
            <section class="col-lg-4 col-md-6">
              <img :src="'/img/many_cat3.jpg'" class="news-img d-block w-100">
              <div class="bg-white p-3 news-content">
                <span>2021年11月7日</span>
                <h5>デザインフェスタvol.54出展</h5>
                <p>さわって楽しむやわらかフィギュアもにまるず！デザインフェスタvol.54に出展します！ 会場：東京ビッグサイト西展示棟 全館 ブース番号: E-218,219 出展日:2021年11月13日</p>
              </div>
            </section>
          </div>
          <div class="button_wrapper py-5">
            <button type="button" onclick="location.href='news'" class="btn btn-primary d-inline-block btn-hover w-25">もっと見る</button> 
          </div>    
        </div>
      </article>
      <article>
        <div class="container-fluid mb-5">
          <h2 class="pt-5 pb-4 text-center fw-bold d-block">
            online Store
          </h2>
          <div class="row">
            <div class="col-md-6">
              <a class="d-inline-block"><img :src="'/img/online-store.webp'" class="online-Store-img"></a>
            </div>
            <div class="col-md-6">
              <a class="d-inline-block"><img :src="'/img/LINE-stanp.webp'" class="online-Store-img"></a>
            </div>
          </div>
        </div>
        
      </article>
      <article class="CareANDCleaning">
      </article>
      <article class="collaboration-article">
        <div class="container-fluid">
          <h2 class="text-center pt-4">ITEMS</h2>
          <p class="text-center">キャラクターコラボの「もにまるず 」も制作しています。</p>
          <div class="row">
            <div id="carouselPlus" class="carousel slide multi-carousel py-4 text-center" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-many_cat1 mb-2"></div>
                  <div class="background-many_cat2"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-many_cat3 mb-2"></div>
                  <div class="background-cat1"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-cat2 mb-2"></div>
                  <div class="background-cat3"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-cat4 mb-2"></div>
                  <div class="background-cat5"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-cat6 mb-2"></div>
                  <div class="background-cat7"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-cat8 mb-2"></div>
                  <div class="background-cat9"></div>
                </div>
                <div class="carousel-grid col-lg-4 col-md-6 col-sm-12">
                  <div class="background-cat10 mb-2"></div>
                  <div class="background-cat11"></div>
                </div>
                <a class="carousel-control-prev contents-prev-next" href="#carouselPlus" role="button" data-bs-ride="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next contents-prev-next " href="#carouselPlus" role="button" data-bs-ride="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>      
              </div> 
            </div>
          </div>
          <div id="lg" class="d-none d-lg-block"></div>
          <div id="md" class="d-none d-md-block d-lg-none"></div>
          <div id="sm" class="d-none d-sm-block d-md-none"></div>
          <div class="button_wrapper pt-4 pb-5">
            <button type="button" onclick="location.href='items'" class="btn btn-primary d-inline-block btn-hover w-25">もっと見る</button> 
          </div> 
        </div>     
      </article>
      <!--
      <article>
        <div class="container-fluid">
          <h2 class="text-center">collaboration</h2>
          <div class="row">
            <div>
              
            </div>
          </div>
        </div>
      </article>
      -->
      <article>
        <h2 class="text-center mt-4 mb-2">contact</h2>
        <p class="text-center">お問い合わせ・もにまるずの販売・​コラボ制作依頼は</p>
        <p class="text-center">メール・もしくは以下のフォームからご連絡ください。</p>

        <div class="button_wrapper">
            <section>
                <form>
                    <input placeholder="お名前" class="d-inline-block mb-3 w-25"><br>
                    <input placeholder="メールアドレス" class="d-inline-block mb-3 w-25"><br>
                    <input placeholder="件名" class="d-inline-block mb-3 w-25"><br>
                    <textarea placeholder="メッセージを入力してください。" class="d-inline-block mb-4 w-25"></textarea><br>
                    <button type="submit"  class="btn btn-primary d-inline-block mb-5 btn-hover w-25">送信する</button> 
                </form>
            </section>
        </div> 
      </article>
      <article class="footer-img">
        <div class="ONLINE_STORE_button_wrapper ">
          <button type="button" onclick="location.href='online_store'"  class="btn btn-primary d-inline-block btn-hover w-25">ONLINE STOREを見る</button> 
        </div>
      </article>
</template>
<script>
import $ from "jquery";
export default {
    data() {
    return {
      loading: true,
      errored: false,
      error: false,
    }
  },
    mounuted(){
        $(function(){
            var $origin = $("#carouselPlus.carousel-inner").prop("outerHTML");
            $(window).on( "load resize", function() {
              $( "#carouselPlus.carousel-inner" ).replaceWith( $origin );
              multiCarousel();
            });
            function multiCarousel(){
              if ( $( "#lg" ).is( ":visible" ) ) {
                do {
                  $( "#carouselPlus.carousel-inner" ).children( ".carousel-grid:lt(3)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
                  $( "#carouselPlus.carousel-inner .carousel-item:first" ).addClass("active");
                } while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
              } else if ( $( "#md" ).is( ":visible" ) ) {
                do {
                  $( "#carouselPlus.carousel-inner" ).children( ".carousel-grid:lt(2)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
                  $( "#carouselPlus.carousel-inner .carousel-item:first" ).addClass("active");
                } while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
              } else {
                do {
                  $( "#carouselPlus.carousel-inner" ).children( ".carousel-grid:lt(1)" ).wrapAll( "<div class=\"carousel-item\"><div class=\"row\"></div></div>" );
                  $( "#carouselPlus.carousel-inner .carousel-item:first" ).addClass("active");
                } while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length);
              }
            }
        });
        
    }
};
</script>