<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>          
        <link href="./css/styles.css" rel="stylesheet">
        <title>Лекции@FMI</title>
    </head>
<body>
    <header>
        <div class="loglink">
            <?php 
            if(isset($_SESSION['username']))
            {
                echo "<p class='name' >".$_SESSION['username']."</p> <a class='log' href='php/logout.php'> Logout </a>";
            }

            else
            {
                echo "<a class='log' href='login.html'> Login </a>";
            }
            ?>
        </div>
        <div class="container">
            <nav>
                <ul>
                    <li><a class="logo" href="index.php">SetList.FMI</a></li>
                    <li><a href="subjects.php">Subjects</a></li>
                    <li><a href="lecturers.php">Lecturers</a></li>
                    <?php 
                    if(isset($_SESSION['id']))
                    {
                        if($_SESSION['id']==1) {echo "<li><a href='addclip.php'>Add Clip</a></li>";}
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <p class="subtitle">Subjects</p>
    <?php
    include './php/subjectsearch.php';
    ?>
</body>
</html> 