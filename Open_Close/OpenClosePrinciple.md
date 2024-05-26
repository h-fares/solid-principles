# Open/Closed Principle

###  What is the Open/Closed Principle?
The Open/Closed Principle states that a class should be open for extension but closed for modification. This means that the behavior of a class can be extended without modifying its source code. By adhering to this principle, we can introduce new features with minimal risk of introducing bugs into existing functionality.

### Real-Life Example: A Notification System
Let's consider a real-life example to understand how the Open/Closed Principle can be applied in practice. Imagine we have a notification system that sends alerts via email. Initially, our system is designed to handle email notifications only. However, as our application grows, we want to extend the system to support SMS and push notifications.