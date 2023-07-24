<?php
include_once "app\models\TaskModel.php";
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	private $taskModel;

    public function __construct() {

   //     $this->taskModel = $taskModel;
    }

    public function indexAction()
    {
        // Obtener todas las tareas
        $tasks = $this->taskModel->getAllTasks();

        // Pasar las tareas a la vista para mostrarlas
        $this->view->tasks = $tasks;
    }

    public function NewTaskAction() {
      
        $error_message = array();

        // 1. Obtener los datos del formulario de creación de tareas y comprobar que no están vacíos
        if($_SERVER["REQUEST_METHOD"] === "POST"){
    
            if(empty($_POST ["name"])){
                $error_message["name"] = "Name is required";
            }
            else{
                $title = $_POST["name"];
                }
            
            if(empty($_POST ["text"])){
                $error_message["text"] = "Text is required";
            }
            else{
                $text = $_POST["text"];
                }
            if(empty($_POST ["user"])){
                $error_message["user"] = "User is required";
            }
            else{
                $user = $_POST["user"];
                }
        
        //***/ PENDIENTE: HAY QUE AÑADIR $error_user al html para que lo vea
        // 2. Una vez validado, llama al método añadir la tarea de /MODELS

          if(!empty($_POST)){
            $this->taskModel->addTask();
          }     
        // Redireccionar a la página de lista de tareas
        header('Location: index.phtml');
        exit;
    }
}

public function modifyTask($taskId, $newTaskData)
{
    $this->taskModel->modifyTask($taskId, $newTaskData);
    
}

public function deleteTask($taskId){
    
    $this->taskModel->deleteTask($taskId);
}
}