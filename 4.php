<?php

class News{
    public $db;

    function __construct()
    {
        $this->db = mysqli_connect("localhost","root","@Merdeka1945","db_news");
        if(mysqli_connect_error()){
            echo 'error';
        }
    }

    function index(){
        $hasil = [];
        $data = mysqli_query($this->db, "select * from news n inner join user u on n.user_id = u.id");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }        

        return $hasil;
    }

    function show($id){
        $data = mysqli_query($this->db, "select * from news n inner join user u on n.user_id = u.id where n.id = $id");
        return $data->fetch_array();
    }

    function showByUser($id){
        $data = mysqli_query($this->db, "select * from news n inner join user u on n.user_id = u.id where u.id = $id");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    function getDataUser(){
        $data = mysqli_query($this->db, "select name from user");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    function createUser($name, $email, $role){
        mysqli_query($this->db, "insert into user(name, email, role) values('$name','$email','$role')");
    }
    
    function createNews($title, $image, $deskripsi, $create_time, $user_id){        
        mysqli_query($this->db, "insert into news(title, image, deskripsi, create_time, user_id) values('$title','$image','$deskripsi','$create_time', $user_id)");
    }

    function deleteNews($id){        
        mysqli_query($this->db, "delete from news where id = $id");
    }
}

$news = new News();
// Get all data news
$data = $news->index();
// Get all data user
$user = $news->getDataUser();


if(isset($_GET['action'])){
    
    $action = $_GET['action'];
    if($action == "createUser"){  

        $news->createUser($_POST['name'],$_POST['email'], $_POST['role']);
        header('location:4.php');

    }elseif($action == "createNews"){
        //upload Image
        $uploaddir = 'images/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);

        echo "<p>";

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
        } else {
        echo "Upload failed";
        }

        echo "</p>";
        echo '<pre>';
        echo 'Here is some more debugging info:';
        print_r($_FILES);
        print "</pre>";

        $imageName = $_FILES['image']['name'];
        $thisDay = date("Y-m-d h:i:s");
        
        $news->createNews($_POST['title'], $imageName, $_POST['deskripsi'], $thisDay, $_POST['user_id']);
        header('location:4.php');
    }elseif($action == "delete"){
        
        $news->deleteNews($_GET['id']);
        header('location:4.php');
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD NEWS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_news">&nbsp;Tambah Berita</button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#add_user">&nbsp;Tambah user</button>
            </div>

            <div class="card-body">

            <?php foreach ($data as $key => $value) {  ?>                
            
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <img src="images/<?= $value['image'] ?>" class="rounded" alt="..." width="200" height="250">
                    </div>

                    <div class="col-sm">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="font-weight-bold"><?= strtoupper($value['title']) ?></h1>
                                <label for="" class="font-weight-bold">Created By : <?= $value['name'] ?></label>
                            </div>
                            
                            <div class="card-body">
                                <?= $value['deskripsi'] ?>
                            </div>

                            <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailNews<?= $key ?>">&nbsp;Detail</button>
                            <a href="4.php?action=delete&id=<?= $value[0] ?>" class="btn btn-sm btn-danger">Hapus Berita</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Model Create News -->
                <div class="modal fade" id="detailNews<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Tambah Berita</h4>

                                <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">                
                                <form action="4.php?action=createNews" method="post" enctype="multipart/form-data">
                                                                        
                                    <div class="form-group">
                                        <label class="col-form-label">Title</label>
                                        <input type="text" readonly value="<?= $value['title'] ?>" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Author</label>
                                        <input type="text" class="form-control" readonly value="<?= $value['name'] ?>" id="">
                                    </div>            

                                    <div class="form-group">
                                        <label class="col-form-label">Image</label><br>
                                        <img src="images/<?= $value['image'] ?>" class="rounded" alt="..." width="150" height="150">
                                    </div>                                 

                                    <div class="form-group">
                                        <label class="col-form-label">Deskripsi</label>
                                        <textarea class="form-control" readonly name="deskripsi" rows="6"><?= $value['deskripsi'] ?></textarea>
                                    </div>                    

                            </div>                            
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>

<!-- Model Create User -->
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah User</h4>

                <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">                
                <form action="4.php?action=createUser" method="post">
                    
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <input type="text" name="name" class="form-control" >
                    </div>                    

                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" name="email" class="form-control" >
                    </div>                                 

                    <div class="form-group">
                        <label class="col-form-label">Role</label>
                        <input type="text" name="role" class="form-control" >
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info pull-right btn-save">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Model Create News -->
<div class="modal fade" id="add_news" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Berita</h4>

                <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">                
                <form action="4.php?action=createNews" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-form-label">Author</label>
                        <select name="user_id" class="form-control">
                            <option value="">-Select author-</option>
                            <?php foreach ($user as $key => $value) {?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label">Title</label>
                        <input type="text" name="title" class="form-control" >
                    </div>                    

                    <div class="form-group">
                        <label class="col-form-label">Image</label>
                        <input type="file" name="image" class="form-control" >
                    </div>                                 

                    <div class="form-group">
                        <label class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="5"></textarea>
                    </div>                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info pull-right btn-save">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>