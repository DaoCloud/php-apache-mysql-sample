<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h2 class="text-center">各种头像欢迎您的选购</h2>
    <h3 class="text-center" style="color:aquamarine">全透明：1元</h3>
    <h3 class="text-center" style="color:aquamarine">选图半透明：2元</h3>
    <h3 class="text-center" style="color:aquamarine">自带图全透明：3元</h3>
    <H2 class="text-center" style="color:red">注：手机透明 电脑不透明（iOS／Android都透明）3开头的qq也可以做哦！</H2>
    <ul class="main ovh">
    <?php 

for ($i = 1; $i <= 930; $i++) 
{ 
   $str="<li><img src=\"images/loading.gif\" width=\"256\" data-original=\"images/".$i.".png\"></li></br><h4 class="text-center">编号为".$i."号</h4>";
   echo $str;
} 
  ?>
        
             
    </ul>
    <script src="./node_modules/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./node_modules/lazyload/jquery.lazyload.js" type="text/javascript"></script>
    <script>
        $(window).load(
            function(){
                $("img").lazyload({
                    effect: "fadeIn",
                    threshold :250,
                    });
            }
        )
    </script>
</body>
</html>
