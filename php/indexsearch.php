<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once 'DBload.php';

if (isset($_SESSION['id']))
{
    $id=$_SESSION['id'];
    $query = mysqli_query($conn, "SELECT courses.title, videos.Date, videos.VideoLink
                            	    FROM videos, courses,(SELECT CourseID 
                                                            FROM enrollment 
                                                            WHERE FacID='$id') t
                                    WHERE t.CourseID=courses.id AND videos.CourseID=courses.id
                                    AND videos.Date > DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                                    ORDER BY videos.Date DESC");
    
    while($row = mysqli_fetch_array($query))
    {
        echo "<div class='linkbutt'><a class='VideoLinks' href=" . $row['VideoLink'] . " target='_blank'>" . $row['title'] . ", " . $row['Date'] . "</a></div> </br>";
    }
}
?>