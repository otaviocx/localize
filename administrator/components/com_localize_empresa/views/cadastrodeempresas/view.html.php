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

jimport('joomla.application.component.view');

/**
 * View class for a list of Localize_empresa.
 */
class Localize_empresaViewCadastrodeempresas extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        Localize_empresaHelper::addSubmenu('cadastrodeempresas');

        $this->addToolbar();

        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar() {
        require_once JPATH_COMPONENT . '/helpers/localize_empresa.php';

        $state = $this->get('State');
        $canDo = Localize_empresaHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_LOCALIZE_EMPRESA_TITLE_CADASTRODEEMPRESAS'), 'cadastrodeempresas.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/cadastrodeempresa';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('cadastrodeempresa.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('cadastrodeempresa.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('cadastrodeempresas.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('cadastrodeempresas.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'cadastrodeempresas.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('cadastrodeempresas.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('cadastrodeempresas.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'cadastrodeempresas.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('cadastrodeempresas.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_localize_empresa');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_localize_empresa&view=cadastrodeempresas');

        $this->extra_sidebar = '';
        
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);

		//Filter for the field corretores
		$this->extra_sidebar .= '<div class="other-filters">';
		$this->extra_sidebar .= '<small><label for="filter_corretores">Corretores</label></small>';
		$this->extra_sidebar .= JHtmlList::users('filter_corretores', $this->state->get('filter.corretores'), 1, 'onchange="this.form.submit();"');
		$this->extra_sidebar .= '</div>';
    }

	protected function getSortFields()
	{
		return array(
		'a.`id`' => JText::_('JGRID_HEADING_ID'),
		'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
		'a.`state`' => JText::_('JSTATUS'),
		'a.`nome`' => JText::_('COM_LOCALIZE_EMPRESA_CADASTRODEEMPRESAS_NOME'),
		'a.`cnpj`' => JText::_('COM_LOCALIZE_EMPRESA_CADASTRODEEMPRESAS_CNPJ'),
		'a.`telefone1`' => JText::_('COM_LOCALIZE_EMPRESA_CADASTRODEEMPRESAS_TELEFONE1'),
		'a.`email`' => JText::_('COM_LOCALIZE_EMPRESA_CADASTRODEEMPRESAS_EMAIL'),
		'a.`corretores`' => JText::_('COM_LOCALIZE_EMPRESA_CADASTRODEEMPRESAS_CORRETORES'),
		);
	}

}
