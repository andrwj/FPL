<?php
/**
 * Functional Programming Helper functions
 */
namespace Ntuple\FPL;

/**
 * 블럭 또는 표현식을 재사용하기 위해 try-catch 영역을 함수화 한다.
 * @param $expr callable 콜백함수
 * @param $default_value null 예외 발생시 catch() 에서 리턴할 값
 * @return array
 */
function tryCatch(callable $expr, $default_value = NULL) : array
{
    try {
        return [true, $expr()];
    } catch(\Exception $e) {
        return [false, ($default_value !== NULL) ? $default_value : $e];
    }
}

/**
 * 주어진 값 그대로 리턴하는 함수
 * @param $value  임의의 값
 * @return mixed
 */
function identity($value)
{
   return $value;
}

/**
 * 무조건 실패를 돌려주는 함수
 * @return null
 */
function revoke()
{
    return null;
}

/**
 * 주어진 값을 평가하여 Boolean 값으로 리턴
 * @param $value
 * @return bool
 */
function truth($value) : bool
{
    return !!$value;
}

/**
 * 아무것도 하지않는 함수. 고계함수의 기본값으로 사용되기도 한다
 */
function Noop(): void
{

}

/**
 * if..then..else 구문 블럭을 재사용하기 위함. 모든 인수는 함수인 것에 주의!
 * @param $condition
 * @param $on_true
 * @param $on_false
 * @return mixed
 */
function if_then_else( callable $condition, callable $on_true, callable $on_false = Noop)
{
    $values = tryCatch( $condition );
    return ($values[0] === true) ? $on_true() : $on_false();
}