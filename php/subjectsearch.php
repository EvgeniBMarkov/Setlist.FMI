<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once 'DBload.php';

if (isset($_SESSION['id']))
{
    $id=$_SESSION['id'];
    $query = mysqli_query($conn, "SELECT DISTINCT title
                            	    FROM courses, (SELECT CourseID 
                                                    FROM enrollment 
                                                    WHERE FacID='$id') t
                                    WHERE t.CourseID=courses.id
                                    ORDER BY title");
    echo "<form class='selform' method='GET'>";
    echo "<select id='droplist' name='subject' class='droplist'>";
    echo "<option disabled selected> </option>";

    while($row = mysqli_fetch_array($query))
    {
        $title = str_replace(' ','&nbsp;', $row['title']);
        echo "<option value=" . $title . ">" . $title . "</option>";
    }
    echo "</select> <button type='submit' value='submit'> Go! </button></form>";

    if(isset($_GET['subject']))
    {
        $title = htmlentities($_GET['subject'], null, 'utf-8');
        $title = str_replace("&nbsp;", " ", $title);
        $title = html_entity_decode($title);

        $query = mysqli_query($conn, "SELECT courses.title, videos.Date, videos.VideoLink
                            	        FROM videos, courses, (SELECT CourseID 
                                                                FROM enrollment 
                                                                WHERE FacID='$id') t
                                        WHERE t.CourseID=courses.id AND videos.CourseID=courses.id
                                        AND courses.title= '$title'
                                        ORDER BY videos.Date DESC");
        
        while($row = mysqli_fetch_array($query))
        {
        echo "<div class='linkbutt'><a class='VideoLinks' href=" . $row['VideoLink'] . " target='_blank'>" . $row['title'] . ", " . $row['Date'] . "</a></div> </br>";
        }
    }
}


?>