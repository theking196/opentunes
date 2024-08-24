
<?php
session_start();
$loggedin = false;
if (isset($_SESSION['opentube_user'])) {
    $loggedin = $_SESSION['opentube_user'];
}
if ($loggedin) {
    echo <<< HEAD
    <script type='text/javascript'> loggedIn = true </script>
HEAD;
}else {
    echo <<< HEAD
    <script type='text/javascript'> loggedIn = false </script>
HEAD;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to openTube</title>
    <!-- <script src="imp/funcs.js"></script> -->
    <script src="assets/lint/script.js"></script>
    <link rel="icon" href="logo/favicon.png" type="image/png">
</head>
<body ononline="online()" onoffline="offline()">
<?php require 'default/menu.php' ?>
<?php require_once "imp/conn.php"; ?>
    <div class="body">

    </div>
    <?php require "imp/mine.php" ?>
</body>
</html>
<script>
    historys = []
    _incScript("assets/jquery/script.js",function () {
        var loader = new Loader("dark");
        _incScript("script/script.js");
        $.ajax({
            url:"home/index.php",
            storeHistory:true,
            success:function(data){
                $(".body").html(data);
            },
            error:function(jqXHR, textStatus, errorThrown){
                $(".body").html(jqXHR.responseText);
            }
        })
        $(document).ajaxSend(function(event, xhr, settings) {
            // console.log(settings);
                if (settings.loader) {
                    loader.show();
                }
            });
        $(document).ajaxError(function(xhr, textStatus, settings){
            if (settings.handleError) {
                $(".body").html(xhr.responseText);
            }
        });
        $(document).ajaxComplete(function(xhr, textStatus, settings){
            if (settings.storeHistory) {
                historys.push({url:settings.url,data:settings.data});
            }
            console.log(historys);
            // if (settings.loader) {
                loader.hide();
            // }
        });
        if (navigator.onLine) {
            $(".nav .other").append("<i class=\"status fa fa-cloud mx-1\"></i>");
        }else{
            $(".nav .other").append("<i class=\"status fa fa-cloud-bolt mx-1\"></i>");
        }
        $("*").on("contextmenu", function(){
            return false;
        })
    })
    function online() {
        $(".nav .other .status").replaceWith("<i class=\"status fa fa-cloud mx-1\"></i>");
        }
        function offline() {
            // alert("offline")
            $(".nav .other .status").replaceWith("<i class=\"status fa fa-cloud-bolt mx-1\"></i>");
        }
    _incScript("assets/Font-Awesome-6.x/Font-Awesome-6.x/js/all.js")
    _incScript("imp/funcs.js")
    _incStyle("assets/Font-Awesome-6.x/Font-Awesome-6.x/css/all.css")
    _incStyle("assets/bootstrap/style.css")
    _incStyle("style/style.css")
    _incStyle("assets/lint/style.css")
    _incStyle("assets/quill/css/quill.snow.css")
    _incScript("assets/quill/js/quill.min.js")
    // document.onoffline
    
    // async function inputed(params) {
    //     $data = await input("what do you want?");
    //     alerts("Here's your "+$data);
    // }
    // inputed();
</script>