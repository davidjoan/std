<?php

/**
 * Record
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    std
 * @subpackage model
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Record extends BaseRecord
{
  public function getStatusStr()
  {
    $actives = $this->getTable()->getStatuss();
    return $actives[$this->getStatus()];
  }
  public function getStatusColorStr()
  {
    $actives = $this->getTable()->getStatuss();
    $colors = $this->getTable()->getColors();
    $color = $colors[$this->getStatus()];
    $status = $actives[$this->getStatus()];
    $area_id = sfContext::getInstance()->getUser()->getAreaId();
    $direction = ($area_id == $this->getFromAreaId())?image_tag('backend/arrow_right.gif'):image_tag('backend/arrow_left.gif');
    return sprintf("<span style='font-weight: bold; color: %s'>%s</span>",$color, $status.' '.$direction);
  }
  
  
  public function getTimeLimitStr()
  {
      return sprintf('%s dias',$this->getTimeLimit());
  }
  
  public function getAreaName()
  {
      return $this->getFromArea()->getName();
  }
  
  
  public function getUserName()
  {
  	return sprintf('%s, %s', $this->getUser()->getLastName(), $this->getUser()->getFirstName());
  }  
  
  public function getFormattedDatetime($format = 'D')
  {
    return $this->getTable()->getDateTimeFormatter()->format($this->getCreatedAt(), $format);
  }
  
  public function doLogCreationAccordingStatusChanges()
  {
    if ($this->isColumnModified('status'))
    {
      $recordLog = new RecordLog();
      
      //$recordLog->setRecordId($this->getId());
      
      $recordLog->setCode($this->getCode());
      $recordLog->setActive($this->getActive());
      $recordLog->setDescription($this->getDescription());
      $recordLog->setFromAreaId($this->getFromAreaId());
      $recordLog->setToAreaId($this->getToAreaId());
      $recordLog->setSubject($this->getSubject());
      $recordLog->setUserId($this->getUserId());
      $recordLog->setStatus($this->getStatus());
      $recordLog->setTimeLimit($this->getTimeLimit());
          
      $this->RecordLogs[] = $recordLog;
    }
  }  
  
  public function save(Doctrine_Connection $conn = null)
  {
    if(!$this->isNew())
    {
    	$this->doLogCreationAccordingStatusChanges();
    }
        
    parent::save($conn);
  }
  
  public function validation($status, $area_id)
  {
      $validation = false;
      
          switch ($this->status) {
              case RecordTable::STATUS_PENDING:
                  if($status == RecordTable::STATUS_DERIVED )
                  {
                      $validation = true;
                  }
                  break;
              case RecordTable::STATUS_DERIVED:
                  if($status == RecordTable::STATUS_RECEIVED && $this->getToAreaId() ==  $area_id )
                  {
                      $validation = true;
                  }

                  break;
              case RecordTable::STATUS_RECEIVED:
                  if(($status == RecordTable::STATUS_DERIVED || $status == RecordTable::STATUS_RETURNED || $status == RecordTable::STATUS_COMPLETED) && $this->getToAreaId() ==  $area_id)
                  {
                      $validation = true;
                  }

                  break;
              case RecordTable::STATUS_RETURNED:
                  if(($status == RecordTable::STATUS_COMPLETED && $this->getFromAreaId() ==  $area_id) || $status == RecordTable::STATUS_RECEIVED)
                  {
                      $validation = true;
                  }

                  break;
              case RecordTable::STATUS_COMPLETED:
                  if($status == RecordTable::STATUS_RECEIVED && $this->getToAreaId() ==  $area_id)
                  {
                      $validation = true;
                  }                      
               
                  break;
              default:
                  break;
          }      
          return $validation;
  }
  
}