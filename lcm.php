<?php
class LCM
{
  protected $equation = '';

  protected $solution = 'SOLUTION';

  protected $solution_set = array();

  protected $term_var_map = array();

  protected $terms = array();


  public function __construct(){

  }


  public function addTerm($coef, $var, $exp=1){
    if(empty($var)){
      $exp = 0;
    }
    if($exp==0){
      $var = '';
    }
    $this->terms[] = array('coef' => $coef, 'var' => $var, 'exp' => $exp);
    if(!empty($var)){
      $this->term_var_map[count($this->terms)-1] = $var;
    }
  }


  public function evaluateTermVarsForSolutionValue($value=null){
    $value         = ($value!=null) ? $value : $this->solution;
    $num_of_terms  = count($this->terms);
    $term_solution = $value/$num_of_terms;
    $solution_set  = array();

    foreach($this->terms as $a => $term){
      $var = $this->term_var_map[$a];
      $solution_set[$a][$var] = $term_solution;

      if(!in_array($term['coef'], array(0,1))) $solution_set[$a][$var] = $solution_set[$a][$var]/$term['coef'];

      if(!in_array($term['exp'], array(0,1))) $solution_set[$a][$var] = pow($solution_set[$a][$var],1/$term['exp']);
      elseif ($term['exp'] == 0) $solution_set[$a][$var] = 1;
    }

    return $this->solution_set = $solution_set;
  }


  public function getTermVarMap(){
    return $this->term_var_map;
  }


  public function setSolutionValue($value){
    $this->solution = $value;
  }


  public function toString(){
    foreach($this->terms as $a => $term){
      $_term = '';

      if($term['coef']<0) $_term .= "(";

      if($term['coef']<>0 and $term['coef']!=1) $_term .= "{$term['coef']}";

      if(!empty($term['var'])) $_term .= "{$term['var']}";

      if(!empty($term['exp']) and $term['exp']!=1) $_term .= "^{$term['exp']}";

      if($term['coef']<0) $_term .= ")";

      if(strlen($equation)>0) $equation .= ' + ';

      $equation .= $_term;
    }

    return $this->equation = $equation;
  }
}
?>
