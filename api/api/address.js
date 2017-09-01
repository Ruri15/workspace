//ボタンクリック時にJSONデータを読み込む
  var btn = document.getElementById('btn');

  btn.addEventListener('click',function() {
    var postcode = document.getElementById('postcode');
    var pref = document.getElementById('pref');
    var city = document.getElementById('city');
    var address = document.getElementById('address');

    var script = document.createElement('script');

//テキストボックスに入力された番号をURLに追加
    script.src = "http://zipcloud.ibsnet.co.jp/api/search?zipcode=" + postcode.value + "&callback=jsonData";
    document.body.appendChild(script);
    document.body.removeChild(script);
  })

//コールバックされたJSONデータ取得
function jsonData(data) {
//取得したデータをHTML要素に代入
  pref.value = data.results[0].address1;
  city.value = data.results[0].address2;
  address.value = data.results[0].address3;
}
