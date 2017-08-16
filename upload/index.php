<?php require_once './functions.php'; ?>
<?php
// если была произведена отправка формы
    if (isset($_FILES['filename'])) {
// проверяем, можно ли загружать изображения
        $check = canUploadimages($upload_images->upload_image,$upload_images);
    }
    $create = '';
// если существуют изображения соответсвующие критериям
    if (isset($upload_images->succes) && (count($upload_images->succes)>0)) {
        $create = makeUpload($upload_images->succes);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Загрузка изображений на сервер</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <div class="container">
        <div class="l-container">
            <span>Вы можете загрузить файлы в формате .png, .jpg, .gif, .jpeg.  </span>
            <span>Одновременно можно загрузить не более <?php echo $upload_images->max_file_uploads; ?> изображений.</span>
            <span>Максимальный размер одного загружаемого файла не должен превышать <?php echo $upload_images->upload_max_filesize; ?>.</span>
            <form action="" enctype="multipart/form-data" method="post">
                <input type="file" id="filename" name="filename[]" class="input_img" data-multiple-caption="{count} files selected" multiple>
                <label for="filename">Открыть</label>
                <input type="submit" value="Загрузить!" class="submit_img">
            </form>
            <span class="notice"><?php echo $check;?></span>
        </div>
        <div class="r-container">
            <div class="b-images">
                <?php echo $create; ?>
            </div>
        </div>
    </div>
    <script>
        var inputs = document.querySelectorAll('.input_img');
        Array.prototype.forEach.call(inputs, function(input){
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener('change', function(e){
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.querySelector( 'span' ).innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
        });
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    </script>
</body>
</html>