 <?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property integer $merchange_id
 * @property string $book_time
 * @property string $book_desc
 * @property string $book_phone
 * @property string $book_name
 * @property integer $book_num
 * @property integer $book_no
 * @property string $order_num
 * @property integer $status
 * @property string $book_or_num
 * @property integer $reserve_time
 * @property integer $reach_time
 * @property integer $begin_time
 * @property integer $over_time
 * @property string $book_type
 * @property integer $add_user_id
 * @property string $book_date
 * @property integer $book_sex
 * @property integer $commit_time
 * @property integer $add_time
 * @property string $book_seat_type
 * @property integer $book_seat_num
 * @property integer $book_source_type
 * @property integer $book_seat_id
 */
class BookList extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'book';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('book_time, book_or_num, reserve_time, reach_time, begin_time, over_time, book_type, add_user_id, book_date, book_sex, commit_time, add_time, book_seat_type, book_seat_num, book_source_type, book_seat_id,common_id', 'required'),
            array('user_id, merchange_id, book_num, book_no, status, reserve_time, reach_time, begin_time, over_time, add_user_id, book_sex, commit_time, add_time, book_seat_num, book_source_type, book_seat_id,common_id', 'numerical', 'integerOnly'=>true),
            array('account_name, user_name, book_phone, book_name, order_num', 'length', 'max'=>45),
            array('book_time', 'length', 'max'=>7),
            array('book_desc', 'length', 'max'=>255),
            array('book_or_num', 'length', 'max'=>30),
            array('book_type, book_seat_type', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, account_name, user_name, merchange_id, book_time, book_desc, book_phone, book_name, book_num, book_no, order_num, status, book_or_num, reserve_time, reach_time, begin_time, over_time, book_type, add_user_id, book_date, book_sex, commit_time, add_time, book_seat_type, book_seat_num, book_source_type, book_seat_id,common_id', 'safe', 'on'=>'search'),
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
            'merchantOwer'=>array(self::BELONGS_TO, 'MerchantMsg', 'merchange_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'account_name' => 'Account Name',
            'user_name' => 'User Name',
            'merchange_id' => 'Merchange',
            'book_time' => 'Book Time',
            'book_desc' => 'Book Desc',
            'book_phone' => 'Book Phone',
            'book_name' => 'Book Name',
            'book_num' => 'Book Num',
            'book_no' => 'Book No',
            'order_num' => 'Order Num',
            'status' => 'Status',
            'book_or_num' => 'Book Or Num',
            'reserve_time' => 'Reserve Time',
            'reach_time' => 'Reach Time',
            'begin_time' => 'Begin Time',
            'over_time' => 'Over Time',
            'book_type' => 'Book Type',
            'add_user_id' => 'Add User',
            'book_date' => 'Book Date',
            'book_sex' => 'Book Sex',
            'commit_time' => 'Commit Time',
            'add_time' => 'Add Time',
            'book_seat_type' => 'Book Seat Type',
            'book_seat_num' => 'Book Seat Num',
            'book_source_type' => 'Book Source Type',
            'book_seat_id' => 'Book Seat',
            'common_id'=>'common id',
        );
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
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('account_name',$this->account_name,true);
        $criteria->compare('user_name',$this->user_name,true);
        $criteria->compare('merchange_id',$this->merchange_id);
        $criteria->compare('book_time',$this->book_time,true);
        $criteria->compare('book_desc',$this->book_desc,true);
        $criteria->compare('book_phone',$this->book_phone,true);
        $criteria->compare('book_name',$this->book_name,true);
        $criteria->compare('book_num',$this->book_num);
        $criteria->compare('book_no',$this->book_no);
        $criteria->compare('order_num',$this->order_num,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('book_or_num',$this->book_or_num,true);
        $criteria->compare('reserve_time',$this->reserve_time);
        $criteria->compare('reach_time',$this->reach_time);
        $criteria->compare('begin_time',$this->begin_time);
        $criteria->compare('over_time',$this->over_time);
        $criteria->compare('book_type',$this->book_type,true);
        $criteria->compare('add_user_id',$this->add_user_id);
        $criteria->compare('book_date',$this->book_date,true);
        $criteria->compare('book_sex',$this->book_sex);
        $criteria->compare('commit_time',$this->commit_time);
        $criteria->compare('add_time',$this->add_time);
        $criteria->compare('book_seat_type',$this->book_seat_type,true);
        $criteria->compare('book_seat_num',$this->book_seat_num);
        $criteria->compare('book_source_type',$this->book_source_type);
        $criteria->compare('book_seat_id',$this->book_seat_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BookList the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
} 