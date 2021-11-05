<?php
class Tag{
    private $name;
    private $attrs = [];
    private $text = '';

    public function __construct($name){
        $this->name = $name;
    }

    public function setAttr($name, $attr = true){
        $this->attrs[$name] = $attr;
        return $this;
    }

    public function setAttrs($attrs)
    {
        foreach($attrs as $key => $value){
            $this->setAttr($key, $value);
        }
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function removeAttr($name)
    {
        if(isset($this->attrs[$name])){
            unset($this->attrs[$name]);
            return $this;
        }
        return false;
    }

    public function removeClass($name)
    {
        if(isset($this->attrs['class'])){
            $arr = explode(' ', $this->attrs['class']);
            if(in_array($name, $arr)){
                $arr = $this->removeElem($name, $arr);
                $this->attrs['class'] = implode(' ', $arr);
            }

        }
        return $this;
    }
    private function removeElem($name, $arr){
        $num = array_search($name, $arr);
        array_splice($arr, $num, 1);
        return $arr;
    }

    public function addClass($className)
    {
        if(isset($this->attrs['class'])){
            $classNames = explode(' ', $this->attrs['class']);
            if(!in_array($className, $classNames)){
                $classNames[] = $className;
                $this->attrs['class'] = implode(' ', $classNames);
            }
        }
        else{
            $this->attrs['class'] = $className;
        }
        return $this;
    }
    public function open()
    {
        $name = $this->name;
        $attrs = $this->getAttrsStr($this->attrs);

        return "<$name $attrs>";
    }
    public function close(){
        $name = $this->name;
        return "</$name>";
    }

    public function show()
    {
        return $this->open() . $this->text . $this->close();
    }

    public function img($name): string
    {
        $name = $this->name;
        return "<img alt='' src =\"$name\">";
    }

    public function header($text){
        return "<header>$text</header>";
    }

    private function getAttrsStr($attr){
        if(!empty($attr)){
            $result = '';
            foreach($attr as $k => $v){
                if($v === true){
                    $result.= "$k";
                }else{
                    $result.= "$k=\"$v\"";
                }
            }
            return $result;
        }else{
            return '';
        }
    }
    public function getName(){
        return $this->name;
    }
    public function getText(){
        return $this->text;
    }

    public function getAttrs(){

        return $this->attrs;
    }
    public function getAttr($text){
        if(isset($this->attrs[$text])){
            return $this->attrs[$text];
        }
        return null;
    }
}

class Image extends Tag{
    public function __construct(){
        $this->setAttr('src', '');
        $this->setAttr('alt', '');
        parent::__construct('img');
    }
    public function __toString(){
        return parent::open();
    }
}




class Link extends Tag{
    const ACTIVE = 'active';

    public function __construct(){
        $this->setAttr('href', '');
        parent::__construct('a');
    }

    public function open(){
        $this->activateSelf();
        return parent::open();
    }

    public function activateSelf(){
        if($this->getAttr('href') === $_SERVER['REQUEST_URI']){
            $this->addClass(self::ACTIVE);
        }else{
            $this->removeClass(self::ACTIVE);
        }
    }
}
$link = new Link;
$link1 = $link->setAttr('href', '/trainingOnCodemy/1.php')->open();
$link2 = $link->setAttr('href', '/trainingOnCodemy/2.php')->open();
$link3 = $link->setAttr('href', '/trainingOnCodemy/3.php')->open();
$link4 = $link->setAttr('href', '/trainingOnCodemy/4.php')->open();
$link5 = $link->setAttr('href', '/trainingOnCodemy/5.php')->open();
echo $link->getAttr('href');

class ListItem extends Tag //класс ListItem по умолчанию содержит name = 'li' и может содержать(если добавить через метод) text = 'любой текст'

{
    public function __construct()
    {
        parent::__construct('li');
    }
}

class HtmlList extends Tag
{
    private $items = []; //содержит все, что содержалось в классе ListItem (обязательное name = li и дополнительное text = 'любой текст')

    public function addItem(ListItem $li)
    {
        $this->items[] = $li; // добавляем в $items все данные из class ListItem
        return $this; 			//возвращаем $this
    }

    public function show()
    {
        $result = $this->open(); //$name = $this->name; - $result хранит теперь <ul>, который мы задали в $list = new HtmlList('ul');

        foreach ($this->items as $item) {
            $result .= $item->show();
        }

        $result .= $this->close(); //добавляет закрывающий тег </ul>

        return $result;
    }
    public function __toString(){
        $result = $this->open(); //$name = $this->name; - $result хранит теперь <ul>, который мы задали в $list = new HtmlList('ul');

        foreach ($this->items as $item) {
            $result .= $item->show();
        }

        $result .= $this->close(); //добавляет закрывающий тег </ul>

        return $result;
    }
}
class Ul extends HtmlList{
    public function __construct(){
        parent::__construct('ul');
    }
}
class Ol extends HtmlList{
    public function __construct(){
        parent::__construct('ol');
    }
}

class Form extends Tag{
    public function __construct(){
        parent::__construct('form');
    }
}
class Input extends Tag
{
    public function __construct(){
        parent::__construct('input');
    }
    public function open(){
        $inputName = $this->getAttr('name');

        if($inputName){
            if(isset($_REQUEST[$inputName])){
                $value = $_REQUEST[$inputName];
                $this->setAttr('value', $value);
            }
        }

        return parent::open();
    }
    public function __toString(){
        return $this->open();
    }
}
class Submit extends Input{
    public function __construct(){
        $this->setAttr('type', 'submit');
        parent::__construct();
    }
}
class Password extends Input{
    public function __construct(){
        $this->setAttr('type', 'password');
        parent::__construct();
    }
}

class Hidden extends Input{
    public function __construct(){
        $this->setAttr('type', 'hidden');
        parent::__construct();
    }
}

class Textarea extends Tag{
    public function __construct(){
        parent::__construct('textarea');
    }
    public function open(){
        $inputName = $this->getAttr('name');
        if($inputName){
            if(isset($_REQUEST[$inputName])){
                $value = $_REQUEST[$inputName];
                $this->setAttr('value',$value);
            }
        }
        return parent::open();
    }
}



class Checkbox extends Tag
{
    public function __construct()
    {
        $this->setAttr('type', 'checkbox');
        $this->setAttr('value', '1');
        parent::__construct('input');
    }

    public function open()
    {
        $name = $this->getAttr('name');

        if ($name) {
            $hidden = (new Hidden)
                ->setAttr('name', $name)
                ->setAttr('value', '0');

            if (isset($_REQUEST[$name])) {
                $value = $_REQUEST[$name];

                if ($value == 1) {
                    $this->setAttr('checked');
                } else {
                    $this->removeAttr('checked');
                }
            }

            return $hidden->open() . parent::open();
        }
        else {
            return parent::open();
        }
    }

    public function __toString()
    {
        return $this->open();
    }
}
class Radio extends Tag{

    public function __construct(){
        $this->setAttr('type', 'radio');
        parent:: __construct('input');
    }

    public function open(){
        $name = $this->getAttr('name');

        if($name){

            if(isset($_REQUEST[$name])){
                $value = $_REQUEST[$name];
                $meaning = $this->getAttr('value');

                if($value == $meaning){
                    $this->setAttr('checked');
                }
                else{
                    $this->removeAttr('checked');
                }
            }
            return parent::open();
        }
        else{
            return parent::open();
        }
    }

    public function __toString()
    {
        return $this->open();
    }
}
class Select extends Tag{
    private $option = '';

    public function __construct(){
        parent::__construct('select');
    }

    public function add(Option $option){
        $this->option .= $option;

        return $this;
    }

    public function show()
    {
        return $this->open() . $this->option . $this->close();
    }

}


class Option extends Tag{

    public function __construct(){
        parent::__construct('option');
    }

    public function setSelected(){
        $this->setAttr('selected');
        return $this;
    }

    public function __toString(){
        return $this->show();
    }
}
//попробовать добавлять новый метод в класс Select наподобие метода setSelected в Option. Вызвать в Select


//----------------------------------------------------------------------------------------------------------------------------------------
class TagHelper{
    public function open($name, $atrs = []){
        $atr = $this->getAttrsStr($atrs);
        return "<$name$atr>";
    }

    public function close($name){
        return "</$name>";
    }

    private function getAttrsStr($atrs){
        if(!empty($atrs)){
            $result = "";
            foreach($atrs as $key => $value){
                if($value === true){
                    $result .= "$key";
                }
                else{
                    $result .= " $key=\"$value\"";
                }
            }
            return $result;
        }
        else {
            return "";
        }
    }

    public function show($name, $text, $atrs = true){
        if(isset($atrs) and is_array($atrs) ){
            return $this->open($name, $atrs) . $text . $this->close($name);
        }
        else {
            return $this->open($name) . $text . $this->close($name);
        }
    }
}



class FormHelper extends TagHelper{
    public function openForm($attrs = []){
        return $this->open('form', $attrs);
    }
    public function closeForm(){
        return $this->close('form');
    }

    public function input($atrs = []){
        if(isset($atrs['name'])){
            $name = $atrs['name'];

            if(isset($_REQUEST[$name])){
                $atrs['value'] = $_REQUEST[$name];
            }
        }
        return $this->open('input', $atrs);
    }

    public function password($atrs = []){
        $atrs['type'] = 'password';
        return $this->input($atrs);
    }

    public function hidden($attrs = [])
    {
        $attrs['type'] = 'hidden';
        return $this->open('input', $attrs);
    }

    public function submit($attrs = [])
    {
        $attrs['type'] = 'submit';
        return $this->open('input', $attrs);
    }

    public function checkbox($attrs = []){
        $attrs['type'] = 'checkbox';
        $attrs['value'] = 1;

        if(isset($attrs['name'])){
            $name = $attrs['name'];

            if(isset($_REQUEST[$name]) and $_REQUEST[$name] == 1){
                $attrs['checked'] = true;
            }
            $hidden = $this->hidden(['name' => $name, 'value' => 0]);
        }
        else{
            $hidden = '';
        }
        return $hidden . $this->open('input', $attrs);
    }

    public function textarea($name){

        if(isset($_REQUEST[$name])){
            $value = $_REQUEST[$name];
        }
        else $value = '';

        return $this->open('textarea', ['name' => $name]) . $value . $this->close($name);
    }
    public function select($attrs = [], $option = [] )
    {
        $result = $this->open('select', $attrs);

        foreach($option as $keys => $values){
            foreach($values as $key => $value){
                if($key == 'attrs'){
                    $arr = [];
                    foreach($value as $k => $v){
                        $arr[$k] = $v;
                        if($attrs['name']){
                            $name = $attrs['name'];
                            if(isset($_REQUEST[$name])){
                                $value = $_REQUEST[$name];
                                if($value == $arr['value']){
                                    $arr['selected'] = true;
                                }
                                else{
                                    unset($arr['selected']);
                                }
                            }
                        }
                    }
                    $result .= $this->open('option', $arr);
                }
            }
            $result .= $values['text'];
            $result .= $this->close('option');
        }
        $result .= $this->close('select');
        return $result;
    }
}
//-------------------------------------------------------------------------------------------------------------------------------------------

class CookieShell
{
    public function set($name, $value, $time)
    {
        setcookie($name, $value, (time() + $time));
        $_COOKIE[$name] = $value;
    }

    public function get($name)
    {
        return $_COOKIE[$name];
    }

    public function del($name)
    {
        setcookie($name, '', -1);
        unset($_COOKIE[$name]);
    }

    public function exists($name)
    {
        if(isset($_COOKIE[$name])){
            return true;
        }
        return false;
    }
    public function pageRefreshCounter(){

        if(!isset($_COOKIE['updates'])){
            setcookie('updates', 1, time() + 3600);
        }else{
            setcookie('updates', ++$_COOKIE['updates'], time() + 3600); //счетчик обновления страницы в течение часа
        }
    }
    public function pageRefresh(){
        return $_COOKIE['updates'];
    }
}



//-------------------------------------------------------------------------------------------------------------------------------------------------
class SessionShell
{
    // Удобно стартуем сессию в конструкторе класса:
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function set($name, $value)// устанавливает переменную сессии
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        // получает переменную сессии
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
        return false;
    }

    public function del($name)
    {
        // удаляет переменную сессии
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        return false;
    }

    public function exists($name)
    {
        // проверяет переменную сессии
        if(isset($_SESSION[$name])){
            return true;
        }
        return false;
    }

    public function destroy($name)
    {
        // разрушает сессию
        session_destroy();
        unset($_SESSION[$name]);
    }
}