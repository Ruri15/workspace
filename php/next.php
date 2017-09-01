<?php
$question = $_POST['question'];

if ($question == 0) {
  $str = "It is 0";
}

  $htn ='<span class="hatena"></span>';
  $list = array(
    array(
      'Q' => "1項目め",
      'A' => array('PHP', 'Java', 'Ruby')
  ),
    array(
      'Q' => "2項目め",
      'A' => array('PHP', 'Java', 'Ruby')
    )
  );
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>クイズ</title>
</head>
<body>
<?php
  echo($list[0]);
 ?>

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
</body>
</html>
