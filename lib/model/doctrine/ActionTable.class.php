<?php

/**
 * ActionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ActionTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object ActionTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Action');
    }
}