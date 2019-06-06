<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Webhook
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Webhook\Block\Adminhtml\Hook\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Mageplaza\Webhook\Model\Config\Source\Authentication;
use Mageplaza\Webhook\Model\Config\Source\ContentType;
use Mageplaza\Webhook\Model\Config\Source\Method;

/**
 * Class Actions
 * @package Mageplaza\Webhook\Block\Adminhtml\Hook\Edit\Tab
 */
class Actions extends Generic implements TabInterface
{
    /**
     * @var Method
     */
    protected $method;

    /**
     * @var ContentType
     */
    protected $contentType;

    /**
     * @var FieldFactory
     */
    protected $fieldFactory;

    /**
     * @var Authentication
     */
    protected $authentication;

    /**
     * Actions constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param FieldFactory $fieldFactory
     * @param Method $method
     * @param ContentType $contentType
     * @param Authentication $authentication
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        FieldFactory $fieldFactory,
        Method $method,
        ContentType $contentType,
        Authentication $authentication,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $formFactory, $data);

        $this->fieldFactory   = $fieldFactory;
        $this->method         = $method;
        $this->contentType    = $contentType;
        $this->authentication = $authentication;
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Mageplaza\Webhook\Model\Hook $rule */
        $hook = $this->_coreRegistry->registry('mageplaza_webhook_hook');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('hook_');
        $form->setFieldNameSuffix('hook');

        $fieldset = $form->addFieldset('actions_fieldset', [
            'legend' => __('Actions'),
            'class'  => 'fieldset-wide'
        ]);
        $fieldset->addField('payload_url', 'text', [
            'name'               => 'payload_url',
            'label'              => __('Payload URL'),
            'title'              => __('Payload URL'),
            'required'           => true,
            'note'               => __('You can insert a variable'),
            'after_element_html' => '<a id="insert-variable-upload" class="btn">' . __('Insert Variable') . '</a>',
        ]);
        $fieldset->addField('method', 'select', [
            'name'   => 'method',
            'label'  => __('Method'),
            'title'  => __('Method'),
            'values' => $this->method->toOptionArray(),
        ]);

        $authentication = $fieldset->addField('authentication', 'select', [
            'name'   => 'authentication',
            'label'  => __('Authentication'),
            'title'  => __('Authentication'),
            'values' => $this->authentication->toOptionArray(),

        ]);
        $username       = $fieldset->addField('username', 'text', [
            'name'  => 'username',
            'label' => __('Username'),
            'title' => __('Username'),
        ]);
        $realm          = $fieldset->addField('realm', 'text', [
            'name'  => 'realm',
            'label' => __('Realm'),
            'title' => __('Realm'),
        ]);
        $password       = $fieldset->addField('password', 'password', [
            'name'  => 'password',
            'label' => __('Password'),
            'title' => __('Password'),
        ]);
        $nonce          = $fieldset->addField('nonce', 'text', [
            'name'  => 'nonce',
            'label' => __('Nonce'),
            'title' => __('Nonce'),
        ]);
        $algorithm      = $fieldset->addField('algorithm', 'text', [
            'name'  => 'algorithm',
            'label' => __('Algorithm'),
            'title' => __('Algorithm'),
        ]);
        $qop            = $fieldset->addField('qop', 'text', [
            'name'  => 'qop',
            'label' => __('qop'),
            'title' => __('qop'),
        ]);
        $nonceCount     = $fieldset->addField('nonce_count', 'text', [
            'name'  => 'nonce_count',
            'label' => __('Nonce Count'),
            'title' => __('Nonce Count'),
        ]);
        $clientNonce    = $fieldset->addField('client_nonce', 'text', [
            'name'  => 'client_nonce',
            'label' => __('Client Nonce'),
            'title' => __('Client Nonce'),
        ]);
        $opaque         = $fieldset->addField('opaque', 'text', [
            'name'  => 'opaque',
            'label' => __('Opaque'),
            'title' => __('Opaque'),
        ]);
        // trungpv
        $callback         = $fieldset->addField('callback', 'text', [
            'name'  => 'callback',
            'label' => __('Callback URL'),
            'title' => __('Callback URL'),
        ]);
        $consumerKey         = $fieldset->addField('consumerKey', 'text', [
            'name'  => 'consumerKey',
            'label' => __('Consumer Key'),
            'title' => __('Consumer Key'),
        ]);
        $consumerSecret         = $fieldset->addField('consumerSecret', 'text', [
            'name'  => 'consumerSecret',
            'label' => __('Consumer Secret'),
            'title' => __('Consumer Secret'),
        ]);
        $disabled         = $fieldset->addField('disabled', 'text', [
            'name'  => 'disabled',
            'label' => __('Disabled'),
            'title' => __('Disabled'),
        ]);
        $privateKey         = $fieldset->addField('privateKey', 'text', [
            'name'  => 'privateKey',
            'label' => __('Private Key'),
            'title' => __('Private Key'),
        ]);
        $signatureMethod         = $fieldset->addField('signatureMethod', 'text', [
            'name'  => 'signatureMethod',
            'label' => __('Signature Method'),
            'title' => __('Signature Method'),
        ]);
        $timestamp         = $fieldset->addField('timestamp', 'text', [
            'name'  => 'timestamp',
            'label' => __('Timestamp'),
            'title' => __('Timestamp'),
        ]);
        $tokenKey         = $fieldset->addField('tokenKey', 'text', [
            'name'  => 'tokenKey',
            'label' => __('Token Key'),
            'title' => __('Token Key'),
        ]);
        $tokenSecret         = $fieldset->addField('tokenSecret', 'text', [
            'name'  => 'tokenSecret',
            'label' => __('Token Secret'),
            'title' => __('Token Secret'),
        ]);
        $type         = $fieldset->addField('type', 'text', [
            'name'  => 'type',
            'label' => __('Type'),
            'title' => __('Type'),
        ]);
        $version         = $fieldset->addField('version', 'text', [
            'name'  => 'version',
            'label' => __('Version'),
            'title' => __('Version'),
        ]);
        /** @var \Magento\Framework\Data\Form\Element\Renderer\RendererInterface $rendererBlock */
        $rendererBlock = $this->getLayout()
            ->createBlock('Mageplaza\Webhook\Block\Adminhtml\Hook\Edit\Tab\Renderer\Headers');
        $fieldset->addField('headers', 'text', [
            'name'  => 'headers',
            'label' => __('Header'),
            'title' => __('Header'),
        ])->setRenderer($rendererBlock);
        $fieldset->addField('content_type', 'select', [
            'name'   => 'content_type',
            'label'  => __('Content Type'),
            'title'  => __('Content Type'),
            'values' => $this->contentType->toOptionArray(),

        ]);
        /** @var \Magento\Framework\Data\Form\Element\Renderer\RendererInterface $rendererBlock */
        $rendererBlock = $this->getLayout()->createBlock('Mageplaza\Webhook\Block\Adminhtml\Hook\Edit\Tab\Renderer\Body');
        $fieldset->addField('body', 'textarea', [
            'name'  => 'body',
            'label' => __('Body'),
            'title' => __('Body'),
            'note'  => __('Supports <a href="https://shopify.github.io/liquid/" target="_blank">Liquid template</a>')
        ])->setRenderer($rendererBlock);

        $refField = $this->fieldFactory->create(['fieldData' => ['value' => 'basic,digest', 'separator' => ','], 'fieldPrefix' => '']);
        $refFieldOAuth = $this->fieldFactory->create(['fieldData' => ['value' => 'digest,oauth', 'separator' => ','], 'fieldPrefix' => '']);

        $this->setChild('form_after',
            $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Form\Element\Dependence')
                ->addFieldMap($authentication->getHtmlId(), $authentication->getName())
                ->addFieldMap($username->getHtmlId(), $username->getName())
                ->addFieldMap($realm->getHtmlId(), $realm->getName())
                ->addFieldMap($password->getHtmlId(), $password->getName())
                ->addFieldMap($nonce->getHtmlId(), $nonce->getName())
                ->addFieldMap($algorithm->getHtmlId(), $algorithm->getName())
                ->addFieldMap($qop->getHtmlId(), $qop->getName())
                ->addFieldMap($nonceCount->getHtmlId(), $nonceCount->getName())
                ->addFieldMap($clientNonce->getHtmlId(), $clientNonce->getName())
                ->addFieldMap($opaque->getHtmlId(), $opaque->getName())
                ->addFieldMap($callback->getHtmlId(), $callback->getName())//trungpv
                ->addFieldMap($consumerKey->getHtmlId(), $consumerKey->getName())
                ->addFieldMap($consumerSecret->getHtmlId(), $consumerSecret->getName())
                ->addFieldMap($disabled->getHtmlId(), $disabled->getName())
                ->addFieldMap($privateKey->getHtmlId(), $privateKey->getName())
                ->addFieldMap($signatureMethod->getHtmlId(), $signatureMethod->getName())
                ->addFieldMap($timestamp->getHtmlId(), $timestamp->getName())
                ->addFieldMap($tokenKey->getHtmlId(), $tokenKey->getName())
                ->addFieldMap($tokenSecret->getHtmlId(), $tokenSecret->getName())
                ->addFieldMap($type->getHtmlId(), $type->getName())
                ->addFieldMap($version->getHtmlId(), $version->getName())
                ->addFieldDependence($username->getName(), $authentication->getName(), $refField)
                ->addFieldDependence($password->getName(), $authentication->getName(), $refField)
                ->addFieldDependence($realm->getName(), $authentication->getName(), $refFieldOAuth)
                ->addFieldDependence($nonce->getName(), $authentication->getName(), $refFieldOAuth)
                ->addFieldDependence($algorithm->getName(), $authentication->getName(), 'digest')
                ->addFieldDependence($qop->getName(), $authentication->getName(), 'digest')
                ->addFieldDependence($nonceCount->getName(), $authentication->getName(), 'digest')
                ->addFieldDependence($clientNonce->getName(), $authentication->getName(), 'digest')
                ->addFieldDependence($opaque->getName(), $authentication->getName(), 'digest')
                ->addFieldDependence($callback->getName(), $authentication->getName(), 'oauth') // trungpv
                ->addFieldDependence($consumerKey->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($consumerSecret->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($disabled->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($privateKey->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($signatureMethod->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($timestamp->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($tokenKey->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($tokenSecret->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($type->getName(), $authentication->getName(), 'oauth')
                ->addFieldDependence($version->getName(), $authentication->getName(), 'oauth')
        );

        $form->addValues($hook->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Actions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Get form HTML
     *
     * @return string
     */
    public function getFormHtml()
    {
        $formHtml  = parent::getFormHtml();
        $childHtml = $this->getChildHtml();

        return $formHtml . $childHtml;
    }
}
