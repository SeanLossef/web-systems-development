<?php 
abstract class SingleOp {
  protected $operand_1;
  public function __construct($o1) {
    if (!is_numeric($o1)) {
      throw new Exception('Non-numeric operand.');
    }
    
    // Assign passed values to member variables
    $this->operand_1 = $o1;
  }
  public abstract function operate();
  public abstract function getEquation(); 
}

abstract class Operation {
  protected $operand_1;
  protected $operand_2;
  public function __construct($o1, $o2) {
    // Make sure we're working with numbers...
    if (!is_numeric($o1) || !is_numeric($o2)) {
      throw new Exception('Non-numeric operand.');
    }
    
    // Assign passed values to member variables
    $this->operand_1 = $o1;
    $this->operand_2 = $o2;
  }
  public abstract function operate();
  public abstract function getEquation(); 
}

// Basic Operations
class Addition extends Operation {
  public function operate() {
    return $this->operand_1 + $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
  }
}
class Subtraction extends Operation {
  public function operate() {
    return $this->operand_1 - $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
  }
}
class Multiplication extends Operation {
  public function operate() {
    return $this->operand_1 * $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
  }
}
class Division extends Operation {
  public function operate() {
    return $this->operand_1 / $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

// subclasses for 10^x & e^x
class TentoVar extends SingleOp {
  public function operate() {
    return pow(10, $this->operand_1);
  }
  public function getEquation() {
    return '10^' . $this->operand_1 . ' = ' . $this->operate();
  }
}
class EtoVar extends SingleOp {
  public function operate() {
    return exp($this->operand_1);
  }
  public function getEquation() {
    return 'e^' . $this->operand_1 . ' = ' . $this->operate();
  }
}

// subclasses for x^2 & x^y
class varto2 extends SingleOp {
  public function operate() {
    return pow($this->operand_1, 2);
  }
  public function getEquation() {
    return  $this->operand_1 . '^2'.' = '. $this->operate();
  }
}
class vartovar extends Operation {
  public function operate() {
    return pow($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return  $this->operand_1.'^' . $this->operand_2 . ' = ' . $this->operate();
  }
}

// Some debugs - uncomment these to see what is happening...
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";


// Check to make sure that POST was received 
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Instantiate an object for each operation based on the values returned on the form
// For example, check to make sure that $_POST is set and then check its value and 
// instantiate its object
// 
// The Add is done below.  Go ahead and finish the remiannig functions.  
// Then tell me if there is a way to do this without the ifs
// We might cover such a way on Tuesday...

  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    }
    // Put code for subtraction, multiplication, and division here
    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtraction($o1, $o2);
    }
    if (isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
      $op = new Division($o1, $o2);
    }
    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiplication($o1, $o2);
    }
    if (isset($_POST['10tovar']) && $_POST['10tovar'] == '10^x') {
      $op = new TentoVar($o1);
    }
    if (isset($_POST['etovar']) && $_POST['etovar'] == 'e^x') {
      $op = new EtoVar($o1);
    }
    if (isset($_POST['varto2']) && $_POST['varto2'] == 'x^2') {
      $op = new varto2($o1);
    }
    if (isset($_POST['vartovar']) && $_POST['vartovar'] == 'x^y') {
      $op = new vartovar($o1, $o2);
    }
  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
  <title>PHP Calculator</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
  
  <section id="calculator">
    <h1>Welcome to php Calculator!</h1>
    <h2>input some values & select an operation below!</h2>
    <p>if using a single input operation, put the variable in the first input box</p>
    <form method="post" action="calculator.php">
    <pre id="result">
      <?php 
        if (isset($op)) {
          try {
            echo $op->getEquation();
          }
          catch (Exception $e) { 
            $err[] = $e->getMessage();
          }
        }

        foreach($err as $error) {
            echo $error . "\n";
        } 
      ?>
      </pre>
      <section id="inputSection">
        <input type="text" name="op1" id="name" value="" />
        <input type="text" name="op2" id="name" value="" />
      </section>
      <!-- Only one of these will be set with their respective value at a time -->
      <section id="basicOps">
        <input type="submit" name="add" value="Add" />  
        <input type="submit" name="sub" value="Subtract" />  
        <input type="submit" name="mult" value="Multiply" />  
        <input type="submit" name="divi" value="Divide" />  
      </section>
      <section id="powerOps">
        <input type="submit" name="10tovar" value="10^x" />
        <input type="submit" name="etovar" value="e^x" />
        <input type="submit" name="varto2" value="x^2" />
        <input type="submit" name="vartovar" value="x^y" />
<<<<<<< HEAD
=======
        
>>>>>>> c5cfb69a229db63be215eb0ffc29fc56f428687a
      </section>
      
    </form>
  </section>
</body>
</html>

