<?php
    require '../check_apikey.php';

    include("resizeImage.php");

    $file = $_FILES['image'];
	$use = $_POST['use'];

	//创建图片存储目录
	if (!is_dir('image/')) mkdir('image/', 0777);

	//检查上传
	switch ($file['error']) {
		case 1:
		case 2:
	    	header("400 Bad Request");
    		$error['error'] = '上传的图片太大';
    		echo json_encode($error);
    		exit;			
			break;
		case 3:
	    	header("400 Bad Request");
    		$error['error'] = '图片上传未完成';
    		echo json_encode($error);
    		exit;
    		break;
		case 4:
	    	header("400 Bad Request");
    		$error['error'] = '没有文件被上传';
    		echo json_encode($error);
    		exit;			
			break;
		case 5:
	    	header("400 Bad Request");
    		$error['error'] = '文件大小为0';
    		echo json_encode($error);
    		exit;			
    		break;
	}

	//检查格式
    $filetype = strtolower(substr($file['name'], strrpos($file['name'], '.')));
    if (!in_array($filetype, array('.jpg', '.png', '.bmp', '.gif', '.jpeg'))) {
    	header("400 Bad Request");
    	$error['error'] = '不支持的格式';
    	echo json_encode($error);
    	exit;
    }

    $filecontents = file_get_contents($file['tmp_name']);
    $image = imagecreatefromstring($filecontents);
    $filename = $use . '_' . md5($filecontents);

    //缩放与存储
    if ($use == 'face') {
    	resizeImage($image, 150, 150, './image/' . $filename, $filetype);
    } elseif ($use == 'normal') {
    	resizeImage($image, 500, 500, './image/' . $filename, $filetype);
    } else {
        header("400 Bad Request");
        $error['error'] = '未知的用途选项';
        echo json_encode($error);
        exit;
    }

    //回复请求
    $response['server'] = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'getImage.php';
    $response['file'] = $filename . $filetype;
    $response['url'] = $response['server'] . '?file=' . $response['file'];
    echo json_encode($response);
?>