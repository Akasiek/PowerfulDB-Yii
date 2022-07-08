<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $profile_pic_url
 * @property string $about_text
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['profile_pic_url'], 'string', 'max' => 1024],
            [['about_text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /** 
     * {@inheritdoc}
     */
    public function getProfilePic()
    {
        return $this->profile_pic_url;
    }

    /**
     * {@inheritdoc}
     */
    public function getAboutText()
    {
        return $this->about_text;
    }


    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /** 
     * Get count of contributions of a user
     */
    public function getContributionsCount()
    {
        $albumsCount = Album::find()->where(['created_by' => $this->id])->count();
        $artistsCount = Artist::find()->where(['created_by' => $this->id])->count();
        $bandsCount = Band::find()->where(['created_by' => $this->id])->count();
        $genresCount = AlbumGenre::find()->where(['created_by' => $this->id])->count();
        $tracksCount = Track::find()->where(['created_by' => $this->id])->count();
        $bandMembersCount = BandMember::find()->where(['created_by' => $this->id])->count();
        $articlesCount = (AlbumArticle::find()->where(['created_by' => $this->id])->count() +
            ArtistArticle::find()->where(['created_by' => $this->id])->count() +
            BandArticle::find()->where(['created_by' => $this->id])->count()
        );
        // TODO: Edits submission count

        return [
            'albums' => $albumsCount,
            'artists' => $artistsCount,
            'bands' => $bandsCount,
            'genres' => $genresCount,
            'tracks' => $tracksCount,
            'bandMembers' => $bandMembersCount,
            'articles' => $articlesCount,
        ];
    }

    /** 
     * Get all contributions of a user and date they were created
     */
    public function getContributions()
    {
        // Get all contribitions of a user with date column
        $albumsContrib = Album::find()->where(['created_by' => $this->id])->select(
            'album.*, date(to_timestamp(album.created_at)) as created_date'
        )->with('artist', 'band')->all();
        $artistsContrib = Artist::find()->where(['created_by' => $this->id])->select(
            'artist.*, date(to_timestamp(artist.created_at)) as created_date'
        )->all();
        $bandsContrib = Band::find()->where(['created_by' => $this->id])->select(
            'band.*, date(to_timestamp(band.created_at)) as created_date'
        )->all();
        $genresContrib = AlbumGenre::find()->where(['created_by' => $this->id])->select(
            'album_id, count(*) as genre_count, date(to_timestamp(album_genre.created_at)) as created_date'
        )->with('album', 'genre')->groupBy(['created_at', 'album_id'])->all();
        $trackContrib = Track::find()->where(['created_by' => $this->id])->select(
            'album_id, count(*) as track_count, date(to_timestamp(track.created_at)) as created_date'
        )->with('album')->groupBy(['created_at', 'album_id'])->all();
        $bandMemberContrib = BandMember::find()->where(['created_by' => $this->id])->select(
            'band_id, count(*) as member_count, date(to_timestamp(band_member.created_at)) as created_date'
        )->with('band')->groupBy(['created_date', 'band_id'])->all();

        $contribs = [];
        foreach ($albumsContrib as $album) $contribs[] = $album;
        foreach ($artistsContrib as $artist) $contribs[] = $artist;
        foreach ($bandsContrib as $band) $contribs[] = $band;
        foreach ($genresContrib as $genre) $contribs[] = $genre;
        foreach ($trackContrib as $track) $contribs[] = $track;
        foreach ($bandMemberContrib as $bandMember) $contribs[] = $bandMember;

        // TODO: Array of edit contribs

        // Sort contribs array by date in descending order
        usort($contribs, function ($a, $b) {
            return $b->created_date <=> $a->created_date;
        });

        $arrayDataProvider = new ArrayDataProvider([
            'allModels' => $contribs,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);

        return $arrayDataProvider;
    }
}
