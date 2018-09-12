<?php
require("lib/db.php");
require("config/config.php");
$conn = db_init($config['host'], $config['duser'], $config['dpw'], $config['dname']);
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>JavaScript</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist\css\bootstrap.min.css"/>
    </head>
    <body id="target">
        <div class="container">
            <header>
                <img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png"/>
                <h1><a href="index.php">JavaScript</a></h1>
            </header>
            <div class="row">
                <div class="col-sm-4">
                    <nav>
                        <ol id="list">
                            <?php
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<li><a href="index.php?id='.htmlspecialchars($row['id']).'">'.$row['title'].'</a></li>';
                                }
                            ?>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-8">
                    <article>
                        <?php
                            if(empty($_GET['id']) == 0){
                                $id = mysqli_real_escape_string($conn, $_GET['id']);
                                $sql = "SELECT title, user.name, description, created FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$id;
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                echo "<h2>".htmlspecialchars($row['title'])."</h2>";
                                echo "<p>".htmlspecialchars($row['name'])."</p>";
                                echo "<p>".strip_tags($row['description'], '<a><h1><h2><h3><h4><ol><ul><li>')."</p>";
                            }
                        ?>
                    </article>
                    <div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <input type="button" value="white" onclick="document.getElementById('target').className='white'" class="btn btn-secondary"/>
                            <input type="button" value="black" onclick="document.getElementById('target').className='black'" class="btn btn-secondary"/>
                        </div>
                        <a href="write.php" class="btn btn-success">Write</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
