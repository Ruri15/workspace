<?php

// 問題を定義
$question = array(
    "question" => "日本で2番目に高い山は?",
    "choices"  => array("富士山","北岳","槍ヶ岳","恵那山"),
    "answer"   => "北岳",
);

// 出題順をシャッフル
shuffle($question['choices']);

// 回答があった時
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['answer'])) {

    // 答え合わせ
    $result = "不正解でした...残念！";
    if ($_POST['answer'] == $question['answer']) {
        $result = "正解です...完璧！";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>クイズ</title>
    </head>
    <body>
        <form action="" method="post">
            <p>問題: <?php echo $question['question']; ?></p>
            <ul>
                <?php foreach ($question['choices'] as $choises) : ?>
                <li><input type="radio" name="answer" value="<?php echo $choises; ?>"><?php echo $choises; ?></li>
                <?php endforeach; ?>
            </ul>
            <input type="submit" value="回答">
        </form>
        <?php if(isset($result)) : ?>
        <p><?php echo $result ?></p>
        <?php endif; ?>
    </body>
</html>
