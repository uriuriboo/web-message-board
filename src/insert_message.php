<?php





function mbTrim($pString){
    return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
}


$is_valid_author_name = true;
$input_author_name = '';
if (isset($_POST['author_name'])) {
    $input_author_name = mbTrim(str_replace("\r\n", "\n", $_POST['author_name']));
}
else{
    $is_valid_author_name =false;
}

if ($is_valid_author_name && mb_strlen($input_author_name) > 30) {
    $is_valid_author_name = false;
}


$is_valid_message = true;
$input_message = '';
if (isset($_POST['message'])) {
    $input_message = mbTrim(str_replace("\r\n", "\n", $_POST['message']));
}
else {
    $is_valid_message = false;
}

if ($is_valid_message && $input_message === '') {
    $is_valid_message = false;
}

if ($is_valid_message && mb_strlen($input_message) > 1000) {
    $is_valid_message = false;
}

if ($is_valid_author_name && $is_valid_message) {
    if ($input_author_name === '') {
        $input_author_name = '匿名さん';
    }



    $query = 'INSERT INTO posts (author_name, message) VALUES (:author_name, :message)';


    $stmt = $dbh->prepare($query);


    $stmt->bindValue(':author_name', $input_author_name, PDO::PARAM_STR);
    $stmt->bindValue(':message', $input_message, PDO::PARAM_STR);


    $stmt->execute();
}

header('Location: /');
exit();