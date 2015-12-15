<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class String extends Type
{
    /**
     * @var null
     */
    private $innerString;

    /**
     * @param null $string
     * @throws CriticalTypeException
     */
    public function __construct($string = null)
    {
        $this->typeCheck($string);

        $this->innerString = $string;
    }
    /**
     * @param $string
     * @throws CriticalTypeException
     */
    public function setType($string)
    {
        $this->typeCheck($string);

        $this->innerString = $string;
    }
    /**
     * @param String $toCheck
     * @return bool
     */
    public function equals(String $toCheck)
    {
        if (strcmp($this->innerString, $toCheck->toString()) === 0) {
            return true;
        }

        return false;
    }
    /**
     * @param String $string
     * @param bool|false $immutable
     * @return $this|String
     */
    public function concat(String $string, $immutable = false)
    {
        $tempString = $this->innerString.$string->toString();

        if ($immutable === true) {
            return new String($tempString);
        }

        $this->innerString = $tempString;

        return $this;
    }
    /**
     * @param String $toRemove
     * @param bool|false $immutable
     * @return $this|bool|String
     * @throws CriticalTypeException
     */
    public function remove(String $toRemove, $immutable = false)
    {
        $actualString = $toRemove->toString();

        $pattern = '#'.$actualString.'#';

        $success = preg_match($pattern, $this->innerString, $match);

        if ($success === 0 or $success === false) {
            return false;
        }

        if ($success === 1 and strcmp($actualString, $match[0] === 0)) {
            $tempString = preg_replace($pattern, '', $this->innerString);
            if ($immutable === true) {
                if (empty($tempString)) {
                    throw new CriticalTypeException('String: String::remove() has removed the portion that you specified but the new string is empty (\'\') so a new String object cannot be created. Try without the second parameter');
                }

                return new String($tempString);
            }

            $this->innerString = $tempString;

            return $this;
        }

        return false;
    }
    /**
     * @param String $toSearch
     * @return bool
     */
    public function search(String $toSearch)
    {
        $actualString = $toSearch->toString();
        $pattern = '#'.$actualString.'#';

        $success = preg_match($pattern, $this->innerString, $match);

        if ($success === 1 and strcmp($actualString, $match[0]) === 0) {
            return true;
        }

        return false;
    }
    /**
     * @param $pattern
     * @return bool
     */
    public function regexSearch($pattern)
    {
        $success = preg_match($pattern, $this->innerString, $match);

        if ($success === 1) {
            return true;
        }

        return false;
    }
    /**
     * @param String $toExtract
     * @return bool|String
     */
    public function extract(String $toExtract)
    {
        if (!$this->search($toExtract)) {
            return false;
        }

        $actualString = $toExtract->toString();

        $pattern = '#'.$actualString.'#';

        $success = preg_match($pattern, $this->innerString, $match);

        if ($success === 1 and strcmp($actualString, $match[0]) === 0) {
            return new String($match[0]);
        }

        return false;
    }
    /**
     * @param String $toReplace
     * @param String $replacement
     * @return bool
     */
    public function replace(String $toReplace, String $replacement)
    {
        if (!$this->search($toReplace)) {
            return false;
        }

        $toReplaceActual = $toReplace->toString();

        $replacementActual = $replacement->toString();

        $pattern = '#'.$toReplaceActual.'#';

        $replaced = preg_replace($pattern, $replacementActual, $this->innerString);

        if (strcmp($replaced, $this->innerString) === 0) {
            return false;
        }

        if ($replaced === null) {
            return false;
        }

        $this->innerString = $replaced;

        return true;
    }
    /**
     * @param $regexSearch
     * @param String $replacement
     * @return bool
     */
    public function regexReplace($regexSearch, String $replacement)
    {
        $actualReplacement = $replacement->toString();

        $replaced = preg_replace($regexSearch, $actualReplacement, $this->innerString);

        if (strcmp($replaced, $this->innerString) === 0) {
            return false;
        }

        if ($replaced === null) {
            return false;
        }

        $this->innerString = $replaced;

        return true;
    }
    /**
     * @return bool
     */
    public function length()
    {
        return ($this->innerString !== '') ? strlen($this->innerString) : null;
    }
    /**
     * @return null
     */
    public function toString()
    {
        return $this->innerString;
    }
    /**
     * @param string $string
     * @throws CriticalTypeException
     */
    private function typeCheck($string)
    {
        if ($string !== null) {
            if (!is_string($string)) {
                throw new CriticalTypeException("String: String() constructor called with an argument that is not a string. Makes sense for a String to receive a string, don't you think?");
            }
        }
    }
} 