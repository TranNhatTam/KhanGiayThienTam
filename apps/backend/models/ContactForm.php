<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contact_form".
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property string $email
 * @property string $subject
 * @property string $body
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email'], 'required'],
            [['phone'], 'integer'],
            [['name', 'email', 'subject', 'body'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
        ];
    }

    public static function sendContactEmail(ContactForm $model)
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setFrom('VIP.Khach.hang.vn@gmail.com');
        try {
            $mail->setTo('nhattam231297@gmail.com');
            $mail->setSubject('Yêu cầu từ khách hàng');
            $mail->setTextBody("
                    - Tên khách: $model->name 
                    - Số điện thoại: $model->phone
                    - Email: $model->email
                    - Tiêu đề : $model->subject
                    - Nội dung: $model->body");
            $mail->send();
        } catch (\Swift_TransportException $e) {
        }
    }


}
