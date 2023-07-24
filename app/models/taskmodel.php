<?php
include_once "./task.php";

class TaskModel {

    private array $task_list;
    private $dataFilePath = 'DevoTeams\web\json_tasks.json"';

public function __construct() {
    $this->task_list = array();
    
}
    private function saveData($task_data) : void{
            
        $jsonData = json_encode($task_data, JSON_PRETTY_PRINT);
        file_put_contents($this->dataFilePath, $jsonData);

        }

    private function readData() {
        // va al archivo json
        $tasksData = file_get_contents($this->dataFilePath);
        
        // lee el archivo json y lo transforma 
        $data_read = json_decode($tasksData, true);

        return $data_read;
}
    public function addtask(Task $task) : void {

        $task_data[] = $task;
        //$this->task_list[] = $task_data;
        
        $this ->saveData($task_data);

}   


    //delete task

   

    public function editTask($id_task, $newData) {

        $old_data = $this->readData();

        foreach ($old_data as $task) {
            if ($id_task == $task['id']) {

                $newData['name'] = $task['name'];
                $newData['text'] = $task['text'];
                $newData['status'] = $task['status'];
                $newData['start_time'] = $task['start_time'];
                $newData['end_time'] = $task['end_time'];

                $this->saveData($newData);
            }
            else{
                return "Error. Task not found.";
            }
        }
    }

    //show Task
}

?>