<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=bc_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DB_CONECT'.$e->getMessage());
// }

// function db_conn(){
try {
      // db_name, db_host, db_id, db_pwをご自身のものに書き換えて使用して下さい
$db_name =  'beshift_bc_db';            //データベース名 
        $db_host =  'mysql80.beshift.sakura.ne.jp';  //DBホスト
        $db_id =    '***';          //アカウント名(登録しているドメイン)　
        $db_pw =    '***';           //さくらサーバのパスワード 
        //下2段：データベースのidとpwでも検証済み
        
        $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
        $pdo = new PDO($server_info, $db_id, $db_pw);
        // return $pdo;

    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }


    // kadai08 検索窓によるデータ取得　はじまり
    // 検索キーワードを取得
    $search_keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

    // SQLクエリ作成
    if ($search_keyword) {
        // 検索キーワードがある場合、職種で検索
        $sql = "SELECT * FROM gs_bm_table WHERE job_title LIKE :search"; //LIKEは部分一致選択
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search_keyword . '%', PDO::PARAM_STR);  //%は部分一致表記
    } else {
        // 検索キーワードがない場合、全データを取得
        $sql = "SELECT * FROM gs_bm_table";
        $stmt = $pdo->prepare($sql);
    }
    $status = $stmt->execute();

    if($status==false) {
        $error = $stmt->errorInfo();
        exit("SQL_ERROR:".$error[2]);
    }

    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // kadai08 検索窓によるデータ取得　おわり

// }

// PDOオブジェクトを取得
// $pdo = db_conn();
  
//２．データ登録SQL作成
// $sql = "SELECT * FROM gs_bm_table";
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute(); //true or false

//３．データ表示
// if($status==false) {
  //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("SQL_ERROR:".$error[2]);
// }

//全データ取得
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ一覧</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"> <!-- 外部CSSを読み込む -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/ef226e501a.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="user-header">
    <div class="user-container">
        <div class="user-logo">
            <a href="#">⚫︎⚫︎××</a>
        </div>
        <nav class="user-nav">
            <ul class="nav-menu">
                <li><a href="#"><i class="fa fa-home"></i> <span>ホーム</span></a></li>
                <li><a href="#"><i class="fa fa-heart"></i> <span>いいね</span></a></li>
                <li><a href="#"><i class="fa fa-briefcase"></i> <span>オファー</span></a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> <span>メッセージ</span></a></li>
                <li><a href="#"><i class="fa fa-bars"></i> <span>メニュー</span></a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="read-title">
    <h1>Job Information</h1>
</div>

<!-- kadai08_検索窓追加　▶︎ DBからデータ取得　はじまり -->

<div class="search-container contact-form">
    <form method="GET" action="select.php" class="search-form">
        <input type="text" name="search" placeholder="職種を検索" class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
    </form>
</div>

<!-- kadai08_検索窓追加　▶︎ DBからデータ取得　おわり -->


<p class="card_count"><?php echo count($values) . "件表示"; ?></p>

<div class="card-container">
    <?php 

    $filename = 'data.csv';
    $tags = [];
if (($fp = fopen($filename, 'r')) !== false) {
    while (($data = fgetcsv($fp)) !== false) {
        $tags[] = $data[0]; // CSVの最初のカラムからタグを取得
    }
    fclose($fp);
}

    // データベースから取得した値を表示する処理
    foreach ($values as $value) {
        echo '<div class="card">';
        echo '<h2>' . htmlspecialchars($value['job_title']) . '</h2>'; // 表示名職種

        // 画像がある場合に表示
        if (!empty($value['image_path'])) {
            echo '<img src="' . htmlspecialchars($value['image_path']) . '" alt="求人画像" style="max-width: 100%; display: block; margin-bottom: 10px;">';
        }

        // タグを表示
        echo '<div class="tags read-only">';
        if (!empty($value['selected_tags'])) {
            $tags = explode(', ', $value['selected_tags']); // カンマで区切って配列に変換
            foreach ($tags as $tag) {
                echo '<span class="tag">' . htmlspecialchars($tag) . '</span>';
            }
        }
        echo '</div>';

        echo '<p><strong style="font-size: 20px;">' . htmlspecialchars($value['company_name']) . '</strong></p>'; // 企業名
        echo '<p><i class="fa-solid fa-yen-sign" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['salary']) . '</p>'; // 月給
        echo '<p><i class="fa-solid fa-location-dot" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['address']) . '</p>'; // 住所
        echo '<p><i class="fa-regular fa-clock" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['start_time']) . "〜" . htmlspecialchars($value['end_time']) . '</p>'; // 就業時間
        echo '<p><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['qualifications']) . '</p>'; // 募集条件
        echo '<p><i class="fa-regular fa-heart" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['background']) . '</p>'; // 募集背景
        echo '<p><i class="fa-regular fa-heart" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['employment_type']) . '</p>'; // 雇用形態
        echo '<p><i class="fa-solid fa-briefcase" style="color: #00b8b8;"></i> ' . htmlspecialchars($value['job_description']) . '</p>'; // 業務内容
        echo '</div>';
    }
    ?>
</div>

<script src="script.js"></script>
</body>
</html>
