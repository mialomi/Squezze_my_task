<?php


class TaskModel {

    private array $task_list;
    protected $dataFilePath = ROOT_PATH.'/app/models/data/data.json';

    public function newTask(string $title, string $text, string $user, string $status, mixed $datetime, mixed $endTime) {

        $newId = count($this->readData()) + 1;


        if ($datetime === null) {
            $datetime = date("M d, Y g:i A");
        }
        if ($endTime === null) {
            $endTime = date("M d, Y g:i A");
        }

        $data = [
            'id' => $newId,
            'title' => $title,
            'textarea' => $text,
            'user' => $user,
            'status'=> $status,
            'datetime' => $datetime,
            'endtime' => $endTime
        ];

        $tasks = $this->readData();

        $tasks[] = $data;

        $this->saveData($tasks);
    }

    private function saveData($task_data) : void{

        file_put_contents($this->dataFilePath,json_encode($task_data, JSON_PRETTY_PRINT));

        }

    private function readData() {
        // va al archivo json
        $tasksData = file_get_contents($this->dataFilePath);

        // lee el archivo json y lo transforma 
         return $data_read = json_decode($tasksData, true);
    }
    function getTaskById($id){

        $users= $this->readData();
            //Buscar if en el array 
        foreach($users as $user){
            if($user['id'] == $id){
                return $user;

            }
        }
        return null;
    }

        public function getAllTasks()
        {
            return $this->readData();
        }

        public function deleteTask($id){

           $tasks = $this->readData();
           foreach ($tasks as $key => $task) {
            if ($task['id'] == $id) {
                unset($tasks[$key]);
                break;
            }
        }
            $this->saveData($tasks);

           }
           public function modifyTask($id, $title, $text, $user, $status, $datetime, $endTime){ 
                  
            $data = $this->readData();
            
            foreach ($data as $i => $editData){
                
                if ($editData['id'] == $id){
                    //Se procede a cambiar los datos del array, de la pos que marca i
                    $data[$i]['title']= $title;
                    $data[$i]['textarea']= $text;
                    $data[$i]['user']= $user;
                    $data[$i]['status'] = $status;
                    $data[$i]['datetime']= $datetime;
                    $data[$i]['endtime']= $endTime; 

                    //luego se guardan
    
                    $this ->saveData($data);
                }
        }
    }
}
    ?>