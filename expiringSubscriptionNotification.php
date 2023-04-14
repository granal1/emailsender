<?php

// namespace ;

use PDO;
use PDOStatement;

class expiringSubscriptionNotification
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function mailSend() :void
    {
        $users = $this->getUsersByTimeInterval(3);

        foreach ($users as $user) {

            $subject = "Notification about expiring subscription at 3 days"; 

            $message = $user['username']. 'your subscription is expiring soon';

            $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
            $headers .= "From: <from@example.com>\r\n"; 

            mail($user['email'], $subject, $message, $headers); 
        }
    }

    private function getUsersByTimeInterval(int $interval) :array
    {
        $statement = $this->connection->prepare(
          'SELECT username, email 
          FROM users 
          WHERE validts = DATE_ADD(NOW(), INTERVAL :interval DAY))
          AND confirmed = 1'
        );

        return $statement->execute([
          ':interval' => $interval,
        ]);
    }
}
