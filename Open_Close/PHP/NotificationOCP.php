<?php
abstract class Notification {
    abstract public function send($message);
}

// EmailNotification now extends the abstract Notification class
class EmailNotification extends Notification {
    public function send($message) {
        echo "Sending email with message: $message\n";
    }
}

// We can now create new notification types by extending the Notification class
// For example, a SMS notification:
class SMSNotification extends Notification {
    public function send($message) {
        echo "Sending SMS with message: $message\n";
    }
}

// The NotificationService now uses the abstract Notification class
class NotificationService {
    private $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    public function notify($message) {
        $this->notification->send($message);
    }
}

// Usage:
$emailNotification = new NotificationService(new EmailNotification());
$emailNotification->notify("Hello, email!");

$smsNotification = new NotificationService(new SMSNotification());
$smsNotification->notify("Hello, SMS!");