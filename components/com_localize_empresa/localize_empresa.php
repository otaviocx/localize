<?php
/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::register('Localize_empresaFrontendHelper', JPATH_COMPONENT . '/helpers/localize_empresa.php');

// Execute the task.
$controller = JControllerLegacy::getInstance('Localize_empresa');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
