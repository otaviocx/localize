<?php
/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Cadastrodeempresas list controller class.
 */
class Localize_empresaControllerCadastrodeempresas extends Localize_empresaController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Cadastrodeempresas', $prefix = 'Localize_empresaModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}