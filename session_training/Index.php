<?php
session_start();


//Добавляю счетчик секунд, проведенных на сайте
if(isset($_SESSION['time'])){
    echo 'вы провели на этом сайте ' . (time() - $_SESSION['time']) . ' секунд';
}else{
    $_SESSION['time'] = time();
}



/*Запишите в куку момент времени захода пользователя на страницу. При обновлении страницы выведите на экран, сколько времени прошло с момента первого захода на страницу.*/

if(isset($_COOKIE['timeEnteringPage'])){
    echo '<br>вы провели на странице ' . (time() - $_COOKIE['timeEnteringPage']);
}else{
    setcookie('timeEnteringPage', time(), time()+60); //время жизни этой куки составляет 60 секунд
    $_COOKIE['timeEnteringPage'] = time();
}
setcookie('month', 'пример куки', time()+60*60*24*31);