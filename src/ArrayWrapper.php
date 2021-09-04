<?php

namespace Realitaetsverlust\Wrapper;

use \Iterator;

class ArrayWrapper implements Iterator {
    /**
     * @var array Array content
     */
    private array $array;

    /**
     * @var int the internal position in the array used in iterations
     */
    private int $position = 0;

    public function __construct(array $array) {
        $this->array = $array;
    }

    /**
     * Adds element to the array. Duplicate keys throw an exception, unless $overwrite is set to true
     *
     * @param mixed $key Key of the newly added element
     * @param mixed $value Value of the newly added element
     * @param bool $overwrite Overwrite existing keys instead of throwing an exception
     */
    public function add($key, $value): ArrayWrapper {
        $this->addElement($key, $value);
        return $this;
    }

    /**
     * Removes element from the array
     * @param $key
     */
    public function remove($key): ArrayWrapper {
        $this->removeElement($key);
        return $this;
    }

    /**
     * Extracts the array from wrapper for native usage
     *
     * @return array|null
     */
    public function extract(): ?array {
        return $this->array;
    }

    /**
     * Wrapper for count().
     */
    public function count(): int {
        return count($this->array);
    }


    public function sort(string $sortMode): void {

    }

    /**
     * Merges two arrays into one.
     *
     * @param ArrayWrapper $array the array to merge
     */
    public function merge(ArrayWrapper $array): ArrayWrapper {
        $this->array = array_merge($this->extract(), $array->extract());
        return $this;
    }

    /**
     * Checks if a given key exists in the array
     * @param string $keyName The key to find
     * @return bool
     */
    public function exists(string $keyName): bool {
        return isset($this->array[$keyName]);
    }

    // Iterator-Stubs
    /**
     * Fetches current element
     * @return mixed
     */
    public function current() {
        return $this->array[array_keys($this->array)[$this->position]];
    }

    /**
     * Fetches current key
     * @return bool|float|int|string|null
     */
    public function key() {
        return array_keys($this->array)[$this->position];
    }

    /**
     * Increases position counter by one
     */
    public function next() {
        ++$this->position;
    }

    /**
     * Checks if element is valid
     * @return bool
     */
    public function valid() {
        return isset($this->array[array_keys($this->array)[$this->position]]);
    }

    /**
     * Resets position to 0
     */
    public function rewind() {
        $this->position = 0;
    }

    // Internal functions
    /**
     * Used internally to add an element to the array
     *
     * @param mixed $key Key to add
     * @param mixed $value Value to add
     */
    private function addElement($key, $value): void {
        $this->array[$key] = $value;
    }

    /**
     * Used internally to remove an element from the array
     *
     * @param mixed $key Key to add
     */
    private function removeElement($key) {
        unset($this->array[$key]);
    }
}