<?php


class TaskModel {

    private array $task_list;
    protected $dataFilePath = ROOT_PATH.'/app/models/data/data.json';


    public function newTask(string $title, string $textArea, string $user,string $status, $datetime) {
        // Contador
        $newId = count($this->readData()) + 1;
    
        // Obtener la hora actual en el formato deseado si no se proporciona un valor en $datetime
        if ($datetime === null) {
            $datetime = date("M d, Y g:i A");
        }
    
        $data = [
            'id' => $newId,
            'title' => $title,
            'textarea' => $textArea,
            'user' => $user,
            'status'=> $status,
            'datetime' => $datetime, // Agregar la hora actual o el valor proporcionado al array
        ];
    
        // Meto el archivo json descodificado en tasks
        $tasks = $this->readData();
        // Luego añado data al array tasks
        $tasks[] = $data;
        // Guarda
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
    
        
    
        public function modifyTask($id,$title, $textArea, $user)
        {       //Llamas el metodo readData y lo envuelves en una variable, para luego iterar sobre ella
            $data = $this->readData();
            
            foreach ($data as $i => $editData){
                //data es el array, i es la pos, y editData el contenido, si editData[id] es igual al parametro $id
                if ($editData['id'] == $id){
                    //Se procede a cambiar los datos del array, de la pos que marca i
                    $data[$i]['title']=$title;
                    $data[$i]['textarea']=$textArea;
                    $data[$i]['user']=$user;
                    
                    //luego se guardan
    
                    $this ->saveData($data);
                }
    
                
            }
           
        }
    
    
    }
    
    ?>