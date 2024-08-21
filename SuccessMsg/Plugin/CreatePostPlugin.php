<?php

namespace Kitchen365\SuccessMsg\Plugin;

use Magento\Customer\Controller\Account\CreatePost;
use Magento\Framework\Message\ManagerInterface;

class CreatePostPlugin
{
    protected $messageManager;

    public function __construct(ManagerInterface $messageManager)
    {
        $this->messageManager = $messageManager;
    }

    public function aroundExecute(CreatePost $subject, \Closure $proceed)
    {
        $result = $proceed();

        $this->messageManager->getMessages(true);

        $this->messageManager->addSuccessMessage(
            __('Thank you for registering with Main Website Store. Team will approve your account and share the access shortly.')
        );

        return $result;
    }
}
