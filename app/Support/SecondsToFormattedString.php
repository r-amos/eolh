<?php

namespace App\Support;

class SecondsToFormattedString
{
    /**
     * @const int
     */
    private const HOUR = 0;

    /**
     * @const int
     */
    private const MINUTE = 1;

    /**
     * @const int
     */
    private const SECOND = 2;

    /**
     *
     * @var array
     */
    public static $elements = [
        SecondsToFormattedString::HOUR   => 'Hour',
        SecondsToFormattedString::MINUTE => 'Minute',
        SecondsToFormattedString::SECOND => 'Second'
    ];

    /**
     * Seconds Be Converted To Human Readable String
     *
     * @var integer
     */
    private $seconds = 0;

    /**
     *
     * @param integer $seconds
     * @return void
     */
    public function setSeconds(int $seconds): void
    {
        $this->seconds = $seconds;
    }

    /**
     * Helper To Return The Hours From Seconds
     * 
     * @param integer $seconds
     * @return float
     */
    private function getHours(): float
    {
        return floor($this->seconds / 3600);
    }

    /**
     * Helper To Return The Minutes Remaining After Diving By Hours
     *
     * @param integer $seconds
     * @return integer
     */
    private function getMinutes(): int
    {
        $minutes = floor($this->seconds / 60);
        $remainder = $minutes % 60;
        if ($minutes == 1) {
            return 1;
        }
        return $remainder;
    }

    /**
     * Helper To Return The Remainder In Seconds After Dividing Into Minutes
     * 
     * @param integer $seconds
     * @return integer
     */
    private function getSeconds(): int
    {
        return $this->seconds % 60;
    }

    /**
     *
     * @return array
     */
    private function getArrayOfTimeElements(): array
    {
        return [
            static::$elements[static::HOUR]     => $this->getHours(),
            static::$elements[static::MINUTE]   => $this->getMinutes(),
            static::$elements[static::SECOND]   => $this->getSeconds()
        ];
    }

    /**
     * Format Seconds To Human Readable String
     *
     * @return string
     */
    public function convert(): string
    {
        $formattedOutput = "";
        $firstItem = false;
        $time = array_filter($this->getArrayOfTimeElements());
        foreach (array_reverse($time) as $unit => $amount) {
            $formattedUnit = str_plural($unit, $amount);
            if (!$firstItem && count($time) > 1) {
                $formattedOutput = "and $amount " . $formattedUnit;
                $firstItem = true;
            } else {
                $existingOutput = $formattedOutput;
                $formattedOutput = "$amount " .  $formattedUnit;
                if (!empty($existingOutput)) {
                    $formattedOutput .= " $existingOutput";
                }
            }
        }
        return $formattedOutput;
    }
}
