<?php
include_once "app\models\taskmodel.php";
/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller {
    
    private $taskModel;

    public function __construct() {

        $this->taskModel = new TaskModel();
    }

    public function indexAction()
    {
        // Obtener todas las tareas
        $tasks = $this->taskModel->getAllTasks();

        // Pasar las tareas a la vista para mostrarlas
        $this->view->tasks = $tasks;
    }

    public function createTaskAction()
    {
        // Obtener los datos del formulario de creación de tareas
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $email = "";
        
            $name = $_POST["name"];
            $_SESSION["users"] = $name;
            //echo "You have entered: Username is ". $name;
            //echo "<br>";
            
                if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                    echo $name . " is not a valid username.";}
                    else{
                        echo "and it's valid.";
                        echo "<br>";
                    }
        }
        // Agregar la nueva tarea al archivo JSON
        $this->taskModel->addTask($taskData);

        // Redireccionar a la página de lista de tareas
        header('Location: index.php');
        exit;
    }
}


