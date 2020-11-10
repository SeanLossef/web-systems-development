<?php
// Operation with single operand
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

// Operation with 2 operands
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

// subclasses for exponentials
class TentoVar extends SingleOp {
  public function operate() {
    return pow(10, $this->operand_1);
  }
  public function getEquation() {
    return '10<sup>' . $this->operand_1 . '</sup> = ' . $this->operate();
  }
}
class EtoVar extends SingleOp {
  public function operate() {
    return exp($this->operand_1);
  }
  public function getEquation() {
    return 'e<sup>' . $this->operand_1 . '</sup> = ' . $this->operate();
  }
}

// subclasses for x^2 & x^y
class varto2 extends SingleOp {
  public function operate() {
    return pow($this->operand_1, 2);
  }
  public function getEquation() {
    return  $this->operand_1 . '<sup>2</sup>'.' = '. $this->operate();
  }
}
class vartovar extends Operation {
  public function operate() {
    return pow($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return $this->operand_1.'<sup>' . $this->operand_2 . '</sup> = ' . $this->operate();
  }
}
class SquareRoot extends SingleOp {
  public function operate() {
    return sqrt($this->operand_1);
  }
  public function getEquation() {
    return 'sqrt(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

// subclasses for trig functions
class SinOp extends SingleOp {
  public function operate() {
    return sin($this->operand_1);
  }
  public function getEquation() {
    return 'sin(' . $this->operand_1 . ') = ' . $this->operate();
  }
}
class CosOp extends SingleOp {
  public function operate() {
    return cos($this->operand_1);
  }
  public function getEquation() {
    return 'cos(' . $this->operand_1 . ') = ' . $this->operate();
  }
}
class TanOp extends SingleOp {
  public function operate() {
    return tan($this->operand_1);
  }
  public function getEquation() {
    return 'tan(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

// Log and Ln
class Log extends Operation {
  public function operate() {
    return log($this->operand_1, $this->operand_2);
  }
  public function getEquation() {
    return 'log<sub>'.$this->operand_2 . "</sub>(" . $this->operand_1 . ') = ' . $this->operate();
  }
}
class ln extends SingleOp {
  public function operate() {
    return log($this->operand_1);
  }
  public function getEquation() {
    return 'ln(' . $this->operand_1 . ') = ' . $this->operate();
  }
}

// Get POST vars if calculation submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $o1 = $_POST['op1'];
  $o2 = $_POST['op2'];
}
$err = Array();

// Try to calculate
try {
  if (isset($_POST['add']))      $op = new Addition($o1, $o2);
  if (isset($_POST['sub']))      $op = new Subtraction($o1, $o2);
  if (isset($_POST['divi']))     $op = new Division($o1, $o2);
  if (isset($_POST['mult']))     $op = new Multiplication($o1, $o2);
  if (isset($_POST['10tovar']))  $op = new TentoVar($o1);
  if (isset($_POST['etovar']))   $op = new EtoVar($o1);
  if (isset($_POST['varto2']))   $op = new varto2($o1);
  if (isset($_POST['vartovar'])) $op = new vartovar($o1, $o2);
  if (isset($_POST['sin']))      $op = new SinOp($o1);
  if (isset($_POST['cos']))      $op = new CosOp($o1);
  if (isset($_POST['tan']))      $op = new TanOp($o1);
  if (isset($_POST['sqrt']))     $op = new SquareRoot($o1);
  if (isset($_POST['log']))      $op = new Log($o1, $o2); 
  if (isset($_POST['ln']))       $op = new ln($o1, $o2);
}

// Show error
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
      <pre id="result"><?php if (isset($op)) echo $op->getEquation(); else echo "Welcome." ?></pre>
      <?php
          foreach($err as $error) {
            echo $error . "\n";
          } 
      ?>
      
      <section id="inputSection">
        <input type="text" name="op1" id="name" value="" />
        <input type="text" name="op2" id="name" value="" />
      </section>

      <!-- Only one of these will be set with their respective value at a time -->
      <section id="basicOps">
        <input type="submit" name="add" value="Add" />  
        <input type="submit" name="sub" value="Sub" />  
        <input type="submit" name="mult" value="Mult" />  
        <input type="submit" name="divi" value="Div" />  
        <input type="submit" name="10tovar" value="10^x" />
        <input type="submit" name="etovar" value="e^x" />
        <input type="submit" name="varto2" value="x^2" />
        <input type="submit" name="vartovar" value="x^y" />
        <input type="submit" name="sin" value="sin(x)" />
        <input type="submit" name="cos" value="cos(x)" />
        <input type="submit" name="tan" value="tan(x)" />
        <input type="submit" name="sqrt" value="sqrt(x)" />
        <input type="submit" name="log" value="log" />
        <input type="submit" name="ln" value = "ln" />
      </section>
    </form>
  </section>
</body>
</html>