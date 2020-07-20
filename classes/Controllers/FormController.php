<?php

class FormController {

    protected $config;

    public function config(Config $config) {
        $this->config = $config;
    }
    
    public function handle() {
        try {
            $pdo = new PDO($this->config['dns'], $this->config['username'], $this->config['password']);
            $sql = "INSERT INTO members (full_name, phone_number, email, message, subscribe) VALUES (:full_name, :phone_number, :email, :message, :subscribe)";
            $statement = $pdo->prepare($sql);
            $statement->execute($sql, array(
                ':full_name' => $_POST['full_name'],
                ':phone_number' => $_POST['phone_number'],
                ':email' => $_POST['email'],
                ':message' => $_POST['message'],
                ':subscribe' => $_POST['subscribe']
            );
            
        } catch (PDOException $e) {
            echo "Connection Failed" . $e->getMessage();
        }

        // escape all this..
        mail($this->config['admin_email'], "New Member", "Details \r\n $_POST['full_name']");
    }
}
