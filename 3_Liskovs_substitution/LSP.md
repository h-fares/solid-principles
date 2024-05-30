# Liskov Substitution Principle (LSP) in SOLID
## Introduction
The Liskov Substitution Principle (LSP) is one of the five SOLID principles of object-oriented design. It states that objects of a superclass should be replaceable with objects of a subclass without affecting the correctness of the program. In other words, a subclass should enhance or extend the functionality of a superclass, not replace or modify it in an unexpected way.

This README provides a detailed explanation of the Liskov Substitution Principle along with a practical example in PHP.

## The Principle
### Definition
#### Liskov Substitution Principle (LSP) states:

_"Subtypes must be substitutable for their base types."_ 

In essence, this means that if you have a base class Shape and a derived class Rectangle, you should be able to replace Shape with Rectangle without introducing errors or altering the expected behavior of the program.

### Benefits
#### 1. Maintainability:
Easier to maintain and extend the code.
#### 2. Reusability: 
Promotes code reuse through polymorphism.
#### 3. Robustness: 
Ensures the system's behavior remains consistent when using derived classes.

### Example in PHP
Let's consider a simple example with a shape drawing application. We start with a Shape class and a Rectangle class.
```php
<?php

class Shape {
    public function area() {
        // Default implementation (if any)
    }
}

class Rectangle extends Shape {
    protected $width;
    protected $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function area() {
        return $this->width * $this->height;
    }
}
?>
```

Adding a New Shape: Square

Now, let's add a Square class, which is a special type of Rectangle.

```php
<?php

class Square extends Rectangle {
    public function __construct($side) {
        parent::__construct($side, $side);
    }

    public function setWidth($width) {
        $this->width = $width;
        $this->height = $width; // Keep it a square
    }

    public function setHeight($height) {
        $this->height = $height;
        $this->width = $height; // Keep it a square
    }
}
?>
```

#### Violation of Liskov Substitution Principle
The above implementation violates LSP because the Square class changes the invariant of the Rectangle class.

Here's how:

```php
<?php

function printArea(Shape $shape) {
    echo "Area: " . $shape->area() . "\n";
}

$rectangle = new Rectangle(4, 5);
printArea($rectangle); // Area: 20

$square = new Square(4);
printArea($square); // Area: 16

$square->setWidth(5);
printArea($square); // Area: 25 (Expected), but if LSP is violated, logic may break
?>
```

In this example, setting the width of a square might lead to unexpected behavior, breaking the LSP because Square changes the invariant of Rectangle.

#### Correct Implementation
To adhere to the Liskov Substitution Principle, we should treat Square and Rectangle as separate entities rather than making Square a subclass of Rectangle:

```php
<?php

class Shape {
    public function area() {
        // Default implementation (if any)
    }
}

class Rectangle extends Shape {
    protected $width;
    protected $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function area() {
        return $this->width * $this->height;
    }
}

class Square extends Shape {
    protected $side;

    public function __construct($side) {
        $this->side = $side;
    }

    public function setSide($side) {
        $this->side = $side;
    }

    public function area() {
        return $this->side * $this->side;
    }
}

// Usage
function printArea(Shape $shape) {
    echo "Area: " . $shape->area() . "\n";
}

$rectangle = new Rectangle(4, 5);
printArea($rectangle); // Area: 20

$square = new Square(4);
printArea($square); // Area: 16

$square->setSide(5);
printArea($square); // Area: 25
?>
```

### Conclusion
By following the Liskov Substitution Principle, we ensure our code is more robust, maintainable, and easier to understand. In this example, we demonstrated how to apply LSP to a shape drawing application, ensuring that our shapes behave correctly and predictably.

Remember, keeping our code flexible and bug-free is the key to happy coding! 😃