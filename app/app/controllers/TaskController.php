<?php

//require_once 'TaskModel.php';

class TaskController extends Controller
{
    private $taskModel;

   /* public function __construct($dataFilePath)
    {
        $dataFilePath = ROOT_PATH . '/models/data/data.json';
        $this->taskModel = new TaskModel($dataFilePath);
    }*/

    public function addTask($taskData)
    {
        $this->taskModel->addTask($taskData);
        $this->redirectTo('/');
    }

    public function getAllTasks()
    {
        return $this->taskModel->getAllTasks();
    }

    public function modifyTask($taskId, $newTaskData)
    {
        $this->taskModel->modifyTask($taskId, $newTaskData);
        $this->redirectTo('/');
    }

    private function redirectTo($url)
    {
        header("Location: $url");
        exit;
    }
    public function indexAction(){
        echo "estoy en el método index";
    }
}
?>