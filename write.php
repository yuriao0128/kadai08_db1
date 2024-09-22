<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// 入力項目を取得する処理
$display_name = $_POST['display_name'];
$company_name = $_POST['company_name'];
$job_title = $_POST['job_title'];
$salary = $_POST['salary'];
$address = $_POST['address'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$qualifications = $_POST['qualifications'];
$background = $_POST['background'];
$employment_type = $_POST['employment_type'];
$job_description = nl2br($_POST['job_description']); // 改行を<br>に変換
$selected_tags = $_POST['selected_tags']; // フォームからタグを取得


// 画像アップロードの処理ここから
$image_path = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "uploads/"; // 画像を保存するディレクトリ
    if (!is_dir($target_dir)) {
        mkdir($target_dir); // uploadsディレクトリがなければ作成
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 画像ファイルかどうかをチェック
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file; // アップロードされた画像のパスを保存
        } else {
            echo "画像のアップロードに失敗しました。";
        }
    } else {
        echo "ファイルは画像ではありません。";
    }
}
// 画像アップロードの処理ここまで

// 入力項目を取得する処理
$selected_tags = $_POST['selected_tags']; // フォームからタグを取得

// CSVに書き込む
$filename = 'data.csv';
$data = [$display_name, $company_name, $job_title, $salary, $address, $start_time,$end_time, $qualifications, $background, $employment_type, $job_description,$image_path,$selected_tags];
$fp = fopen($filename, 'a');
fputcsv($fp, $data);
fclose($fp);

// 登録完了後にリダイレクト
header('Location: read.php');
exit();

?>