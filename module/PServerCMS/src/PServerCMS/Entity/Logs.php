<?php

namespace PServerCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table(name="logs", indexes={@ORM\Index(name="fk_logs_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class Logs {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="lId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $lid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="topic", type="string", length=45, nullable=false)
	 */
	private $topic;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="memo", type="text", nullable=false)
	 */
	private $memo;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	/**
	 * @var \PServerCMS\Entity\Users
	 *
	 * @ORM\ManyToOne(targetEntity="PServerCMS\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
	 * })
	 */
	private $usersUsrid;

	public function __construct( ) {
		$this->created = new \DateTime();
	}

	/**
	 * Get lid
	 *
	 * @return integer
	 */
	public function getLid() {
		return $this->lid;
	}

	/**
	 * Set topic
	 *
	 * @param string $topic
	 *
	 * @return Logs
	 */
	public function setTopic( $topic ) {
		$this->topic = $topic;

		return $this;
	}

	/**
	 * Get topic
	 *
	 * @return string
	 */
	public function getTopic() {
		return $this->topic;
	}

	/**
	 * Set memo
	 *
	 * @param string $memo
	 *
	 * @return Logs
	 */
	public function setMemo( $memo ) {
		$memo = is_array($memo)?json_encode($memo):$memo;
		$this->memo = $memo;

		return $this;
	}

	/**
	 * Get memo
	 *
	 * @return string
	 */
	public function getMemo() {
		return $this->memo;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Logs
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Set usersUsrid
	 *
	 * @param \PServerCMS\Entity\Users $usersUsrid
	 *
	 * @return Logs
	 */
	public function setUsersUsrid( \PServerCMS\Entity\Users $usersUsrid = null ) {
		$this->usersUsrid = $usersUsrid;

		return $this;
	}

	/**
	 * Get usersUsrid
	 *
	 * @return \PServerCMS\Entity\Users
	 */
	public function getUsersUsrid() {
		return $this->usersUsrid;
	}
}