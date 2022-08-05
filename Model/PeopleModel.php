<?php

/**
 * Автор: Садовский Алексей
 *
 * Дата реализации: 05.08.2022 10:10
 *
 * Дата изменения: 05.08.2022 14:20
 *
 * Класс для работы с базой данных
 *
 * Немного не понял 5 пункт, поэтому реализовал конструктор как заполнение данных БД
 * Работа с базой данных происходит с помощью библиотеки PDO
 * метод input() заисывает данные в БД
 * метод check() делает выборку из бд
 * метод delete() удаляет поле по id
 * статические методы выполняют преобразование данных из бд и выводят пользователю в понятном виде
 *
 *
 */


include 'PeopleInterface.php';

class PeopleModel implements PeopleInterface
{

    public $id;
    public $name;
    public $surname;
    public $date;
    public $sex;
    public $city;

    public $idDB;
    public $nameDB;
    public $password;
    public $db;

    public function __construct()
    {
        $this->idDB = 'localhost';
        $this->nameDB = 'root';
        $this->password = 'root';
        $this->db = 'people';
    }

    public function getData($_name, $_surname, $_date, $_sex, $_city){
        $this->name = $_name;
        $this->surname = $_surname;
        $this->date = $_date;
        $this->sex = $_sex;
        $this->city = $_city;
    }

    static function convertDateToAge($date){
        $today = date("j, n, Y");
        list($todayDate) = preg_split('[\.]', $today);
        list($todayDay, $todayMonth, $todayYear) = preg_split('[\, ]', $todayDate);
        list($year, $day, $month) = preg_split('[\-]', $date);
        if((int)$todayDay - (int)$day > 0){
            (int)$todayMonth -= 1;
        }
        if((int)$todayMonth - (int)$month){
            (int)$todayYear -= 1;
        }
        $age = (int)$todayYear - (int)$year;

        return $age;
    }

    static function convertBoolToSex($sex){
        if($sex === "1"){
            $sex = "жен";
        }
        if($sex === "0"){
            $sex = "муж";
        }
        return $sex;
    }

    public function input()
    {
        try {

            $dbh = new PDO('mysql:host=' . $this->idDB . ';dbname=' . $this->db, $this->nameDB, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO `peopletable`(name, surname, date, sex, city) VALUES ((:name), (:surname), (:date), (:sex), (:city));";
            $query = $dbh->prepare($sql);
            $query->execute(array('name' => $this->name, 'surname' => $this->surname, 'date' => $this->date, 'sex' => $this->sex, 'city' => $this->city ));

            $dbh = null;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function check()
    {
        try {

            $dbh = new PDO('mysql:host=' . $this->idDB . ';dbname=' . $this->db, $this->nameDB, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `peopletable`;";
            $query = $dbh->prepare($sql);
            $query->execute();
            $table = $query->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;
            return $table;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function delete($id)
    {
        try {

            $dbh = new PDO('mysql:host=' . $this->idDB . ';dbname=' . $this->db, $this->nameDB, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM `peopletable` WHERE id =(:id);";
            $query = $dbh->prepare($sql);
            $query->execute(array('id' => $id ));

            $dbh = null;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}