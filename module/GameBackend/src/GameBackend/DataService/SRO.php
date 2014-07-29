<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 06.07.14
 * Time: 23:46
 */

namespace GameBackend\DataService;


use PServerCMS\Entity\Users;
use GameBackend\Entity\SRO\Keys\Account;

class SRO extends InvokableBase implements DataServiceInterface {

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $accountEntityManager;

	/**
	 * @param Users $oUser
	 * @param       $sPlainPassword
	 *
	 * @return int
	 */
	public function setUser( Users $oUser, $sPlainPassword ) {
		$oAccEntityManager = $this->getAccountEntityManager();

		if((bool) $oUser->getBackendId()){
			$iJID = $oUser->getBackendId();

			$oRepoTbUser = $oAccEntityManager->getRepository(Account::TbUser);
			/** @var \GameBackend\Entity\SRO\Account\TbUser $oTbUser */
			$oTbUser = $oRepoTbUser->findOneBy(array('jid' => $iJID));
		}else{
			$class = Account::TbUser;
			/** @var \GameBackend\Entity\SRO\Account\TbUser $oTbUser */
			$oTbUser = new $class();
			$oTbUser->setStruserid($oUser->getUsername());
			$oTbUser->setEmail($oUser->getEmail());
			$oTbUser->setRegIp($oUser->getCreateip());
		}

		$oTbUser->setPassword(md5($sPlainPassword));
		$oAccEntityManager->persist($oTbUser);
		$oAccEntityManager->flush();

		return $oTbUser->getJid();
	}

	/**
	 * @param Users $oUser
	 * @param       $iCoins
	 *
	 * @return boolean
	 */
	public function setCoins( Users $oUser, $iCoins ) {
		return false;
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	protected function getAccountEntityManager(){
		if(!$this->accountEntityManager){
			$this->accountEntityManager = $this->getServiceManager()->get('doctrine.entitymanager.orm_sro_account');
		}
		return $this->accountEntityManager;
	}

}