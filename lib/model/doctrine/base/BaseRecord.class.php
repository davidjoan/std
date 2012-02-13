<?php

/**
 * BaseRecord
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $from_area_id
 * @property integer $to_area_id
 * @property integer $user_id
 * @property string $code
 * @property string $subject
 * @property integer $time_limit
 * @property string $description
 * @property string $status
 * @property string $active
 * @property User $User
 * @property Area $FromArea
 * @property Area $ToArea
 * @property Doctrine_Collection $Documents
 * @property Doctrine_Collection $RecordLogs
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method integer             getFromAreaId()   Returns the current record's "from_area_id" value
 * @method integer             getToAreaId()     Returns the current record's "to_area_id" value
 * @method integer             getUserId()       Returns the current record's "user_id" value
 * @method string              getCode()         Returns the current record's "code" value
 * @method string              getSubject()      Returns the current record's "subject" value
 * @method integer             getTimeLimit()    Returns the current record's "time_limit" value
 * @method string              getDescription()  Returns the current record's "description" value
 * @method string              getStatus()       Returns the current record's "status" value
 * @method string              getActive()       Returns the current record's "active" value
 * @method User                getUser()         Returns the current record's "User" value
 * @method Area                getFromArea()     Returns the current record's "FromArea" value
 * @method Area                getToArea()       Returns the current record's "ToArea" value
 * @method Doctrine_Collection getDocuments()    Returns the current record's "Documents" collection
 * @method Doctrine_Collection getRecordLogs()   Returns the current record's "RecordLogs" collection
 * @method Record              setId()           Sets the current record's "id" value
 * @method Record              setFromAreaId()   Sets the current record's "from_area_id" value
 * @method Record              setToAreaId()     Sets the current record's "to_area_id" value
 * @method Record              setUserId()       Sets the current record's "user_id" value
 * @method Record              setCode()         Sets the current record's "code" value
 * @method Record              setSubject()      Sets the current record's "subject" value
 * @method Record              setTimeLimit()    Sets the current record's "time_limit" value
 * @method Record              setDescription()  Sets the current record's "description" value
 * @method Record              setStatus()       Sets the current record's "status" value
 * @method Record              setActive()       Sets the current record's "active" value
 * @method Record              setUser()         Sets the current record's "User" value
 * @method Record              setFromArea()     Sets the current record's "FromArea" value
 * @method Record              setToArea()       Sets the current record's "ToArea" value
 * @method Record              setDocuments()    Sets the current record's "Documents" collection
 * @method Record              setRecordLogs()   Sets the current record's "RecordLogs" collection
 * 
 * @package    std
 * @subpackage model
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRecord extends DoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('t_record');
        $this->hasColumn('id', 'integer', 20, array(
             'type' => 'integer',
             'length' => 20,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('from_area_id', 'integer', 20, array(
             'type' => 'integer',
             'length' => 20,
             'notnull' => true,
             ));
        $this->hasColumn('to_area_id', 'integer', 20, array(
             'type' => 'integer',
             'length' => 20,
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', 20, array(
             'type' => 'integer',
             'length' => 20,
             'notnull' => true,
             ));
        $this->hasColumn('code', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'notnull' => true,
             ));
        $this->hasColumn('subject', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             'notnull' => true,
             ));
        $this->hasColumn('time_limit', 'integer', 20, array(
             'type' => 'integer',
             'length' => 20,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             'notnull' => true,
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'length' => 1,
             'fixed' => 1,
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('active', 'string', 1, array(
             'type' => 'string',
             'length' => 1,
             'fixed' => 1,
             'notnull' => true,
             'default' => 1,
             ));


        $this->index('i_active', array(
             'fields' => 
             array(
              0 => 'active',
             ),
             ));
        $this->option('symfony', array(
             'filter' => false,
             'form' => true,
             ));
        $this->option('boolean_columns', array(
             0 => 'active',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('Area as FromArea', array(
             'local' => 'from_area_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('Area as ToArea', array(
             'local' => 'to_area_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('Document as Documents', array(
             'local' => 'id',
             'foreign' => 'record_id'));

        $this->hasMany('RecordLog as RecordLogs', array(
             'local' => 'id',
             'foreign' => 'record_id'));

        $sluggableext0 = new Doctrine_Template_SluggableExt(array(
             'fields' => 
             array(
              0 => 'code',
             ),
             ));
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($sluggableext0);
        $this->actAs($timestampable0);
    }
}