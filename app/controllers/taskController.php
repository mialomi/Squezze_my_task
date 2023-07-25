<?php
//include_once "app\models\TaskModel.php";
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class taskController extends Controller 
{
	private $taskModel;


    public function __construct() {

   //     $this->taskModel = $taskModel;
    }

    public function indexAction()
    {   
        $taskList = new TaskModel();
        // Obtener todas las tareas
        $tasks = $taskList->getAllTasks();

        // Pasar las tareas a la vista para mostrarlas
        $this->view->tasks = $tasks;
    }

    public function NewTaskAction() {
        $taskList = new TaskModel();

        $error_message = array();

        // 1. Obtener los datos del formulario de creación de tareas y comprobar que no están vacíos
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $data = $_POST;;

            if(empty($data ["title"])){
                $error_message["title"] = "Name is required";
            }
            else{
                $title = $data["title"];
                }
            
            if(empty($data ["textarea"])){
                $error_message["textarea"] = "Text is required";
            }
            else{
                $text = $data["textarea"];
                }
            if(empty($data["user"])){
                $error_message["user"] = "User is required";
             }
            else{
                $user = $data["user"];
                }
        
        //***/ PENDIENTE: HAY QUE AÑADIR $error_user al html para que lo vea
        // 2. Una vez validado, llama al método añadir la tarea de /MODELS

          if(!empty($_POST)){
            $taskList->newTask($data['title'], $data['textarea'], $data['user'], $data['status'], $data['datetime']);
          }     
        // Redireccionar a la página de lista de tareas
        header('Location: index');
        exit;
    }
}

public function editTaskAction()
{
    $taskList= new TaskModel();
    $this->view->tasks = $taskList->getTaskById($_GET['id']);
            
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $taskList->modifyTask($_GET["id"],$_POST['title'], $_POST['textarea'], $_POST['user']);
        
        header('Location: newTask ');
    }
    
}
public function showTaskAction(){
    $taskList = new TaskModel();
  
       
        $this->view->task =  $taskList->getTaskById($_GET['id']);
    


}
public function deleteTaskAction(){
    $taskList = new TaskModel();
    $taskList->deleteTask($_GET['id']);
    header( 'location: index');
        exit;
}
}