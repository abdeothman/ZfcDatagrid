<?php
namespace ZfcDatagridTest;

use PHPUnit_Framework_TestCase;
use ZfcDatagrid\Filter;

/**
 * @covers ZfcDatagrid\Filter
 */
class FilterTest extends PHPUnit_Framework_TestCase
{

    private $column;

    public function setUp()
    {
        $this->column = $this->getMockForAbstractClass('ZfcDatagrid\Column\AbstractColumn');
    }

    public function tearDown()
    {
        $this->column = null;
    }

    public function testDefaultOperator()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, 'test');
        $this->assertEquals($this->column, $filter->getColumn());
        $this->assertEquals(Filter::LIKE, $filter->getOperator());
        $this->assertEquals('~ *test*', $filter->getDisplayColumnValue());
        $this->assertTrue(is_array($filter->getValues()));
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        $this->assertTrue($filter->isColumnFilter());
    }

    public function testLike()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~test');
        $this->assertEquals(Filter::LIKE, $filter->getOperator());
        $this->assertEquals('~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~*test*');
        $this->assertEquals(Filter::LIKE, $filter->getOperator());
        $this->assertEquals('~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 3
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~%test%');
        $this->assertEquals(Filter::LIKE, $filter->getOperator());
        $this->assertEquals('~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testLikeLeft()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~%test');
        $this->assertEquals(Filter::LIKE_LEFT, $filter->getOperator());
        $this->assertEquals('~ *test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~*test');
        $this->assertEquals(Filter::LIKE_LEFT, $filter->getOperator());
        $this->assertEquals('~ *test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testLikeRight()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~test%');
        $this->assertEquals(Filter::LIKE_RIGHT, $filter->getOperator());
        $this->assertEquals('~ test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '~test*');
        $this->assertEquals(Filter::LIKE_RIGHT, $filter->getOperator());
        $this->assertEquals('~ test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testNotLike()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~test');
        $this->assertEquals(Filter::NOT_LIKE, $filter->getOperator());
        $this->assertEquals('!~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~*test*');
        $this->assertEquals(Filter::NOT_LIKE, $filter->getOperator());
        $this->assertEquals('!~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 3
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~%test%');
        $this->assertEquals(Filter::NOT_LIKE, $filter->getOperator());
        $this->assertEquals('!~ *test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testNotLikeLeft()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~%test');
        $this->assertEquals(Filter::NOT_LIKE_LEFT, $filter->getOperator());
        $this->assertEquals('!~ *test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~*test');
        $this->assertEquals(Filter::NOT_LIKE_LEFT, $filter->getOperator());
        $this->assertEquals('!~ *test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testNotLikeRight()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~test%');
        $this->assertEquals(Filter::NOT_LIKE_RIGHT, $filter->getOperator());
        $this->assertEquals('!~ test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!~test*');
        $this->assertEquals(Filter::NOT_LIKE_RIGHT, $filter->getOperator());
        $this->assertEquals('!~ test*', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testEqual()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '=test');
        $this->assertEquals(Filter::EQUAL, $filter->getOperator());
        $this->assertEquals('= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '==test');
        $this->assertEquals(Filter::EQUAL, $filter->getOperator());
        $this->assertEquals('= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Case 3
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '==test,value2');
        $this->assertEquals(Filter::EQUAL, $filter->getOperator());
        $this->assertEquals('= test,value2', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test',
            'value2'
        ), $filter->getValues());
    }

    public function testNotEqual()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!test');
        $this->assertEquals(Filter::NOT_EQUAL, $filter->getOperator());
        $this->assertEquals('!= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
        
        /*
         * Equal 2
         */
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!=test');
        $this->assertEquals(Filter::NOT_EQUAL, $filter->getOperator());
        $this->assertEquals('!= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testGreaterEqual()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '>=test');
        $this->assertEquals(Filter::GREATER_EQUAL, $filter->getOperator());
        $this->assertEquals('>= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testGreater()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '>test');
        $this->assertEquals(Filter::GREATER, $filter->getOperator());
        $this->assertEquals('> test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testLessEqual()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '<=test');
        $this->assertEquals(Filter::LESS_EQUAL, $filter->getOperator());
        $this->assertEquals('<= test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testLess()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '<test');
        $this->assertEquals(Filter::LESS, $filter->getOperator());
        $this->assertEquals('< test', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            'test'
        ), $filter->getValues());
    }

    public function testIn()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '=(test,test2)');
        $this->assertEquals(Filter::IN, $filter->getOperator());
        $this->assertEquals('=(test,test2)', $filter->getDisplayColumnValue());
        
        // @todo wrong?
        $this->assertEquals(array(
            'test',
            'test2'
        ), $filter->getValues());
    }

    public function testNotIn()
    {
        $filter = new Filter();
        
        $filter->setFromColumn($this->column, '!=(test,test2)');
        $this->assertEquals(Filter::NOT_IN, $filter->getOperator());
        $this->assertEquals('!=(test,test2)', $filter->getDisplayColumnValue());
        
        // @todo wrong?
        $this->assertEquals(array(
            'test',
            'test2'
        ), $filter->getValues());
    }

    public function testBetween()
    {
        $filter = new Filter();
        $filter->setFromColumn($this->column, '2<>3');
        
        $this->assertEquals(Filter::BETWEEN, $filter->getOperator());
        $this->assertEquals('2 <> 3', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            '2',
            '3'
        ), $filter->getValues());
        
        $filter = new Filter();
        $filter->setFromColumn($this->column, '2<>3 <>4');
        
        $this->assertEquals(Filter::BETWEEN, $filter->getOperator());
        $this->assertEquals('2 <> 3', $filter->getDisplayColumnValue());
        $this->assertEquals(array(
            '2',
            '3'
        ), $filter->getValues());
    }
}
