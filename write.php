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

// CSVに書き込む  START　▶︎　タグのみcsv
$filename = 'data.csv';
$data = [$selected_tags];
$fp = fopen($filename, 'a');
fputcsv($fp, $data);
fclose($fp);
// CSVに書き込む　END



// 2．DB接続（PHP08課題）START
//PDO php datebase object
// try {
//     //Password:MAMP='root',XAMPP=''　MAMP = パスワードがroot
//     $pdo = new PDO('mysql:dbname=beshift_bc_db;charset=utf8;host=mysql80.beshift.sakura.ne.jp','beshift_bc_db','Aa846251'); //rootは固定　サクラの時は変更が必要！ 'パスワード入れる'
//   } catch (PDOException $e) {
//     exit('DB_CONECT:'.$e->getMessage()); //エラーが表示される
//     // DB_CONECTは自分で把握をするための文字、なくてもOK
//     // exitを使うとここで止める
//   }

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
// }
  
  //３．データ登録SQL作成 ここで初めてSQLが設定される！
  $sql = "INSERT INTO gs_bm_table(id,display_name,company_name,job_title,salary,address,start_time,end_time,qualifications,background,employment_type,job_description,image_path,selected_tags)
VALUES(NULL,:display_name,:company_name,:job_title,:salary,:address,:start_time,:end_time,:qualifications,:background,:employment_type,:job_description,:image_path,:selected_tags)";

  $stmt = $pdo->prepare($sql); 
  $stmt->bindValue(':display_name', $display_name, PDO::PARAM_STR); 
  $stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR); 
  $stmt->bindValue(':job_title', $job_title, PDO::PARAM_STR); 
  $stmt->bindValue(':salary', $salary, PDO::PARAM_INT); 
  $stmt->bindValue(':address', $address, PDO::PARAM_STR); 
  $stmt->bindValue(':start_time', $start_time, PDO::PARAM_STR); 
  $stmt->bindValue(':end_time', $end_time, PDO::PARAM_STR); 
  $stmt->bindValue(':qualifications', $qualifications, PDO::PARAM_STR); 
  $stmt->bindValue(':background', $background, PDO::PARAM_STR); 
  $stmt->bindValue(':employment_type', $employment_type, PDO::PARAM_STR); 
  $stmt->bindValue(':job_description', $job_description, PDO::PARAM_STR); 
  $stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR); 
  $stmt->bindValue(':selected_tags', $selected_tags, PDO::PARAM_STR); 
  
  $status = $stmt->execute(); //ここで初めてSQLが設定される！ true or false
  
  //４．データ登録処理後
  if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL:ERROR:".$error[2]); //2列目が認識できるエラー
  }else{
    //５．index.phpへリダイレクト
    header("Location: index.php"); //必ずLは大文字、半角もいれて
    exit();
  }
  ?>
 <!-- DB接続（PHP08課題）END -->
