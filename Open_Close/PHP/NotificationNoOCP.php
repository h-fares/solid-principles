<?php

// We have a notification system that sends alerts via email
class EmailNotification {
    public function send($message) {
        echo "Sending email with message: $message\n";
    }
}

// Notification Service which initialize an email notification
class NotificationService {
    private $emailNotification;

    public function __construct() {
        $this->emailNotification = new EmailNotification();
    }

    public function notify($message) {
        $this->emailNotification->send($message);
    }
}

$notificationService = new NotificationService();
$notificationService->notify('Hello World');

// If we have a new notification type, we need to create a new class for it
// and modify the NotificationService to use it
// This violates the Open/Closed Principle



