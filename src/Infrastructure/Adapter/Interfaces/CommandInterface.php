<?php


namespace App\Infrastructure\Adapter\Interfaces;


/**
 * Interface qui impose les méthodes de base au Commande
 *
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter\Interfaces
 */
Interface CommandInterface
{
    /**
     * @param $objectDto
     * @return mixed
     */
    public function create($objectDto);

    /**
     * @param $objectDto
     * @return mixed
     */
    public function update($objectDto);

    /**
     * @param $object
     * @return mixed
     */
    public function delete($object);

}