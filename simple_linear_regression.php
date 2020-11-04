<?php

class SimpleLinearRegression
{

    public $x;
    public $y;
    public $len_x;

    function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->len_x = count($this->x);
    }

    function ave()
    {
        $len_y = count($this->y);
        $sum_x = array_sum($this->x);
        $sum_y = array_sum($this->y);
        return array($sum_x / $this->len_x, $sum_y / $len_y);
    }

    function var_x()
    {
        $sum = 0;
        for ($i = 0; $i < $this->len_x; $i++) {
            $sum += ($this->x[$i] - $this->ave()[0]) * ($this->x[$i] - $this->ave()[0]);
        }
        return $sum / $this->len_x;
    }

    function cov()
    {
        $sum = 0;
        for ($i = 0; $i < $this->len_x; $i++) {
            $sum += ($this->x[$i] - $this->ave()[0]) * ($this->y[$i] - $this->ave()[1]);
        }
        return $sum / $this->len_x;
    }

    function coef()
    {
        return $this->cov() / $this->var_x();
    }

    function intercept()
    {
        return $this->ave()[1] - $this->coef() * $this->ave()[0];
    }

    function print_func()
    {
        return "解析結果: y = {$this->coef()}x + ({$this->intercept()})";
    }

    function predict($x)
    {
        $result = array();
        for ($i = 0; $i < count($x); $i++) {
            array_push($result, $this->coef() * $x[$i] + $this->intercept());
        }
        return $result;
    }
}

// Example
$x = array(1,2,3,4,5,6,7,8,9,10);
$y = array(39343, 43525, 60150, 55794, 66029, 93940, 98273, 101302, 105582, 122391);
$slr = new SimpleLinearRegression($x, $y);
echo $slr->print_func();
echo "\n";
echo "入力: ";
$input = fgets(STDIN);
echo $slr->predict(array($input))[0];
