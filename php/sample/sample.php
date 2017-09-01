<?php
    session_start();

    function h($s) {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    $quizList = array (
        array(
          'q' => '今学習している言語は？',
          'a' => array ('PHP', 'Java', 'C++', 'Ruby')
        ),
        array(
          'q' => 'スタイルを設定しているのは？',
          'a' => array ('CSS', 'HTML', 'PHP', 'Document')
        ),
        array(
          'q' => 'ウェブサイトを作る基本は？',
          'a' => array ('HTML', 'iOS', 'Windows', 'POST')
        ),
        array(
          'q' => '2ちゃんねるとは？',
          'a' => array ('掲示板', 'コッペパン', 'まな板', '番組')
        )
    );

    function resetSession() {
        $_SESSION['correct_count'] = 0;
        $_SESSION['all_count'] = 0;
        // CSRF対策 tokenの設定
        $_SESSION['token'] = sha1(uniqid(mt_rand(), true));
    }

    function redirect() {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // CSRF対策
        if ($_POST['token'] !== $_SESSION['token']) {
            echo '不正な投稿です！(1)';
            exit;
        }
        if (isset($_POST['reset']) && $_POST['reset'] === '1') {
            resetSession();
            redirect();
        }
      // エラーチェック-入力でqnumが渡されるのでこれのエラーチェック
      // リセットの方が優先されるのでその後に
        if (!isset($_POST['qnum']) || $_SESSION['qnum'] !== $_POST['qnum']) {
            echo '不正な投稿です！(2)';
            exit;
        }
      // エラーチェック-そもそもqnumがquizListに含まれているか
        if (!isset($quizList[$_POST['qnum']])) {
            echo '不正な投稿です！(3)';
            exit;
        }

        if ($_POST['answer'] === $quizList[$_POST['qnum']]['a'][0]) {
            $_SESSION['correct_count']++;
        }
            $_SESSION['all_count']++;
            redirect();
    }

    if (empty($_SESSION)) {
        resetSession();
    }

    $qnum = mt_rand(0, count($quizList)-1);

    $quiz = $quizList[$qnum];

    $_SESSION['qnum'] = (string)$qnum;

    shuffle($quiz['a']);

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charaset ="utf-8">
        <title>簡単クイズ</title>
        <style>
          #answer_row {
            padding: 7px;
            background: #eee;
            border: #ccc;
          }
        </style>
    </head>
    <body>
        <div id="answer_row">
            <?php echo h($_SESSION['all_count']); ?> 問中
            <?php echo h($_SESSION['correct_count']); ?> 問正解！
<!-- 正答率の表示 -->
            <?php if($_SESSION['all_count'] > 0) : ?>
            正答率は <?php echo h( sprintf("%.2f", $_SESSION['correct_count'] / $_SESSION['all_count'] * 100)); ?> % です！
            <?php endif; ?>
        </div>
        <p>Q.<?php echo $quiz['q']; ?></p>
        <?php foreach($quiz['a'] as $answer) : ?>
        <form action="" method="post">
            <input type="submit" name="answer" value="<?php echo h($answer) ?>">
            <input type="hidden" name="qnum" value="<?php echo h($_SESSION['qnum']) ?>">
<!-- CSRF対策 -->
            <input type="hidden" name="token" value="<?php echo h($_SESSION['token']) ?>">
        </form>
        <?php endforeach; ?>
        <hr>
        <form action="" method="post">
            <input type="submit" value="リセット！">
            <input type="hidden" name="reset" value="1">
<!-- CSRF対策 -->
            <input type="hidden" name="token" value="<?php echo h($_SESSION['token']) ?>">
        </form>
    </body>
</html>
