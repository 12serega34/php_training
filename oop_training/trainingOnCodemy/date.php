<?php

class Date
{
    public $day;
    public $month;
    public $year;

    //public $date;

    public function __construct($date = null)
    {
        // если дата не передана - пусть берется текущая
        if($date !== null) {
            $arr = [];
            preg_match('~(\d{2}).(\d{2}).(\d{2,4})~', $date, $arr);

            $this->day = $arr[1];
            $this->month = $arr[2];
            $this->year = $arr[3];
            //$this->date = "$arr[1].$arr[2].$arr[3]";

        } else {
            //$this->date = date("d.m.y");
            $this->day = date("d");
            $this->month = date("m");
            $this->year = date("y");
        }

    }

    public function getDay()
    {
        // возвращает день
        return $this->day;
    }

    public function getMonth($lang = null)
    {
        if($lang == 'ru') {
            switch($this->month) {
                case '01':
                    return 'январь';
                    break;
                case '02':
                    return 'февраль';
                    break;
                case '03':
                    return 'март';
                    break;
                case '04':
                    return 'апрель';
                    break;
                case '05':
                    return 'май';
                    break;
                case '06':
                    return 'июнь';
                    break;
                case '07':
                    return 'июль';
                    break;
                case '08':
                    return 'август';
                    break;
                case '09':
                    return 'сентябрь';
                    break;
                case '10':
                    return 'октябрь';
                    break;
                case '11':
                    return 'ноябрь';
                    break;
                case '12':
                    return 'декабрь';
                    break;

                default:
                    // code...
                    break;
            }
        }
        if($lang == 'en') {
            switch($this->month) {
                case '01':
                    return 'January';
                    break;
                case '02':
                    return 'February';
                    break;
                case '03':
                    return 'March';
                    break;
                case '04':
                    return 'April';
                    break;
                case '05':
                    return 'May';
                    break;
                case '06':
                    return 'June';
                    break;
                case '07':
                    return 'July';
                    break;
                case '08':
                    return 'August';
                    break;
                case '09':
                    return 'September';
                    break;
                case '10':
                    return 'October';
                    break;
                case '11':
                    return 'November';
                    break;
                case '12':
                    return 'December';
                    break;

                default:
                    // code...
                    break;
            }
        }
        // возвращает месяц

        // переменная $lang может принимать значение ru или en
        // если эта переменная не пуста - пусть месяц будет словом на заданном языке
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getWeekDay($lang = null)
    {
        return $this->day;
        if($lang == 'en') {
            switch($this->day) {
                case '01':
                    return 'Monday';
                    break;
                case '02':
                    return 'Tuesday';
                    break;
                case '03':
                    return 'Wednesday';
                    break;
                case '04':
                    return 'Thursday';
                    break;
                case '05':
                    return 'Friday';
                    break;
                case '06':
                    return 'Saturday';
                    break;
                case '07':
                    return 'Sunday';
                    break;
            }
        }
        if($lang == 'ru') {
            switch($this->day) {
                case '01':
                    return 'понедельник';
                    break;
                case '02':
                    return 'вторник';
                    break;
                case '03':
                    return 'среда';
                    break;
                case '04':
                    return 'четверг';
                    break;
                case '05':
                    return 'пятница';
                    break;
                case '06':
                    return 'суббота';
                    break;
                case '07':
                    return 'воскресенье';
                    break;
            }
        }
        // возвращает день недели

        // переменная $lang может принимать значение ru или en
        // если эта не пуста - пусть месяц будет словом на заданном языке
    }

    public function addDay($value)
    {
        // добавляет значение $value к дню
        return $this->day + $value;
    }

    public function subDay($value)
    {
        // отнимает значение $value от дня
        return $this->day - $value;
    }

    public function addMonth($value)
    {
        // добавляет значение $value к месяцу
        return $this->month + $value;
    }

    public function subMonth($value)
    {
        // отнимает значение $value от месяца
        return $this->month - $value;
    }

    public function addYear($value)
    {
        // добавляет значение $value к году
        return $this->year + $value;
    }

    public function subYear($value)
    {
        // отнимает значение $value от года
        return $this->year - $value;
    }

    public function format($format)
    {
        return $this->year . '.' . $this->month . '.' . $this->day;
        // выведет дату в указанном формате
        // формат пусть будет такой же, как в функции date
    }

    public function __toString()
    {
        // выведет дату в формате 'год-месяц-день'
        return $this->year . '-' . $this->month . '-' . $this->day;
    }
}

//Пусть конструктор этого класса параметрами принимает две даты, представляющие объекты класса Date, созданного нами в предыдущем уроке, и находит разницу между датами в днях, месяцах и годах
class Interval
{
    private $date1;
    private $date2;

    public function __construct(Date $date1, Date $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    private function convertToUnix()
    {
        $arr1 = [];
        $arr2 = [];
        $date1 = $this->date1;
        $date2 = $this->date2;

        preg_match('~(\d{2}).(\d{2}).(\d{2,4})~', $this->date1, $arr1);
        preg_match('~(\d{2}).(\d{2}).(\d{2,4})~', $this->date2, $arr2);

        $timestamp1 = mktime(0, 0, 0, $arr1[2], $arr1[3], $arr1[1]);
        $timestamp2 = mktime(0, 0, 0, $arr2[2], $arr2[3], $arr2[1]);

        if($timestamp1 > $timestamp2) {
            return $timestamp1 - $timestamp2;
        }
        return $timestamp2 - $timestamp1;
    }

    public function toDays()
    {
        // вернет разницу в днях
        return $this->convertToUnix() / 60 / 60 / 24;
    }

    public function toMonths()
    {
        // вернет разницу в месяцах
        $result = $this->convertToUnix() / 60 / 60 / 24 / 30;
        if($result < 1) {
            return 'меньше 1 месяца';
        }
        return $result . ' - в месяцах';

    }

    public function toYears()
    {
        // вернет разницу в годах
        $result = $this->convertToUnix() / 60 / 60 / 24 / 30 / 12;
        if($result < 1) {
            return 'меньше 1 года';
        }
        return $result . ' - в годах';
    }
}

interface iFile
{
    public function __construct($filePath);

    public function getPath(); // путь к файлу

    public function getDir();  // папка файла

    public function getName(); // имя файла

    public function getExt();  // расширение файла

    public function getSize(); // размер файла

    public function getText();          // получает текст файла

    public function setText($text);     // устанавливает текст файла

    public function appendText($text);  // добавляет текст в конец файла

    public function copy($copyPath);    // копирует файл

    public function delete();           // удаляет файл

    public function rename($newName);   // переименовывает файл

}

class File implements iFile
{
    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = __DIR__ . '/' . $this->filePath;
        $this->filePath = str_replace('\\', '/', $this->filePath);
    }

    public function getPath()
    {
        return $this->filePath;
        // путь к файлу
    }

    public function getDir()
    {
        // папка файла
        return dirname($this->filePath);
    }

    public function getName()
    {
        // имя файла
        return basename($this->filePath);
    }

    public function getExt()
    {
        // расширение файла
        return filetype($this->filePath);
    }

    public function getSize()
    {
        // размер файла
        return filesize($this->filePath);
    }

    public function getText()
    {
        // получает текст файла
        return file_get_contents($this->filePath);
    }

    public function setText($text)
    {
        return file_put_contents($this->filePath, $text);
        // устанавливает текст файла
    }

    public function appendText($text)
    {
        // добавляет текст в конец файла
        return file_put_contents($this->filePath, $text, FILE_APPEND);
    }

    public function copy($copyPath)
    {
        if(!copy($copyPath, $this->filePath)) {
            echo "не удалось скопировать $copyPath";
        }
        // копирует файл
    }

    public function delete()
    {
        // удаляет файл
        return unlink($this->filePath);
    }

    public function rename($newName)
    {
        // переименовывает файл
        return rename($this->filePath, $newName);
    }



}






