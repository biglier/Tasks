<?php
class ReadingList
{
    public $stack;
    protected $limit;

    public function __construct($limit = 400) {

        $this->stack = array();

        $this->limit = $limit;


    }

    public function push($item) {

        if (count($this->stack) < $this->limit) {

            array_unshift($this->stack, $item);
        } else {
            throw new RunTimeException(' ');
        }
    }

    public function pop() {
        if ($this->isEmpty()) {

	      throw new RunTimeException(' ');
	  } else {

            return array_shift($this->stack);

        }
    }

    public function top() {
        return current($this->stack);
    }

    public function isEmpty() {
        return empty($this->stack);
    }

    public function get_size(){
      return count($this->stack);
    }
}

$inputFile = fopen('php://stdin', 'r');
$outputFile = fopen('php://stdout', 'w');
$input = array();
$n = 0;
while (!feof($inputFile)) {
    fscanf($inputFile, '%s', $input[]);
}

$output = array();
$i=1;
$count = count($input);
while($i<$count) {
  $output[]= polka($input[$i]);
  $i++;
}
$outputFile = fopen('php://stdout', 'w');
foreach ($output as  $value) {
   fwrite($outputFile, sprintf("%s\n", $value));
}
fclose($outputFile);
fclose($inputFile);
function polka($expression){

$priority = [1=>'^','*','/','+','-'];
$out ='';
$stack = new ReadingList();
try{
   $len= strlen($expression);
  for ($i=0; $i < $len; $i++) {

  if($expression[$i]=='('){
    $stack->push($expression[$i]);
  }
  elseif ($expression[$i]==')'){
    while ($stack->top()!='('){
    if($stack->get_size()!=0){
      $out.= $stack->pop();
    }
}
    $stack->pop();
  }
  elseif (in_array($expression[$i], $priority)){
    if(in_array($stack->top(),$priority)){
      if(intdiv(array_search($expression[$i], $priority),2)
      <(intdiv(array_search($stack->top(), $priority),2))){
        $out.= $expression[$i];
      }

        else{
          if($stack->get_size()>0)
          $out.=$stack->pop();
          $stack->push($expression[$i]);
        }
    }
    else {
      $stack->push($expression[$i]);
    }

  }

  else{
     $out.=$expression[$i];

  }
}}
catch(RunTimeException $e){
}
if($stack->get_size()>0)
      $out.=$stack->pop();
return $out;
}
