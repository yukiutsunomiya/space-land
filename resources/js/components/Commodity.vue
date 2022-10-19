<template v-for="product in products" :key="product.name">
    <div class="container"> 
      <h3 class="pt-1 mb-4 fw-bold update-information-h3">
        {{}}
      </h3>
      <p>値段：1500円</p>
      <section class="text-center">
        <img :src=" '/img/'+ product.img1" class="about-img">
      </section>
      <section class="pt-4 text-center">  
        <!--
            <dl class="contact7">
        <dt>個数<span class="must">必須</span></dt>
        <dd>[select* your-prefectures first_as_label "選択してください" "1" "2" "3" "4" "5"]<dd>
        <dt>お名前<span class="must">必須</span></dt>
        <dd>[text* your-name placeholder"例：山田　太郎"]</dd>
        <dt>フリガナ<span class="must">必須</span></dt>
        <dd>[text* your-furigana placeholder"例：ヤマダ　タロウ"]</dd>
        <dt>お電話番号<span class="must">必須</span></dt>
        <dd>[tel* your-tel placeholder"例：090-1234-5678"]</dd>
        <dt>メールアドレス<span class="must">必須</span></dt>
        <dd>[email* your-email placeholder"例：abcd@example.jp"]</dd>
        <dt>郵便番号<span class="must">必須</span></dt>
        <dd>[text* your-post_code placeholder"例：123-4567"]</dd>
        <dt>都道府県<span class="must">必須</span>
        [select* your-prefectures first_as_label "選択してください" "北海道" "青森県" "岩手県" "宮城県" "秋田県" "山形県" "福島県" "茨城県" "栃木県" "群馬県" "埼玉県" "千葉県" "東京都" "神奈川県" "新潟県" "富山県" "石川県" "福井県" "山梨県" "長野県" "岐阜県" "静岡県" "愛知県" "三重県" "滋賀県" "京都府" "大阪府" "兵庫県" "奈良県" "和歌山県" "鳥取県" "島根県" "岡山県" "広島県" "山口県" "徳島県" "香川県" "愛媛県" "高知県" "福岡県" "佐賀県" "長崎県" "熊本県" "大分県" "宮崎県" "鹿児島県" "沖縄県"]</dt>
        <dt>ご住所<span class="must">必須</span></dt>
        <dd>[text* your-address placeholder"例：名古屋市中区"]</dd>
        <dt>その他<span class="optional">任意</span></dt>
        <dd>[textarea your-message]</dd>
        </dl>
        <p class="btn_contact7">[submit "この内容で送信する"]</p>
        -->
      </section>
    </div> 
</template>>
<script>
  export default{
    data(){
      return{
        product:[],
      }
    },
    created(){
      this.axios.get('api/commodity?name=${this.$route.query.name}').then(response => {
        this.product = response.data;
        });
    },
  }
</script>
     
