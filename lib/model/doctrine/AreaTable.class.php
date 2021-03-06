<?php

/**
 * AreaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AreaTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object AreaTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Area');
    }
    
  const
    STATUS_ACTIVE       = 1,
    STATUS_INACTIVE     = 0;
    
  protected static
    $status                = array
                             (
                               self::STATUS_ACTIVE     => 'Si',
                               self::STATUS_INACTIVE   => 'No',
                             );
                             
  public function getStatuss()
  {
    return self::$status;
  }	
  
  public function getNewRank()
  {
  	 $q = $this->createQuery('a')
  	           ->addSelect('MAX(rank)');
  	           
  	 $dato = $q->execute()->getFirst()->toArray();
  	 return $dato['MAX']+1;
  	 
  }    
  
 function updateQueryForList(DoctrineQuery $q)
  {             
    $q->addSelect("a.*, CONCAT(t.firstname,' ', t.lastname) representative_name")
      ->leftJoin('a.Representative t');
  } 
  
  function getListOfAreas()
  {
      $q = $this->createQuery('a')->addSelect('a.id, a.name');
      $datos = $q->execute();
      $result = array();
      foreach($datos as $dato)
      {
          $result[$dato->getId()] = $dato->getName();
      }
      return $result;
  }
}