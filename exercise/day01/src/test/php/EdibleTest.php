<?php

use Food\Food;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class EdibleTest extends TestCase
{
    private static $expirationDate;
    private static $inspector;
    private static $notFreshDate;
    private static $freshDate;

    public static function setUpBeforeClass(): void
    {
        self::$expirationDate = Carbon::createFromDate(2023, 12, 1);
        self::$inspector = Uuid::uuid4();
        self::$notFreshDate = self::$expirationDate->copy()->addDays(7);
        self::$freshDate = self::$expirationDate->copy()->subDays(7);
    }

    public static function notEdibleFoodDataProvider(): array
    {
        return [
            [true, self::$inspector, self::$notFreshDate],
            [false, self::$inspector, self::$freshDate],
            [true, null, self::$freshDate],
            [false, null, self::$notFreshDate],
            [false, null, self::$freshDate],
        ];
    }

    /**
     * @dataProvider notEdibleFoodDataProvider
     */
    public function testNotEdibleIfNotFresh(bool $approvedForConsumption, $inspectorId, $now): void
    {
        $food = new Food(
            $approvedForConsumption,
            $inspectorId,
            self::$expirationDate
        );

        $this->assertFalse($food->isEdible($now));
    }

    public function testEdibleFood(): void
    {
        $food = new Food(
            approvedForConsumption: true,
            inspectorId: self::$inspector,
            expirationDate: self::$expirationDate
        );

        $this->assertTrue($food->isEdible(self::$freshDate));
    }
}