@include('components.adminHeader')
<main>
    <div class="container my-5">
        <h3 class="mb-4">商品登録</h3>
        <div>
            <form method="get" action="../admin/productRegistrationConfirmation">
                @csrf
                <p>商品名：<input type="text" value="" name="name" class="w-25"></p>
                <p>値段：<input type="text" value="" name="price">　円</p>
                <p>メイン写真：<input type="file" name="img1"></p>
                <p>サブ写真：<input type="file" name="img2"></p>
                <p>商品説明：<br><textarea name="description" rows="5" cols="60" placeholder=""></textarea></p>
                <p>販売年：<input type="number" name="releaseYear">年</p>
                <label for="releaseMonth" class="">販売月：</label>
                <select name="releaseMonth" id="releaseMonth">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>　月<br>
                <label for="releaseData" class="my-3">販売月：</label>
                <select name="day" id="releaseData">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>　日<br>
                <label for="situation" class="mb-2">販売状況：</label>
                <select name="situation" id="situation">
                    <option value="販売前">販売前</option>
                    <option value="販売前（ユーザーに非表示にする）">販売前（ユーザーに非表示にする）</option>
                    <option value="販売中">販売中</option>
                    <option value="販売中止（ユーザーに非表示にする）">販売中止（ユーザーに非表示にする）</option>
                </select><br>
                <!--<password></password>-->
                <button type="submit" class="btn btn-primary d-inline-block mt-2 btn-hover w-25" onclick="return confirm('商品を登録してもよろしいでしょうか。')" >商品登録</button>
            </form>
        </div>
    </div>
</main>
@include('components.footer')