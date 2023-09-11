<?php
include_once "./status.php";

class Task{

//Atributos
private $id;
private string $name; 
private string $text;
private Status $status;  
private $startTime;
private $endTime;

public function __construct(string $name, string $text, Status $status, $startTime, $endTime){
    $this->id = uniqid();
    $this ->name = $name;
    $this ->text = $text;
    $this ->status = $status;
    $this ->startTime = $startTime;
    $this ->endTime = $endTime;

}
public function get_id() {
    return $this ->id;
}

public function getName() : string{
    return $this -> name; 
}
public function getText(): string{
    return $this -> text; 
}

public function getStatus(): Status{
    return $this -> status; 
}
public function getStartTime(){
    return $this -> startTime; 
}
public function getEndTime(){
    return $this -> endTime; 
}
}

?>