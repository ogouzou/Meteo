<?php
$status="";
$msg="";
$city="";
$temp_fah="";
if(isset($_POST['submit'])){
    $city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&lang=fr&appid=ccaba6c274e9b9e32c0d7f64e5faed19";
    
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
}
?>
<?php 

$fahrenheit="";
if(isset($_POST['bouton'])) {
$city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&units=imperial&lang=fr&appid=ccaba6c274e9b9e32c0d7f64e5faed19";
    
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $fahrenheit="yes";
    }else{
        $msg=$result['message'];
    }
} 
?>

<html lang="fr" class=" -webkit-">
   <head>
      <meta charset="UTF-8">
      
        <link rel="stylesheet" href="style.css">
        <title>Meteo</title>
   </head>
   
   <body>
       <h1>Météo du jour à <strong><?php echo $city; ?></strong></h1>
      <div class="form">

         <form style="width:100%;" method="post">
        
            <input type="text" class="text" placeholder="Enter city name" name="city" value="<?php echo $city?>"/>
            <input type="submit" value="Valider" class="submit" name="submit"/>
            <button id="refresh" onclick="document.location.reload(false)"> Actualiser </button>
            <input type="submit" name="bouton" value="Temperature en °Fahrenheit">
            <?php echo $msg?>
         </form>
        
      </div>
      
      <?php if($status=="yes" or $fahrenheit=="yes"){?>
      <article class="widget">
         <div class="weatherIcon">
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png"/>
         </div>
         <div class="weatherInfo">
            <div class="temperature">
               <span>
                   Temperature: <?php echo round($result['main']['temp'])?>° </br> Ressenti: <?php echo round($result['main']['feels_like'])?>° 
              </span>
            </div>
            <div class="description">
               <div class="weatherCondition"><?php echo $result['weather'][0]['main']?></div>
               <div class="place"><?php echo $result['name']?></div>
            </div>
         </div>
         
      </article>
      <?php } ?>
   </body>
</html>