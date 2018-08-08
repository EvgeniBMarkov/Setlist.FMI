<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

function checkURL($url)
{
    $url_headers = @get_headers($url);
    if(!$url_headers || $url_headers[0] == 'HTTP/1.1 404 Not Found') 
    {
        return false;
    }
    else 
    {
        if (strpos($url, 'youtube.com/watch?v=') == false) 
        {
            return false;
        }
    }
    return true;
}

$id=$_SESSION['id'];

include_once 'DBload.php';

if(isset($_GET['discipline']) && checkURL($_GET['link']))
    {
        $discipline = htmlentities($_GET['discipline'], null, 'utf-8');
        $discipline = str_replace("&nbsp;", " ", $discipline);
        $discipline = html_entity_decode($discipline);

        $link = $_GET['link'];

        $query = mysqli_query($conn, "SELECT id
                        	            FROM courses
                                        WHERE title = '$discipline' ");

        $row = mysqli_fetch_array($query);

        $courseID = $row['id'];

        $query = mysqli_query($conn, "INSERT INTO `videos`(`VideoLink`, `CourseID`, `Date`) 
        VALUES ('$link', '$courseID' , DEFAULT)");

        header("Location: ./index.php?upload=true");
        exit();
    }


$query = mysqli_query($conn, "SELECT DISTINCT title
                        	    FROM courses, (SELECT CourseID 
                                                FROM enrollment 
                                                WHERE FacID='$id') t
                                WHERE t.CourseID=courses.id
                                ORDER BY title");
                   
echo "<form method='GET'>";
echo "<select id='droplist' name='discipline' class='droplist'>";
echo "<option disabled selected>Select discipline </option>";

while($row = mysqli_fetch_array($query))
{
    $title = str_replace(' ','&nbsp;', $row['title']);
    echo "<option value=" . $title . ">" . $title . "</option>";
}

echo "</select>";
echo "<input type='text' name='link' class='linkin' placeholder='Input Youtube link'>";
echo "<button type='submit' value='submit'> Send </button></form>";

?>