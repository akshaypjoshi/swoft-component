<?php declare(strict_types=1);


namespace SwoftTest\Unit;


use PHPUnit\Framework\TestCase;
use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Co;
use Swoft\Context\Context;
use Swoft\Exception\SwoftException;
use Swoft\Timer;
use SwoftTest\Testing\TestContext;

/**
 * Class TimerTest
 *
 * @since 2.0
 */
class TimerTest extends TestCase
{
    /**
     * @var int
     */
    private $tick = 0;

    /**
     * @var int
     */
    private $after = 0;

    /**
     * @throws ContainerException
     * @throws ReflectionException
     */
    public function setUp()
    {
        Context::set(TestContext::new());
    }

    /**
     * @throws ReflectionException
     * @throws ContainerException
     * @throws SwoftException
     */
    public function testTick()
    {
        $a   = 1;
        $tid = Timer::tick(500, function ($a) {
            $this->tick++;
        }, $a);

        Co::sleep(1);
        Timer::clear($tid);

        $this->assertEquals($this->tick, 2);
    }

    /**
     * @throws ContainerException
     * @throws ReflectionException
     * @throws SwoftException
     */
    public function testAfter()
    {
        $a = 1;
        Timer::after(500, function ($a) {
            $this->after++;
        }, $a);

        Co::sleep(1);

        $this->assertEquals($this->after, 1);
    }
}