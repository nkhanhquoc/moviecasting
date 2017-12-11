<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vt_member".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $phonenumber
 * @property string $birthday
 * @property integer $sex
 * @property integer $actived
 * @property integer $locked
 * @property string $province_id
 * @property string $credit
 * @property string $image_path
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_first_login
 * @property string $theme_path
 * @property integer $is_active
 * @property string $work
 * @property string $auth_key
 * @property string $password_reset_token
 *
 * @property VtCommentAlbumDB[] $vtCommentAlbums
 * @property VtCommentArticleDB[] $vtCommentArticles
 * @property VtCommentComposerDB[] $vtCommentComposers
 * @property VtCommentPlaylistDB[] $vtCommentPlaylists
 * @property VtCommentSingerDB[] $vtCommentSingers
 * @property VtCommentSongDB[] $vtCommentSongs
 * @property VtCommentVideoDB[] $vtCommentVideos
 * @property VtFavouriteAlbumJoinDB[] $vtFavouriteAlbumJoins
 * @property VtFavouritePlaylistJoinDB[] $vtFavouritePlaylistJoins
 * @property VtFavouriteSongAliasDB[] $vtFavouriteSongAliases
 * @property VtFavouriteSongJoinDB[] $vtFavouriteSongJoins
 * @property VtFavouriteVideoJoinDB[] $vtFavouriteVideoJoins
 * @property VtProvinceDB $province
 * @property VtSingerFanDB[] $vtSingerFans
 * @property VtSingerDB[] $singers
 * @property VtUserUploadSongDB[] $vtUserUploadSongs
 */
class MemberDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vt_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'created_at', 'updated_at'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['sex', 'actived', 'locked', 'province_id', 'credit', 'is_first_login', 'is_active'], 'integer'],
            [['username', 'password', 'fullname', 'email', 'image_path', 'theme_path', 'work', 'auth_key', 'password_reset_token'], 'string', 'max' => 255],
            [['phonenumber'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phonenumber'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'username' => Yii::t('backend', 'Username'),
            'password' => Yii::t('backend', 'Password'),
            'fullname' => Yii::t('backend', 'Fullname'),
            'email' => Yii::t('backend', 'Email'),
            'phonenumber' => Yii::t('backend', 'Phonenumber'),
            'birthday' => Yii::t('backend', 'Birthday'),
            'sex' => Yii::t('backend', 'Sex'),
            'actived' => Yii::t('backend', 'Actived'),
            'locked' => Yii::t('backend', 'Locked'),
            'province_id' => Yii::t('backend', 'Province ID'),
            'credit' => Yii::t('backend', 'Credit'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'is_first_login' => Yii::t('backend', 'Is First Login'),
            'theme_path' => Yii::t('backend', 'Theme Path'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'work' => Yii::t('backend', 'Work'),
            'auth_key' => Yii::t('backend', 'Auth Key'),
            'password_reset_token' => Yii::t('backend', 'Password Reset Token'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentAlbums()
    {
        return $this->hasMany(VtCommentAlbumDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentArticles()
    {
        return $this->hasMany(VtCommentArticleDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentComposers()
    {
        return $this->hasMany(VtCommentComposerDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentPlaylists()
    {
        return $this->hasMany(VtCommentPlaylistDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentSingers()
    {
        return $this->hasMany(VtCommentSingerDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentSongs()
    {
        return $this->hasMany(VtCommentSongDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtCommentVideos()
    {
        return $this->hasMany(VtCommentVideoDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteAlbumJoins()
    {
        return $this->hasMany(VtFavouriteAlbumJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouritePlaylistJoins()
    {
        return $this->hasMany(VtFavouritePlaylistJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteSongAliases()
    {
        return $this->hasMany(VtFavouriteSongAliasDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteSongJoins()
    {
        return $this->hasMany(VtFavouriteSongJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtFavouriteVideoJoins()
    {
        return $this->hasMany(VtFavouriteVideoJoinDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(VtProvinceDB::className(), ['id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtSingerFans()
    {
        return $this->hasMany(VtSingerFanDB::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingers()
    {
        return $this->hasMany(VtSingerDB::className(), ['id' => 'singer_id'])->viaTable('vt_singer_fan', ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtUserUploadSongs()
    {
        return $this->hasMany(VtUserUploadSongDB::className(), ['member_id' => 'id']);
    }
}
