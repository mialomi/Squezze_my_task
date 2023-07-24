<?php

class TaskModel
{
    private $dataFilePath;
    private $tasks;

    public function __construct($dataFilePath)
    {
        $this->dataFilePath = ROOT_PATH . '/models/data/data.json';
        $this->loadData();
    }

    private function loadData()
    {
        if (file_exists($this->dataFilePath)) {
            $jsonData = file_get_contents($this->dataFilePath);
            $this->tasks = json_decode($jsonData, true);
        } else {
            $this->tasks = ["tasks" => []];
        }
    }

    private function saveData()
    {
        $jsonData = json_encode($this->tasks, JSON_PRETTY_PRINT);
        file_put_contents($this->dataFilePath, $jsonData);
    }

    public function addTask($taskData)
    {
        $taskId = count($this->tasks['tasks']) + 1;
        $taskData['id'] = $taskId;
        $this->tasks['tasks'][] = $taskData;
        $this->saveData();
    }

    public function getAllTasks()
    {
        return $this->tasks['tasks'];
    }

    public function modifyTask($taskId, $newTaskData)
    {
        foreach ($this->tasks['tasks'] as &$task) {
            if ($task['id'] === $taskId) {
                $task = array_merge($task, $newTaskData);
                $this->saveData();
                return true;
            }
        }
        return false;
    }
}


?>