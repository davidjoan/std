<?php

/**
 * RecordTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RecordTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object RecordTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Record');
    }
    
  const
    STATUS_PENDING     = 1,
    STATUS_RECEIVED    = 2,
    STATUS_DERIVED     = 3,
    STATUS_RETURNED    = 4,
    STATUS_COMPLETED   = 5;
  
  
  protected static
    $status                = array
                             (
                               ''                       => '--- Todos ---',
                               self::STATUS_PENDING     => 'Pendiente',
                               self::STATUS_RECEIVED    => 'Recibido',
                               self::STATUS_DERIVED     => 'Derivado',
                               self::STATUS_RETURNED    => 'Devuelto',
                               self::STATUS_COMPLETED   => 'Finalizado',
                             );
  
  protected static
    $color                = array(
    self::STATUS_PENDING     => 'purple',
    self::STATUS_RECEIVED    => 'orange',
    self::STATUS_DERIVED     => 'skyblue',
    self::STATUS_RETURNED    => 'red',
    self::STATUS_COMPLETED   => 'green');  
  
  
  public function getStatuss()
  {
    return self::$status;
  }
  
  public function getColors()
  {
    return self::$color;
  }  
  public function findNextCode()
  {
    $q = $this->createAliasQuery();
    
    $qty = $q->count();
    $code   = $qty+1;
    $year = date('Y');
    
    return str_pad($code, 8, '0', STR_PAD_LEFT).'-'.$year;
  }
  
  public function getOtherAreas($area_id)
  {
  	 $q = Doctrine_Query::create()
              ->select('*')
              ->from('Area a');
             
         if($area_id <> null)
         {
           $q->where('a.id <> ?', $area_id);
         }
             
  	 return $q;
  } 
  
   public function updateQueryForList(DoctrineQuery $q, $params)
  {
       
           $query = Doctrine_Query::create()
             ->select('COUNT(d.id)')
             ->from('Document d')
             ->where('d.record_id = r.id');

     $q->addSelect("r.*, CONCAT(u.first_name,' ', u.last_name) user_name, fa.name area_origen_name, ta.name area_destino_name, (".$query->getDql().") documents_number")
      ->leftJoin('r.FromArea fa')
      ->leftJoin('r.ToArea ta')
      ->leftJoin('r.User u');
       
      if($params['from'] <> '0' and $params['to'] <> '0')
      {
        $q->andIntervalWhere('r.created_at',$params['from'], $params['to']);    
      }
      
    if($params['record_status'])
    {
        if($params['record_status'] == '100')
        {
          $q->whereIn('r.status',array(RecordTable::STATUS_PENDING, RecordTable::STATUS_DERIVED));
        }
        else
        {
          $q->andWhere('r.status = ?', $params['record_status']);          
        }
     
    }

    if($params['area'])
    {
        if($params['tipo'] == 1)
        {
          $q->andWhere('r.to_area_id = ?', $params['area']);          
        }
        elseif ($params['tipo'] == 0) {
            $q->andWhere('r.from_area_id = ?', $params['area']);          
        }
      
    }
    
    $area_id = sfContext::getInstance()->getUser()->getAreaId();
    
    $q->andWhere('(r.from_area_id = ? OR r.to_area_id = ?)', array($area_id, $area_id));
    
    return $q;
  }
  
  public function qtyOfRecords()
  {
      $q = $this->createAliasQuery();
      return $this->updateQueryForList($q, null)->execute()->count();
  }

}