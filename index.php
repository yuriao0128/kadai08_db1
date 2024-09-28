<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信画面</title>
    <link rel="stylesheet" href="style.css">
    <!-- googleフォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/ef226e501a.js" crossorigin="anonymous"></script>
    <style>
        /* 初期状態でフォームを非表示にする */
        #post {
            display: none;
        }
    </style>
</head>

<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="#">⚫︎⚫︎××</a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-edit"></i><span class="menu-text"> ⚫︎⚫︎</span></a></li>
                    <li><a href="#" class="new"><i class="fa-solid fa-briefcase"></i><span class="menu-text"> 求人作成・管理</span></a></li>
                    <li><a href="#"><i class="fa-solid fa-user"></i><span class="menu-text"> ⚫︎⚫︎</span></a></li>
                    <li><a href="#"><i class="fa-solid fa-envelope"></i><span class="menu-text"> ⚫︎⚫︎</span></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- 画像をアップロードする時はenctype属性を忘れずに -->
    <form action="write.php" method="post" id="post" enctype="multipart/form-data">
        <h2>求人情報の登録</h2>
        <!-- 複数データを取得する -->
        <p><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> おすすめポイントをタグで登録</p>
        <div class="tag-selection">
            <div class="tag" data-tag="リモートワーク"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> リモートワーク</div>
            <div class="tag" data-tag="時短OK"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 時短OK</div>
            <div class="tag" data-tag="経験者求む"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 経験者求む</div>
            <div class="tag" data-tag="地方創生"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 地方創生</div>
            <div class="tag" data-tag="好きを仕事に"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 好きを仕事に</div>
            <div class="tag" data-tag="残業なし"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 残業なし</div>
            <div class="tag" data-tag="育児なかま就業中"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 育児なかま就業中</div>
            <div class="tag" data-tag="介護なかま就業中"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 介護なかま就業中</div>
            <div class="tag" data-tag="スキルアップ支援"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> スキルアップ支援</div>
            <div class="tag" data-tag="副業応援"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 副業応援</div>
            <div class="tag" data-tag="チャレンジ歓迎"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> チャレンジ歓迎</div>
            <div class="tag" data-tag="スピード昇進"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> スピード昇進</div>
            <div class="tag" data-tag="福利厚生充実"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> 福利厚生充実</div>
            <div class="tag" data-tag="カジュアル応募OK"><i class="fa-solid fa-tag" style="color: #00b8b8;"></i> カジュアル応募OK</div>
        </div>


        <!-- 隠しフィールドで選択したタグをフォームに追加 -->
        <form id="jobForm" method="post">
            <input type="hidden" id="selectedTags" name="selected_tags" value="">


            <div class="form-section">
                <label for="category">職種カテゴリー</label>
                <select id="category" name="category">
                    <option value="">カテゴリを選択してください</option>
                    <option value="営業">営業</option>
                    <option value="事務">事務</option>
                    <option value="システムエンジニア">システムエンジニア</option>
                </select>

                <label for="job-title">職種</label>
                <input type="text" id="job-title" name="job_title" placeholder="職種を入力してください">

                <label for="display-name">表示用職種名</label>
                <input type="text" id="display-name" name="display_name" placeholder="表示名を入力してください">
                <div class="warning">※「表示名職種」にアピールポイントを含めた文言を含めてください</div>
                <br>
            </div>

            <div class="form-section">
                <label for="company-name">法人名（正社名）</label>
                <input type="text" id="company-name" name="company_name" placeholder="会社名を入力してください">
                <div class="warning">※法人名は正式名を記載してください。</div>

                <label for="address">住所</label>
                <input type="text" name="address" placeholder="住所を入力してください" id="address" required><br>

                <label for="description">事業内容</label>
                <textarea id="description" name="description" placeholder="事業内容を入力してください"></textarea>
                <!-- 画像アップロードフィールドを追加 -->
                <label for="image">トップページ画像をアップロード</label>
                <input type="file" name="image" id="image"><br>

            </div>

            <div class="form-section">
                <label for="start_time"></label>
                <select name="start_time" id="start_time" required>
                    <option value="">開始時間</option>
                </select><br>
                <label for="end_time"></label>
                <select name="end_time" id="end_time" required>
                    <option value="">終了時間</option>
                </select><br>

                <label for="salary">月給:</label>
                <input type="text" id="salary" name="salary" placeholder="月給を入力してください"><br>

                <label for="qualifications">応募資格:</label>
                <input type="text" name="qualifications" placeholder="応募資格を入力してください" id="qualifications" required><br>

                <label for="background">募集背景:</label>
                <input type="text" name="background" placeholder="募集背景を入力してください" id="background" required><br>

                <label>雇用形態:</label><br>
                <input type="radio" name="employment_type" value="正社員" required> 正社員<br>
                <input type="radio" name="employment_type" value="契約社員"> 契約社員<br>
                <input type="radio" name="employment_type" value="新卒"> 新卒<br>
                <input type="radio" name="employment_type" value="アルバイト/パート"> アルバイト/パート<br>
                <input type="radio" name="employment_type" value="業務委託"> 業務委託<br>
                <input type="radio" name="employment_type" value="インターンシップ"> インターンシップ<br>

                <label for="job_description">業務内容:</label>
                <textarea name="job_description" id="job_description" placeholder="業務内容を入力してください" rows="5" required></textarea><br>
            </div>


            <div class="btn-container">
                <button type="submit" class="btn-save">入力内容を保存</button>
                <button type="button" class="btn-preview">プレビュー</button>
            </div>
        </form>


        <script src="script.js"></script>
</body>

</html>