<?php


class TaskModel {

    private array $task_list;
    protected $dataFilePath = ROOT_PATH.'/app/models/data/data.json';


    public function newTask(string $title, string $textArea, string $user){
        //contador
        $newId = count($this->readData()) + 1;
      
       
        $data = [
            'id' => $newId,
            'title' => $title,
            'textarea' => $textArea,
            'user' => $user,
        ];
        //meto el archivo json descodificado en tasks
        $tasks= $this->readData();
        //luego añado data al array tasks
        $tasks[]=$data;
         //guarda
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