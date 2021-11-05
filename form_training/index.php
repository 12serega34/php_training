<?php
setcookie('test', plus());
/*setcookie(cookieName(), cookieQuantity());
*/
echo " Счетчик посещений сервера/страницы {$_COOKIE['test']}";

function plus(){
    if (isset($_COOKIE['test'])) {
        $_COOKIE['test']++;
    }else{
        $_COOKIE['test'] = 1;
    }
    return $_COOKIE['test'];
}

?>
<!-- С помощью формы спросите город и страну пользователя. После отправки формы выведите введенные данные на экран. Сделайте так, чтобы введенные данные не пропадали из инпутов после отправки формы. -->
<form action="" method="GET">
    <input name="city" value="<?= $_GET['city'] ?? 'default' ?>"></input>
    <input name="country" value="<?= $_GET['country'] ?? 'default'?>"></input>
    <input type="submit">
</form>




<!-- С помощью формы спросите у пользователя год. После отправки определите, этот год високосный или нет. Сделайте так, чтобы при первом заходе на страницу в инпуте уже стоял текущий год. -->
<form action="" method="GET">
    <input name="year" value="<?= $_GET['year'] ?? date(Y); ?>"></input>
    <input type="submit">
</form>




<!-- С помощью трех инпутов спросите у пользователя год, месяц и день. После отправки формы выведите на экран, сколько дней осталось от введенной даты до Нового Года. По заходу на страницу сделайте так, чтобы в инпутах стояла текущая дата. -->
<form action="" method="GET">
    <?php
    if(!isset($_GET['months'])): ?>
        <input name="years" value=" <?= $_GET['years'] ?? date(Y); ?>"></input>
        <input name="months" value=" <?= $_GET['months'] ?? date(m) ?>"></input>
        <input name="days" value=" <?= $_GET['days'] ?? date(d); ?>"></input>

        <input type="submit">

    <?php
    else:	echo ((mktime(0, 0, 0, 1, 1, 2022) - mktime(0,0,0,9,21,2021))/60/60/24) . ' days for new year';
    endif;
    ?>
</form>





<!-- Попросите пользователя оставить отзыв на сайт. После отправки формы выведите этот отзыв на экран. Пусть в textarea вводится русский текст. После отправки формы выведите на экран транслит этого текста. Сделайте так, чтобы содержимое формы сохранялось после отправки.-->
<form action="" method="GET">
    <textarea name="testForm"><?php  if(isset($_GET['testForm']))	echo translit($_GET['testForm']); else echo 'введите слова на русском языке' ?></textarea>
    <input type="submit">
</form>
<?php
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}
?>





<!-- С помощью флажка спросите у пользователя, есть ему уже 18 лет или нет. Если есть, разрешите ему доступ на сайт, а если нет - не разрешите. -->

<?php if(!isset($_GET['flagsy'])){ ?>
    <form action="" method="GET">
        <p>Вам есть 18 лет?</p>
        <input type="hidden" name="flag" value="0">
        <input type="checkbox" name="flag" value="1">Да
        <input type="checkbox" name="flag" value="2">Нет

        <input type="submit">
    </form>
<?php }
else{
    if($_GET['flagsy'] == 1){
        echo 'вам разрешено зайти на сайт';
    }
    else {
        echo 'вам запрещено заходить на сайт';
    }
}
?>






    <!-- Напишите скрипт, который будет преобразовывать температуру из градусов Цельсия в градусы Фарингейта. Для этого сделайте инпут и кнопку -->
    <!--Добавьте функцию по вычислению факториала числа -->
        <form>
            <input type="number" name="farengate" method="GET"></input>
            <input type="submit">
        </form>
<?php
if(isset($_GET)){
    if(!empty($_GET['farengate'])){
        echo $_GET['farengate'] . ' градусов по фаренгейту равно ' . (($_GET['farengate'] - 32)*5/9) . ' градусов цельсия';
        echo '<br>факториал числа ' . $_GET['farengate'] . ' равен ' .  fact($_GET['farengate']);

    }}
function fact($arg){
    $result = 1;
    for($i = 1; $i <= $arg; $i++){
        $result *= $i;
    }
    return $result;
}
?>

<form action="" method="GET">
    <input type="radio" name="radio1" value="1" checked> <!-- сделал один из переключателей включенным по умолчанию -->
    <input type="radio" name="radio1" value="2">
    <input type="radio" name="radio1" value="3">
    <input type="submit">
</form>


<!-- Добавляю поле selected которое, если поле было выбрано, сохраняет выбранное значение -->
<form action="" method="GET">
	<select name="test">
		<option value="1"> <?php
			if (!empty($_GET['test']) and $_GET['test'] === '1') {
				echo 'selected ';
			}
		?>item1</option>
		<option value="2"> <?php
			if (!empty($_GET['test']) and $_GET['test'] === '2') {
				echo 'selected ';
			}
		?>item2</option>
		<option value="3"> <?php
			if (!empty($_GET['test']) and $_GET['test'] === '3') {
				echo 'selected ';
			}
		?>item3</option>
	</select>
	<input type="submit">
</form>


<!-- Добавляю поле radio которое, если поле было выбрано, сохраняет выбранное значение -->

<form action="" method="GET">
    <input type="radio" name="radio" value="1"> <?php
    if (!empty($_GET['radio']) and $_GET['radio'] === '1') {
        echo 'checked';
    }
    ?>
    <input type="radio" name="radio" value="2"> <?php
    if (!empty($_GET['radio']) and $_GET['radio'] === '2') {
        echo 'checked';
    }
    ?>
    <input type="radio" name="radio" value="3"> <?php
    if (!empty($_GET['radio']) and $_GET['radio'] === '3') {
        echo 'checked';
    }
    ?>
    <input type="submit">
</form>