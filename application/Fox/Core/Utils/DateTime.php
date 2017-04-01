<?php
namespace Fox\Core\Utils;

class DateTime
{
    protected $dataFormat;

    protected $timeFormat;

    protected $timezone;

    protected $internalDateTimeFormat = 'Y-m-d H:i:s';

    protected $internalDateFormat = 'Y-m-d';

    protected $dateFormats = array(
        'MM/DD/YYYY' => 'm/d/Y',
        'YYYY-MM-DD' => 'Y-m-d',
        'DD.MM.YYYY' => 'd.m.Y',
        'DD/MM/YYYY' => 'd/m/Y',
    );

    protected $timeFormats = array(
        'HH:mm' => 'H:i',
        'hh:mm A' => 'h:i A',
        'hh:mm a' => 'h:ia',
        'hh:mmA' => 'h:iA',
    );

    public function __construct()
    {
        $this->dateFormat = C('dateFormat', 'YYYY-MM-DD');
        $this->timeFormat = C('timeFormat', 'HH:mm');

        $this->timezone = new \DateTimeZone(C('timeZone', 'UTC'));
    }

    public function getInternalDateTimeFormat()
    {
        return $this->internalDateTimeFormat;
    }

    public function getInternalDateFormat()
    {
        return $this->internalDateFormat;
    }

    protected function getPhpDateFormat()
    {
        return $this->dateFormats[$this->dateFormat];
    }

    protected function getPhpDateTimeFormat()
    {
        return $this->dateFormats[$this->dateFormat] . ' ' . $this->timeFormats[$this->timeFormat];
    }

    public function convertSystemDateToGlobal($string)
    {
        return $this->convertSystemDate($string);
    }

    public function convertSystemDateTimeToGlobal($string)
    {
        return $this->convertSystemDateTime($string);
    }

    public function convertSystemDate($string)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $string);
        if ($dateTime) {
            return $dateTime->format($this->getPhpDateFormat());
        }
        return null;
    }

    public function convertSystemDateTime($string, $timezone = null)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $string);
        if (empty($timezone)) {
            $timezone = $this->timezone;
        } else {
            $timezone = new \DateTimeZone($timezone);
        }
        if ($dateTime) {
            return $dateTime->setTimezone($timezone)->format($this->getPhpDateTimeFormat());
        }
        return null;
    }

}


