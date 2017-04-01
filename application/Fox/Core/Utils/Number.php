<?php
namespace Fox\Core\Utils;

class Number
{
    protected $decimalMark;

    protected $thousandSeparator;

    public function __construct()
    {
        $this->decimalMark = C('decimalMark', '.');
        $this->thousandSeparator = C('thousandSeparator', ',');
    }

    public function format($value, $decimals = null)
    {
        if (!is_null($decimals)) {
             return number_format($value, $decimals, $this->decimalMark, $this->thousandSeparator);
        } else {
            $s = strval($value);
            $arr = explode('.', $value);

            $r = '0';
            if (!empty($arr[0])) {
                $r = number_format(intval($arr[0]), 0, '.', $this->thousandSeparator);
            }

            if (!empty($arr[1])) {
                $r = $r . $this->decimalMark . $arr[1];
            }

            return $r;
        }
    }

}
