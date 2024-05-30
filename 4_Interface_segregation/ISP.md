# Interface Segregation Principle (ISP) in SOLID
## Introduction
The Interface Segregation Principle (ISP) is one of the five SOLID principles of object-oriented design. It states that no client should be forced to depend on methods it does not use. This principle helps create more modular and maintainable code by ensuring that interfaces are specific to the clients that use them.

This README provides a detailed explanation of the Interface Segregation Principle along with a practical example in PHP.

## The Principle
### Definition
#### Interface Segregation Principle (ISP) states:

_ "Clients should not be forced to depend on interfaces they do not use."_

In simpler terms, this means that larger interfaces should be split into smaller, more specific interfaces so that clients only need to know about the methods that are of interest to them. By adhering to ISP, we can avoid "fat" interfaces and ensure our code is more modular and easier to maintain.

### Benefits
#### 1. Maintainability: 
Easier to understand and change the code.
#### 2. Reusability: 
Promotes code reuse by providing more focused interfaces.
#### 3. Decoupling:
Reduces the dependency between different parts of the codebase.

### Example in PHP
Let's consider a simple example of a multi-function printer that can print, scan, and fax. Initially, we might create a single interface for this device.

```php
<?php

interface MultiFunctionDevice {
    public function printDocument($document);
    public function scanDocument($document);
    public function faxDocument($document);
}

class MultiFunctionPrinter implements MultiFunctionDevice {
    public function printDocument($document) {
        echo "Printing document: $document 🖨️\n";
    }

    public function scanDocument($document) {
        echo "Scanning document: $document 📄\n";
    }

    public function faxDocument($document) {
        echo "Faxing document: $document 📠\n";
    }
}
?>
```

#### Violation of Interface Segregation Principle
Now, let's say we have a basic printer that only prints documents. If it implements the MultiFunctionDevice interface, it would be forced to implement methods it doesn't use:

```php
<?php

class BasicPrinter implements MultiFunctionDevice {
    public function printDocument($document) {
        echo "Printing document: $document 🖨️\n";
    }

    public function scanDocument($document) {
        // BasicPrinter doesn't support scanning
        throw new Exception("Scan not supported!");
    }

    public function faxDocument($document) {
        // BasicPrinter doesn't support faxing
        throw new Exception("Fax not supported!");
    }
}
?>
```

#### Applying the Interface Segregation Principle
To adhere to the Interface Segregation Principle, we should split the MultiFunctionDevice interface into smaller, more specific interfaces:

```php
<?php

interface Printer {
    public function printDocument($document);
}

interface Scanner {
    public function scanDocument($document);
}

interface Fax {
    public function faxDocument($document);
}

class MultiFunctionPrinter implements Printer, Scanner, Fax {
    public function printDocument($document) {
        echo "Printing document: $document 🖨️\n";
    }

    public function scanDocument($document) {
        echo "Scanning document: $document 📄\n";
    }

    public function faxDocument($document) {
        echo "Faxing document: $document 📠\n";
    }
}

class BasicPrinter implements Printer {
    public function printDocument($document) {
        echo "Printing document: $document 🖨️\n";
    }
}
?>
```

#### Adding New Functionality
If we want to add a new device that only scans documents, we can do so without modifying existing interfaces or classes:

```php
<?php

class BasicScanner implements Scanner {
    public function scanDocument($document) {
        echo "Scanning document: $document 📄\n";
    }
}

// Usage
$printer = new BasicPrinter();
$printer->printDocument("My Report");

$scanner = new BasicScanner();
$scanner->scanDocument("My Photo");

$multiFunctionPrinter = new MultiFunctionPrinter();
$multiFunctionPrinter->printDocument("My Document");
$multiFunctionPrinter->scanDocument("My Drawing");
$multiFunctionPrinter->faxDocument("My Contract");
?>
```

### Conclusion
By following the Interface Segregation Principle, we ensure our code is more modular and easier to maintain. 🌟 In our example, we demonstrated how to split a large interface into smaller, more specific interfaces, making it simple to add new devices without altering the existing codebase. Remember, keeping our interfaces focused and specific is the key to happy coding! 😃