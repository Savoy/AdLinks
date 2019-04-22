<?php
namespace application\models;

/**
 * This is the model class for table "link".
 *
 * The followings are the available columns in table 'link':
 * @property integer $id
 * @property string $code
 * @property string $link
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $utm_term
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property array $utmList
 * @property array $utmValues
 * @property array $statuses
 * @property string $statusText
 *
 * The followings are the available model relations:
 * @property Redirect[] $redirects
 */
class Link extends \CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('link', 'required'),
            array('code', 'unique'),
            array('code', 'length', 'max'=>8),
            array('utm_source, utm_medium, utm_campaign, utm_content, utm_term', 'length', 'max'=>255),
			array('status', 'in', 'range'=>array_keys($this->statuses)),
            array('created_at', 'default', 'on'=>'insert', 'value'=>new \CDbExpression('NOW()'), 'setOnEmpty'=>false),
            array('updated_at', 'default', 'on'=>'update', 'value'=>new \CDbExpression('NOW()'), 'setOnEmpty'=>false),
			// The following rule is used by search().
			array('code, link, utm_source, utm_medium, utm_campaign, utm_content, utm_term, status', 'safe', 'on'=>'search'),
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
			'redirects' => array(self::HAS_MANY, 'application\models\Redirect', 'link_id'),
            'redirectsCount' => array(self::STAT, 'application\models\Redirect', 'link_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'code' => 'Служебная ссылка',
			'link' => 'Пользовательская ссылка',
			'utm_source' => 'Utm Source',
			'utm_medium' => 'Utm Medium',
			'utm_campaign' => 'Utm Campaign',
			'utm_content' => 'Utm Content',
			'utm_term' => 'Utm Term',
			'status' => 'Статус',
			'created_at' => 'Дата создания',
			'updated_at' => 'Дата обновления',
		);
	}

    /**
     * Возвращает массив utm меток
     *
     * @return array
     */
	public function getUtmList()
    {
        return [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'utm_term',
        ];
    }

    public function getUtmValues()
    {
        $values = [];
        foreach ($this->utmList as $utm)
            if ($this->$utm)
                $values[$utm] = $this->$utm;

        return $values;
    }

    /**
     * Возвращет текущий текстовый статус
     *
     * @return string
     */
	public function getStatusText()
    {
        return isset($this->statuses[$this->status])
            ? $this->statuses[$this->status]
            : 'Неизвестный';
    }

    /**
     * Возвращает массив доступных статусов
     *
     * @return array
     */
    public function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_DELETED => 'Удален',
        ];
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
		$criteria=new \CDbCriteria();

		$criteria->compare('code',$this->code, true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('utm_source',$this->utm_source,true);
		$criteria->compare('utm_medium',$this->utm_medium,true);
		$criteria->compare('utm_campaign',$this->utm_campaign,true);
		$criteria->compare('utm_content',$this->utm_content,true);
		$criteria->compare('utm_term',$this->utm_term,true);
	    $criteria->compare('status',$this->status);

		return new \CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->code = $this->generateCode();
            }

            return true;
        }

        return false;
    }

    protected function generateCode($max = 8)
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $code = '';
        while($max--)
            $code .= $chars[rand(0,strlen($chars))];

        return $code;
    }

    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Link the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
