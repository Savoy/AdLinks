<?php
namespace application\models;

/**
 * This is the model class for table "redirect".
 *
 * The followings are the available columns in table 'redirect':
 * @property integer $id
 * @property integer $link_id
 * @property integer $ip_long
 * @property string $user_agent
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $utm_term
 * @property string $created_at
 *
 * @property string $ip
 *
 * The followings are the available model relations:
 * @property Link $link
 */
class Redirect extends \CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'redirect';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('link_id', 'required'),
			array('link_id, ip_long', 'numerical', 'integerOnly'=>true),
            array('user_agent', 'filter', 'filter' => 'strip_tags'),
			array('utm_source, utm_medium, utm_campaign, utm_content, utm_term', 'length', 'max'=>255),
            array('created_at', 'default', 'on'=>'insert', 'value'=>new \CDbExpression('NOW()'), 'setOnEmpty'=>false),
			// The following rule is used by search().
			array('link_id, ip_long, user_agent, utm_source, utm_medium, utm_campaign, utm_content, utm_term', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'link' => array(self::BELONGS_TO, 'application\models\Link', 'link_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'link_id' => 'Ссылка',
			'ip_long' => 'IP адрес',
			'user_agent' => 'User-Agent',
			'utm_source' => 'Utm Source',
			'utm_medium' => 'Utm Medium',
			'utm_campaign' => 'Utm Campaign',
			'utm_content' => 'Utm Content',
			'utm_term' => 'Utm Term',
			'created_at' => 'Дата создания',
		);
	}

	public function getIp()
    {
        return long2ip($this->ip_long);
    }

    public function setIp($value)
    {
        $this->ip_long = ip2long($value);
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return \CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new \CDbCriteria;
		$criteria->with = 'link';

		$criteria->compare('link.code',$this->link_id,true);
		$criteria->compare('INET_NTOA(ip_long)',$this->ip_long, true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('utm_source',$this->utm_source,true);
		$criteria->compare('utm_medium',$this->utm_medium,true);
		$criteria->compare('utm_campaign',$this->utm_campaign,true);
		$criteria->compare('utm_content',$this->utm_content,true);
		$criteria->compare('utm_term',$this->utm_term,true);
		$criteria->compare('created_at',$this->created_at);

		return new \CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => [
                'attributes' => [
                    'link_id' => 'link.code',
                    'ip_long',
                    'user_agent',
                    'utm_source',
                    'utm_medium',
                    'utm_campaign',
                    'utm_content',
                    'utm_term',
                    'created_at',
                ]
            ],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Redirect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
