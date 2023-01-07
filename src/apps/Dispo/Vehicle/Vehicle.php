<?php

namespace App\apps\Dispo\Vehicle;


abstract class Vehicle
{
    public int $miles;
    public string $brand;
    public int $hp;




    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }


    /**
     * @return int
     */
    public function getHp(): int
    {
        return $this->hp;
    }

    /**
     * @return int
     */
    public function getMiles(): int
    {
        return $this->miles;
    }
    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @param int $hp
     */
    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }

    /**
     * @param int $miles
     */
    public function setMiles(int $miles): void
    {
        $this->miles = $miles;
    }

}