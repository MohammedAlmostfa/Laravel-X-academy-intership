<?php
$data = [];

// (Create)
function create($value) {
    global $data;
    $id = count($data) + 1;
    $data[$id] = $value;
}

// قراءة (Read)
function read() {
    global $data;
    if (count($data) == 0) {
        echo "There isn't any data<br>";
    } else {
        echo "The data is:<br>";
        foreach ($data as $id => $value) {
            echo "ID: $id, Value: $value<br>";
        }
    }
  
}

//  delete
function delete($id) {
    global $data;
    if (isset($data[$id])) {
        unset($data[$id]);
    }
    else{
        echo"There isn't any data to delete <br>";}
    }

// update 
    function update($newdata,$id) {
    global $data;
    if (isset($data[$id])) {
       $data[$id]=$newdata;
    }
    else{
        echo"There isn't any data to update <br>";}
    }
    

create(1);
create(2);
create(3);
create(4);
delete(2);
update(5,2);
read();

?>
