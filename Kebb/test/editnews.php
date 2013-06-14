<?php

//include our database connection file
include ('dbconnect.php');
if(isset($_POST['action']) || isset($_GET['action'])) {

	if($_POST['action'] == "doedit") {
		//grab the post vars
		$title = $_POST['title'];
		$id = $_POST['id'];
		$news = $_POST['news'];
		//update the database
		$news = "UPDATE news SET title='$title', news='$news' WHERE id = $id";
		$editnews = mysql_query($news);
		echo ("news edited.");
	}
	//print the news titles, with links to the edit page
	$getnews = mysql_query("select * from `news` ORDER BY id DESC");
	while ($r = mysql_fetch_array($getnews)) {
		extract($r);
		echo ("> <a href=editnews.php?id=$id&action=edit>$title</a><br />");
	}
	echo ("<br /><br />");
	//if we are editing a news item, print the following..
	if($_GET['action'] == "edit") {
		$id = $_GET['id'];
		$getnews = mysql_query("select * from `news` WHERE id=$id");
		while ($r = mysql_fetch_array($getnews)) {
			extract($r);
			//our form
?>
<form action="editnews.php" method="POST">
Title<input type="text" name="title" value="<? echo ($title); ?>" /><br />
News<textarea name="news" rows="6" cols="50"><? echo ($news); ?></textarea>
<input type="submit" value="edit" />
<input type="hidden" name="id" value="<? echo ($id); ?>" />
<input type="hidden" name="action" value="doedit" />
</form>
<?php

		}
	}
} else {
	echo "there is no news to edit.";
}
?>