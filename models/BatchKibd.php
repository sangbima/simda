<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "batch_kibd".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property string $latitude
 * @property string $longitude
 * @property integer $gov_unit_id
 * @property integer $product_group_sub2_id
 * @property string $code_main
 * @property integer $code_start_num
 * @property integer $province_id
 * @property integer $kabupatenkota_id
 * @property integer $kecamatan_id
 * @property integer $desakelurahan_id
 * @property string $address
 * @property string $procure_date
 * @property integer $procure_type_id
 * @property string $procure_doc
 * @property integer $excomp
 * @property string $asset_recipient
 * @property integer $quantity
 * @property string $price_base
 * @property string $price_capital
 * @property string $price_total
 * @property string $semester
 * @property string $description
 * @property string $construction
 * @property string $land_status
 * @property string $length
 * @property string $width
 * @property string $size
 * @property string $land_code_no
 * @property string $document_no
 * @property string $document_date
 *
 * @property Desakelurahan $desakelurahan
 * @property GovUnit $govUnit
 * @property Kabupatenkota $kabupatenkota
 * @property Kecamatan $kecamatan
 * @property ProcureType $procureType
 * @property ProductGroupSub2 $productGroupSub2
 * @property Province $province
 */
class BatchKibd extends \yii\db\ActiveRecord
{
    public $benefit_year, $procure_year, $code_asset;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batch_kibd';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function(){ return date('Y-m-d H:i:s'); /* MySql DATETIME */},
            ],
            'autouserid' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'procure_date', 'document_date'], 'safe'],
            [['user_id', 'gov_unit_id', 'product_group_sub2_id', 'code_start_num', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'quantity'], 'integer'],
            [['latitude', 'longitude', 'price_base', 'price_capital', 'price_total', 'length', 'width', 'size'], 'number'],
            [['gov_unit_id', 'product_group_sub2_id', 'code_main', 'code_start_num', 'province_id', 'kabupatenkota_id', 'procure_date', 'procure_type_id', 'procure_doc', 'price_base', 'price_total', 'construction', 'quantity', 'price_capital'], 'required'],
            [['semester', 'description', 'construction'], 'string'],
            [['code_main', 'asset_recipient'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 500],
            [['procure_doc', 'land_status', 'land_code_no', 'document_no'], 'string', 'max' => 100],
            [['desakelurahan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desakelurahan::className(), 'targetAttribute' => ['desakelurahan_id' => 'id']],
            [['gov_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => GovUnit::className(), 'targetAttribute' => ['gov_unit_id' => 'id']],
            [['kabupatenkota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupatenkota::className(), 'targetAttribute' => ['kabupatenkota_id' => 'id']],
            [['kecamatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kecamatan_id' => 'id']],
            [['procure_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProcureType::className(), 'targetAttribute' => ['procure_type_id' => 'id']],
            [['product_group_sub2_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGroupSub2::className(), 'targetAttribute' => ['product_group_sub2_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'gov_unit_id' => 'Unit Pengguna',
            'product_group_sub2_id' => 'Kode Barang',
            'code_main' => 'Code Main',
            'code_start_num' => 'Code Start Num',
            'province_id' => 'Provinsi',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'kecamatan_id' => 'Kecamatan',
            'desakelurahan_id' => 'Desa/Kelurahan',
            'address' => 'Alamat',
            'procure_date' => 'Tanggal Perolehan',
            'procure_type_id' => 'Asal Perolehan',
            'procure_doc' => 'Dokumen/BAP No.',
            'excomp' => 'Extra-Comptable',
            'asset_recipient' => 'Pengguna',
            'quantity' => 'Jumlah Barang',
            'price_base' => 'Harga Satuan',
            'price_capital' => 'Nilai Kapitalisasi',
            'price_total' => 'Nilai Perolehan',
            'semester' => 'Semester',
            'description' => 'Keterangan',
            'construction' => 'Konstruksi',
            'land_status' => 'Hak/Status Tanah',
            'length' => 'Panjang',
            'width' => 'Lebah',
            'size' => 'Luas',
            'land_code_no' => 'No. Kode Tanah',
            'document_no' => 'No. Dokumen',
            'document_date' => 'Tgl. Dokumen',
            'benefit_year' => 'Masa Manfaat (Thn)',
            'procure_year' => 'Tahun Perolehan',
            'code_asset' => 'Kode Asset',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesakelurahan()
    {
        return $this->hasOne(Desakelurahan::className(), ['id' => 'desakelurahan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovUnit()
    {
        return $this->hasOne(GovUnit::className(), ['id' => 'gov_unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatenkota()
    {
        return $this->hasOne(Kabupatenkota::className(), ['id' => 'kabupatenkota_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kecamatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcureType()
    {
        return $this->hasOne(ProcureType::className(), ['id' => 'procure_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupSub2()
    {
        return $this->hasOne(ProductGroupSub2::className(), ['id' => 'product_group_sub2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    public function getGovMainList()
    {
        $datas = \app\models\GovMain::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getGovUserList()
    {
        $datas = \app\models\GovUser::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getGovPrivilegeList()
    {
        $datas = \app\models\GovPrivilege::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getGovUnitList()
    {
        $datas = \app\models\GovUnit::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getRoomList()
    {
        $datas = \app\models\Room::find()->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getProvinceList()
    {
        $data = \app\models\Province::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllKabupatenKota()
    {
        $data = \app\models\Kabupatenkota::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllKecamatan()
    {
        $data = \app\models\Kecamatan::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllDesaKelurahan()
    {
        $data = \app\models\Desakelurahan::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getAllProductGroupSub2()
    {
        $datas = \app\models\ProductGroupSub2::find()->where(['like', 'code_acc', '04.%', false])->asArray()->all();

        $dataAll = array();
        foreach ($datas as $key => $value) {
            $dataAll[$key] = ['id' => $value['id'], 'name' => $value['code_acc'] .' - '.$value['name']];
        }

        return $datas ? ArrayHelper::map($dataAll, 'id', 'name') : [];
    }

    public function getAllProcureType()
    {
        $data = \app\models\ProcureType::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }
}
