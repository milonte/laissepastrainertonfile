<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Orléans Sabre Laser</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i|Montserrat:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i"
	 rel="stylesheet">
</head>

<body>


    <?php 
    require '../src/filesForm.php';
    $images = array_diff(scandir('upload/'), array('..', '.'));

    if (isset($_POST['delete'])) {
        if (file_exists('upload/' . $_POST['delete'])) {
            unlink('upload/' . $_POST['delete']);
        }
        header("Location: /");
    } ?>
    
    <div class="card-group">

        <?php foreach ($images as $image) : ?>

        <div class="card" style="width: 18rem;">
            <img class="card-img-top img-thumbnail" src="upload/<?= $image ?>" alt="Card image cap">
            <div class="card-body">
                <p class="card-text"><?= $image ?></p>
                <form method="post">
                    <button type="submit" name="delete" value="<?= $image ?>">delete</button>
                </form>
            </div>
        </div>

        <?php endforeach;
        ?>

    </div>
    </body>
</html>