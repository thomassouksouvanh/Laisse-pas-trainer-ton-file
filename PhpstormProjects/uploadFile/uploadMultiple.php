
<a class="nav-link" href="index.php">Reload <span class="sr-only"></span></a><?php

//section to create the updating pictures
if (!empty($_FILES['files']['name'][0])) {
    $files = $_FILES['files'];
    $uploaded = [];
    $failed = [];
    $allowed = ['jpg', 'png', 'gif'];

    foreach ($files['name'] as $position => $file_name) {

        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if (in_array($file_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size <= 2097152 && $file_size > 0) {
                    $fileNameNew = uniqid('image', true) . '.' . $file_ext;
                    $fileDestination = 'uploads/' . $fileNameNew;

                    if (move_uploaded_file($file_tmp, $fileDestination)) {
                        $uploaded[$position] = $fileDestination;
                    } else {
                        $failed[$position] = "[{$file_name}] failed to upload";
                    }
                } else {
                    $failed[$position] = "[{$file_name}] is too large";
                }
            } else {
                $failed[$position] = "[{$file_name}] errored with code {$file_error}";
            }
        } else {
            $failed[$position] = "[{$file_name}] file extension {$file_ext} is not allowed";
        }
        //print_r($file_ext);
    }

    if (!empty($uploaded)) {
        //print_r($uploaded);
    }

    if (!empty($failed)) {
        //print_r($failed);
    }
}

//section to delete pictures

if(!empty($_POST['filename'])){
    $file = $_POST['filename'];
    $path = "uploads/$file";
    if(file_exists($path)){
        unlink($path);
    }
}


$directoryPath = 'uploads/';
if (is_dir($directoryPath)) {
    $files = scandir($directoryPath);

    foreach ($files as $key => $file) {
        if (strlen($file) > 5) {
            echo "<div class=\"card\" style=\"width: 8rem;\">
  <img src=\"uploads/$file\" class=\"card-img-top\" alt=\"...\">
  <div class=\"card-body\">
    <h5 class=\"card-title\">$file</h5>
    <form action='uploadMultiple.php' method='POST'>
    <button type='submit' name='filename' value='$file' class=\"btn btn-primary\">Delete</button>
    </form>
    
  </div>
</div>";
        }
    }
};
if (!empty($_GET['delete']) && strlen($_GET['delete'] > 1)) {
    unlink($file);
}
