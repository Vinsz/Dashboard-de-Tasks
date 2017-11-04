<!DOCTYPE html>
<head>
    <meta charset="utf-8" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="./js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="./js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="./js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="./js/fileinput.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./themes/fa/theme.js"></script>
    <script src="./js/locales/<lang>.js"></script>
</head>
<html>
<body>    

<?php
//Include GP config file && User class
include_once 'loginGoogle/gpConfig.php';
include_once 'loginGoogle/User.php';

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render facebook profile data
    if(!empty($userData)){
        $output = '<div class="container"><h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="150" height="150">';
        $output .= '<br/><label class="form-check-label" >Google ID :</label> ' . $userData['oauth_uid'];
        $output .= '<br/><label class="form-check-label" >Name : </label>' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/><label class="form-check-label" >Email : </label>' . $userData['email'];
        $output .= '<br/><label class="form-check-label" >Gender : </label>' . $userData['gender'];
        $output .= '<br/><label class="form-check-label" >Locale : </label>' . $userData['locale'];
        $output .= '<br/><label class="form-check-label" >Logged in with : </label>Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 
        $output .= '<br><br><br><a href="tasks.php"><button class="btn btn-primary"> Ir para Dashboard de Tasks!</button></a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="loginGoogle/images/glogin.png" alt=""/></a>';
}
?>

<div><?php echo $output; ?></div>
</body>
</html>
