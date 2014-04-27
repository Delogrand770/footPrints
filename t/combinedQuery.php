<?php
/**
 * Performs a combined twitter and instagram search.
 */
session_start();
require_once('combinedConfig.php');
$_SESSION['twitter'] = false;
$_SESSION['instagram'] = false;

$error_params = "?error=";

if ($_POST['twitterQuery']){
	$_POST['twitterQuery'] = strtolower($_POST['twitterQuery']);

	/* Load required oauth library */
	require_once('twitteroauth/twitteroauth.php');

	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_SECRET);

	/* Send API call and store result */
	$result = $connection->get('statuses/user_timeline', array('screen_name' => $_POST['twitterQuery'], 'trim_user' => 1, "count" => 200));
	$arr = json_decode($result, true);
	$_SESSION['twitterResult'] = $result;

	/* Ensure the result came back before setting the twitter flag to true */
	if (empty($arr['errors'])){
		$_SESSION['twitter'] = true;
	} else {
		$error_params .= "Twitter: bad query result - (" . $arr['errors'][0]['message'] . ")<br>";
	}
}

if ($_POST['instagramQuery']){
	$_POST['instagramQuery'] = strtolower($_POST['instagramQuery']);
	/* Send API call and store result. Here we are searching for users with a username*/
	$result = file_get_contents('https://api.instagram.com/v1/users/search?q=' . $_POST['instagramQuery'] . '&access_token=' . INSTAGRAM_ACCESS_TOKEN);
	$arr = json_decode($result, true);

	/* Error check */
	if ($arr['meta']['error_type'] == '' && $arr['data'][0] != ''){
		/* Convert result to a searchable object */
		$arr = json_decode($result, true);

		/* Search the json object for an exact matching username and then use the id attached to the username to perform the search */
		for($i = 0; $i < count($arr['data']); $i++) {
			if (strcmp($_POST['instagramQuery'], $arr['data'][$i]['username']) == 0){
				/* Perform the query with the userid */
				$result = file_get_contents('https://api.instagram.com/v1/users/' . $arr['data'][$i]['id'] . '/media/recent/?access_token=' . INSTAGRAM_ACCESS_TOKEN);
				$arr = json_decode($result, true);		
				$_SESSION['instagramResult'] = $result;
			}
		}

		/* Error check before setting the instagram flag to true */
		if ($arr['meta']['error_type'] == '' && $arr['data'][0] != ''){
			$_SESSION['instagram'] = true;
		} else {
			$error_params .= "Instagram: bad query result - (" . $arr['meta']['error_type'] .")<br>";
		}
	}else{
		$error_params .= "Instagram: invalid username - (" . $arr['meta']['error_type'] .")<br>";
	}
}

header("location:combinedResult.php" . $error_params);
exit;