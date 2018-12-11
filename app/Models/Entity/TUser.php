<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 用户表

 * @Entity()
 * @Table(name="t_user")
 * @uses      TUser
 */
class TUser extends Model
{
    /**
     * @var int $fId 
     * @Id()
     * @Column(name="f_id", type="integer")
     */
    private $fId;

    /**
     * @var string $fNickname 昵称
     * @Column(name="f_nickname", type="string", length=64, default="")
     */
    private $fNickname;

    /**
     * @var string $fSalt 加密盐
     * @Column(name="f_salt", type="string", length=32, default="")
     */
    private $fSalt;

    /**
     * @var string $fPassword 登陆密码
     * @Column(name="f_password", type="string", length=32, default="")
     */
    private $fPassword;

    /**
     * @var string $fCreateTime 
     * @Column(name="f_create_time", type="timestamp")
     */
    private $fCreateTime;

    /**
     * @var string $fModifyTime 
     * @Column(name="f_modify_time", type="timestamp")
     */
    private $fModifyTime;

    /**
     * @param int $value
     * @return $this
     */
    public function setFId(int $value)
    {
        $this->fId = $value;

        return $this;
    }

    /**
     * 昵称
     * @param string $value
     * @return $this
     */
    public function setFNickname(string $value): self
    {
        $this->fNickname = $value;

        return $this;
    }

    /**
     * 加密盐
     * @param string $value
     * @return $this
     */
    public function setFSalt(string $value): self
    {
        $this->fSalt = $value;

        return $this;
    }

    /**
     * 登陆密码
     * @param string $value
     * @return $this
     */
    public function setFPassword(string $value): self
    {
        $this->fPassword = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFCreateTime(string $value): self
    {
        $this->fCreateTime = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFModifyTime(string $value): self
    {
        $this->fModifyTime = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFId()
    {
        return $this->fId;
    }

    /**
     * 昵称
     * @return string
     */
    public function getFNickname()
    {
        return $this->fNickname;
    }

    /**
     * 加密盐
     * @return string
     */
    public function getFSalt()
    {
        return $this->fSalt;
    }

    /**
     * 登陆密码
     * @return string
     */
    public function getFPassword()
    {
        return $this->fPassword;
    }

    /**
     * @return string
     */
    public function getFCreateTime()
    {
        return $this->fCreateTime;
    }

    /**
     * @return string
     */
    public function getFModifyTime()
    {
        return $this->fModifyTime;
    }

}
