<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once 'DBload.php';

if (isset($_SESSION['id']))
{
    $id=$_SESSION['id'];
    $query = mysqli_query($conn, "SELECT DISTINCT lecturer
                            	    FROM courses, (SELECT CourseID 
                                                    FROM enrollment 
                                                    WHERE FacID='$id') t
                                    WHERE t.CourseID=courses.id
                                    ORDER BY lecturer");
                                    
    echo "<form class='selform' method='GET'>";
    echo "<select id='droplist' name='lecturer' class='droplist'>";
    echo "<option disabled selected> </option>";

    while($row = mysqli_fetch_array($query))
    {
        $lecturer = str_replace(' ','&nbsp;', $row['lecturer']);
        echo "<option value=" . $lecturer . ">" . $lecturer . "</option>";
    }
    echo "</select> <button type='submit' value='submit'> Go! </button></form>";

    if(isset($_GET['lecturer']))
    {
        $lecturer = htmlentities($_GET['lecturer'], null, 'utf-8');
        $lecturer = str_replace("&nbsp;", " ", $lecturer);
        $lecturer = html_entity_decode($lecturer);

        $query = mysqli_query($conn, "SELECT courses.title, videos.Date, videos.VideoLink
                            	        FROM videos, courses, (SELECT CourseID 
                                                                FROM enrollment 
                                                                WHERE FacID='$id') t
                                        WHERE t.CourseID=courses.id AND videos.CourseID=courses.id
                                        AND courses.lecturer= '$lecturer'
                                        ORDER BY videos.Date DESC");
        
        while($row = mysqli_fetch_array($query))
        {
        echo "<div class='linkbutt'><a class='VideoLinks' href=" . $row['VideoLink'] . " target='_blank'>" . $row['title'] . ", " . $row['Date'] . "</a> </div></br>";
        }
    }
}
?>