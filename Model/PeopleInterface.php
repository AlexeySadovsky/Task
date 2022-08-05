<?php

/**
* Автор: Садовский Алексей
*
* Дата реализации: 05.08.2022 10:00
*
* Дата изменения: 05.08.2022 10:20
*
* Интерфейс для класса работы с базой данных
*
*/

Interface PeopleInterface
{

    public function __construct();

    public function input();

    public function check();

    public function delete($id);

}