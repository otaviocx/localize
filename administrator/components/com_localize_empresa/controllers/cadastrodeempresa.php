<?php
/**
 * @version     1.0.0
 * @package     com_localize_empresa
 * @copyright   Copyright (C) 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Victor Bento <vgb.info@gmail.com> - http://victorbento.com.br
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Cadastrodeempresa controller class.
 */
class Localize_empresaControllerCadastrodeempresa extends JControllerForm
{

    function __construct() {
        $this->view_list = 'cadastrodeempresas';
        parent::__construct();
    }

}