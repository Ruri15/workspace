<?php
  $htn ='<span class="hatena"></span>';

  $q_ttl_001 = "無い${htn}は振れない";
  $q_opt_001 = array('うめ','うめ2','うめ3');
  $q_ans_001 = "$q_opt_001[0]";

  $question = $_POST['question'];

 if ($question == a) {
   $str = "It is 0";
 }
  ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>クイズ</title>
</head>
<body>

  <p><?php echo $q_ttl_001 ?></p>
  <form method="POST" action="<?php $_SERVER['SCRIPT_NAME']; ?>">
    <label><p><input type="radio" name="question" value="a"> <?php echo $q_opt_001[0] ?></p></label>
    <label><p><input type="radio" name="question" value="b"> <?php echo $q_opt_001[1] ?></p></label>
    <label><p><input type="radio" name="question" value="c"> <?php echo $q_opt_001[2] ?></p></label>
    <button id="submit_001">done</button>
  </form>

<p><?php echo $str ?></p>

<style>
  html,body,h1,h2,p,ul,li {
    margin: 0;
    padding: 0;
  }
  .hatena {
    display: inline-block;
    width: 32px;
    height: 16px;
    border: 1px solid #ccc;
    vertical-align: top;
    margin: 3px;
  }
</style>

<script>
function movePage() {
  console.log('hello');
}
  document.getElementById('submit_001').addEventListener("click",movePage,false);
</script>
</body>
</html>
