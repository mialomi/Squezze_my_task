<?php
//include_once "app\models\TaskModel.php";
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class taskController extends Controller 
{
	
    public function __construct() {

   
    }
    public function landingAction(){
        
    }
    public function indexAction()
    {   
        $taskList = new TaskModel();
        // Obtener todas las tareas
        $tasks = $taskList->getAllTasks();

        // Pasar las tareas a la vista
        $this->view->tasks = $tasks;
    }

    public function NewTaskAction()
{
        $taskList = new TaskModel();
        $error_message = array();

        // 1. Obtener los datos del formulario de creación de tareas y comprobar que no están vacíos
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = $_POST;

            if (empty($data['title'])) {
                $error_message['title'] = "Name is required";
            } else {
                $title = $data['title'];
            }

            if (empty($data['textarea'])) {
                $error_message["textarea"] = "Text is required";
            } else {
                $text = $data['textarea'];
            }

            if (empty($data['user'])) {
                $error_message['user'] = "User is required";
            } else {
                $user = $data['user'];
            }

            // 2. Validar si hay errores antes de agregar la tarea
            if (empty($error_message)) {
                // Agregar la tarea solo si no hay errores
                $taskList->newTask(
                    $data['title'],
                    $data['textarea'],
                    $data['user'],
                    $data['status'],
                    $data['datetime'],
                    $data['endtime']
                );

                // Redireccionar a la página de lista de tareas
                header('Location: index');
                exit;
            }
        }
}

    public function editTaskAction() {
    
        $taskList= new TaskModel();
        $this->view->tasks = $taskList->getTaskById($_GET['id']);
                
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $taskList->modifyTask($_GET["id"],$_POST['title'], $_POST['textarea'], $_POST['user'], $_POST['status'], $_POST['datetime'], $_POST['endtime']);
            
            header('Location: index ');
        }
        
    }
    public function showTaskAction(){

        $taskList = new TaskModel();
    
            $this->view->task =  $taskList->getTaskById($_GET['id']);
        
    }
    public function deleteTaskAction(){

        $taskList = new TaskModel();

        $taskId = $_GET['id'];
        
        $tasks = $taskList->getTaskById($taskId);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $taskList->deleteTask($_GET['id']);
        

        header( 'location: index');
            exit;
    }
}
}