<?php

/**
 * Автор: Садовский Алексей
 *
 * Дата реализации: 05.08.2022 11:00
 *
 * Дата изменения: 05.08.2022 14:30
 *
 * Файл с бэк-енд логикой проекта
 *
 */

include '../Model/PeopleModel.php';

$people = new PeopleModel;

$data = $_POST['data'];

if($_POST['method'] === 'input'){
    $people->getData($data[0],  $data[1],  $data[2],  $data[3],  $data[4]);
    $people->input();
}
if($_POST['method'] === 'check'){
    $table = $people->check();
    for ($id = 0; $id < (count($table)); $id++){
        $table[$id]['date'] = PeopleModel::convertDateToAge($table[$id]['date']);
        $table[$id]['sex'] = PeopleModel::convertBoolToSex($table[$id]['sex']);
    }
    echo json_encode($table);
}
if($_POST['method'] === 'delete'){
    $people->delete($data[0]);
}
