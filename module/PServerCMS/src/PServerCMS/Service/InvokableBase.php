<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 18:52
 */

namespace PServerCMS\Service;


use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class InvokableBase implements ServiceManagerAwareInterface {

	/** @var ServiceManager */
	protected $serviceManager;
	/** @var \Doctrine\ORM\EntityManager */
	protected $entityManager;
	/** @var ConfigRead */
	protected $configReadService;
	/** @return ServiceManager */
	/** @var \Zend\Mvc\Controller\Plugin\FlashMessenger */
	protected $flashMessenger;
	/** @var \Zend\Mvc\Controller\PluginManager */
	protected $controllerPluginManager;


	public function getServiceManager() {
		return $this->serviceManager;
	}

	/**
	 * @param ServiceManager $oServiceManager
	 *
	 * @return $this
	 */
	public function setServiceManager( ServiceManager $oServiceManager ) {
		$this->serviceManager = $oServiceManager;

		return $this;
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager() {
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}

	/**
	 * @return ConfigRead
	 */
	public function getConfigService() {
		if (!$this->configReadService) {
			$this->configReadService = $this->getServiceManager()->get('pserver_configread_service');
		}

		return $this->configReadService;
	}

	/**
	 * @return \Zend\Mvc\Controller\PluginManager
	 */
	protected function getControllerPluginManager(){
		if (! $this->controllerPluginManager) {
			$this->controllerPluginManager = $this->getServiceManager()->get('ControllerPluginManager');
		}

		return $this->controllerPluginManager;
	}

	/**
	 * @return \Zend\Mvc\Controller\Plugin\FlashMessenger
	 */
	protected function getFlashMessenger(){
		if (! $this->flashMessenger) {
			$this->flashMessenger = $this->getControllerPluginManager()->get('flashMessenger');
		}

		return $this->flashMessenger;
	}
}