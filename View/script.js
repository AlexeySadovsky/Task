function sendData(data, method){
    $.ajax({
        method: 'POST',
        url: '../Controller/logic.php',
        data: {
            'data': data,
            'method': method,
        },
        success: function (req) {
            if (method === 'check'){
                let newData = JSON.parse(req);
                console.log(newData)
            }
        }
    })
}

function getInputData(){
    let name = document.getElementById('name');
    let surname = document.getElementById('surname');
    let date = document.getElementById('date');
    let sex = document.getElementById('sex');
    let city = document.getElementById('city');
    let data = [name.value, surname.value, date.value, sex.value, city.value];
    console.log(data);
    sendData(data, 'input');
}

function checkTable(){
    sendData(null, 'check');
}

function getID(){
    let id = document.getElementById('id');
    let data = [id.value];
    sendData(data, 'delete');
}
