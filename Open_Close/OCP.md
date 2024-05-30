# Open/Closed Principle (OCP) in SOLID
## Introduction
The Open/Closed Principle (OCP) is one of the five SOLID principles of object-oriented design. It states that software entities (classes, modules, functions, etc.) should be open for extension but closed for modification. This principle helps create flexible and maintainable code by allowing behavior to be extended without altering existing code.

This README provides a detailed explanation of the Open/Closed Principle along with a practical example in PHP.

## The Principle
### Definition
#### Open/Closed Principle (OCP) states:

_"Software entities should be open for extension, but closed for modification."_

In simpler terms, this means that we should be able to add new functionality to our code without changing the existing code. By adhering to OCP, we can reduce the risk of introducing bugs when adding new features and make our codebase more resilient to changes.

### Benefits
#### 1. Flexibility: 
New functionality can be added easily.
#### 2. Maintainability: 
Reduces the risk of introducing bugs.
#### 3. Scalability: 
Facilitates the growth of the codebase.

### Example in PHP
Let's consider a simple example of a notification system that only sends email notifications. Initially, the system is designed to handle email notifications only.

```php
<?php

class EmailNotification {
    public function send($message) {
        echo "Sending email with message: $message 📧\n";
    }
}

class NotificationService {
    private $emailNotification;

    public function __construct() {
        $this->emailNotification = new EmailNotification();
    }

    public function notify($message) {
        $this->emailNotification->send($message);
    }
}
?>
```

#### Violation of Open/Closed Principle
Now, let's say we want to add SMS notifications. If we modify the NotificationService class directly to accommodate this new requirement, we violate the Open/Closed Principle:

```php
<?php

class SmsNotification {
    public function send($message) {
        echo "Sending SMS with message: $message 📱\n";
    }
}

class NotificationService {
    private $emailNotification;
    private $smsNotification;

    public function __construct() {
        $this->emailNotification = new EmailNotification();
        $this->smsNotification = new SmsNotification();  // 🚨 Modification Alert!
    }

    public function notify($message, $method = "email") {
        if ($method === "email") {
            $this->emailNotification->send($message);
        } elseif ($method === "sms") {
            $this->smsNotification->send($message);
        }
    }
}
?>
```

#### Applying the Open/Closed Principle
To adhere to the Open/Closed Principle, we should use interfaces and polymorphism to allow our code to be extended without modifying existing classes:

```php
<?php

interface Notification {
    public function send($message);
}

class EmailNotification implements Notification {
    public function send($message) {
        echo "Sending email with message: $message 📧\n";
    }
}

class SmsNotification implements Notification {
    public function send($message) {
        echo "Sending SMS with message: $message 📱\n";
    }
}

class NotificationService {
    private $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    public function notify($message) {
        $this->notification->send($message);
    }
}
?>
```

#### Adding New Notification Methods
Now, if we want to add push notifications, we can do so without modifying the existing NotificationService class:

```php
<?php

class PushNotification implements Notification {
    public function send($message) {
        echo "Sending push notification with message: $message 🔔\n";
    }
}

// Usage
$emailService = new NotificationService(new EmailNotification());
$emailService->notify("Hello via Email! 📧");

$smsService = new NotificationService(new SmsNotification());
$smsService->notify("Hello via SMS! 📱");

$pushService = new NotificationService(new PushNotification());
$pushService->notify("Hello via Push Notification! 🔔");
?>
```

### Conclusion
By following the Open/Closed Principle, we ensure our code is more flexible and easier to maintain. 🌟 In our example, we demonstrated how to apply this principle to a notification system, making it simple to add new notification methods without altering the existing codebase. Remember, keeping our code extensible and stable is the key to happy coding! 😃

