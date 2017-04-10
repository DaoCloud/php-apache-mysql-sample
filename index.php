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
    <h1 class="text-center">测试</h1>
    <ul class="main ovh">
    <?php 

for ($i = 1; $i <= 10; $i++) { 
echo "<li><img src="images/loading.gif" width="256" height="256" data-original="images/$i.png"></li>"; 
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