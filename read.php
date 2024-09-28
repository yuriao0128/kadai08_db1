
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <?php 
        
    // ファイルを変数に格納し、データを読み取る処理
    $filename = 'data.csv';

    // カードの数をカウントする変数
    $card_count = 0;

    // fopenでファイルを開く（'r'は読み込みモードで開く）
    if (($fp = fopen($filename, 'r')) !== false) {
        // カード生成前にカウントするためのループ
        while (($data = fgetcsv($fp)) !== false) {
            $card_count++;
        }
        // ファイルを閉じる
        fclose($fp);
    }
    ?>

    <div class="read-title">
    <h1>Job Information</h1>
    </div>
    <p class="card_count"><?php echo "{$card_count}件表示"; ?></p>
        

            <?php 
            // ファイルを変数に格納し、データを読み取る処理
            $filename = 'data.csv';

            // カードの数をカウントする変数
            $card_count = 0;

            // fopenでファイルを開く（'r'は読み込みモードで開く）
            if (($fp = fopen($filename, 'r')) !== false) {
                // 1行ずつCSVファイルを読み込んで配列に変換
                while (($data = fgetcsv($fp)) !== false) {
                    echo '<div class="card">';
                    echo '<h2>' . htmlspecialchars($data[0]) . '</h2>'; // 表示名職種

        // 画像がある場合に表示
        if (!empty($data[11])) {
            echo '<img src="' . htmlspecialchars($data[11]) . '" alt="求人画像" style="max-width: 100%; display: block; margin-bottom: 10px;">';
        } 
                    echo '<div class="tags">';
                            // タグを表示
                             echo '<div class="tags read-only">'; // read-onlyクラスを追加

        // 複数データ（値）を1つのカラムに登録　▶︎　カンマ区切りでデータし変換
        if (!empty($data[12])) { // 12番目のカラムがタグ
            $tags = explode(', ', $data[12]); // カンマで区切って配列に変換
            foreach ($tags as $tag) {
                echo '<span class="tag">' . htmlspecialchars($tag) . '</span>';
            }
        }
        echo '</div>';
     echo '</div>';
                    echo '<p><strong style="font-size: 20px; ">' . htmlspecialchars($data[1]) ." / ".htmlspecialchars($data[2]). '</strong></p>'; // 企業名
                    echo '<p><i class="fa-solid fa-yen-sign"  style="color: #00b8b8;"></i>  ' . htmlspecialchars($data[3]) . '</p>'; // 月給
                    echo '<p><i class="fa-solid fa-location-dot" style="color: #00b8b8;"></i> ' . htmlspecialchars($data[4]) . '</p>'; // 住所
                    echo '<p><i class="fa-regular fa-clock"  style="color: #00b8b8;"></i>  ' . htmlspecialchars($data[5]) ."〜". htmlspecialchars($data[6]). '</p>'; // 就業時間
                    echo '<p><i class="fa-solid fa-tag"  style="color: #00b8b8;"></i>  ' . htmlspecialchars($data[7]) . '</p>'; // 募集条件
                    echo '<p><i class="fa-regular fa-heart"  style="color: #00b8b8;"></i>  ' . htmlspecialchars($data[8]) . '</p>'; // 募集背景
                    echo '<p><i class="fa-regular fa-heart"  style="color: #00b8b8;"></i>  ' . htmlspecialchars($data[9]) . '</p>'; // 雇用形態
                    echo '<p><i class="fa-solid fa-briefcase"  style="color: #00b8b8;"></i>'  . htmlspecialchars($data[10]) . '</p>'; //業務内容
                    echo '</div>';

                    $card_count ++;
                }
                // ファイルを閉じる
                fclose($fp);
            } else {
                echo "<p>データが見つかりません。</p>";
            }
             ?>
</div>

<script src="script.js"></script>
</body>
</html>