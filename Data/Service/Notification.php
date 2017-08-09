<?php

namespace Data\Service;

use Spell\Data\Doctrine\AbstractService;
use Spell\MVC\Flash\Theme;
use Spell\Flash\SMTP;
use Spell\UI\Layout\View;

/**
 * Description of Notification
 *
 * @author moysesoliveira
 */
class Notification extends AbstractService {

    /**
     *
     * @var \Spell\Data\Service\SMTP
     */
    private $smtp = null;

    /**
     *
     * @var \Spell\UI\Layout\Theme
     */
    private $theme = null;

    /**
     * 
     * @param View $view
     * @param string $fromName
     * @param array $data
     * @param type $smtpSettingKey
     */
    public function __construct(View $view, string $fromName, array $data = [], $smtpSettingKey = 'default')
    {
        $this->theme = Theme::get('notification')->addView('content', $view)->setData($data);
        $this->smtp = SMTP::get($smtpSettingKey);
        $this->getSmtp()->setFromName($fromName);
    }
    
    /**
     * 
     * @return \Spell\UI\Layout\Theme
     */
    public function getTheme():\Spell\UI\Layout\Theme {
        return $this->theme;
    }
    
    /**
     * 
     * @return \Spell\Data\Service\SMTP
     */
    public function getSmtp():\Spell\Data\Service\SMTP {
        return $this->smtp;
    }

    /**
     * 
     * @param string $email
     * @param string|null $name
     * @return \Data\Service\Notification
     */
    public function addTo(string $email, ?string $name = null) : Notification {
       $this->getSmtp()->addTo($email, $name);
       return $this;
    }
    
    /**
     * 
     * @param string $subject
     */
    public function submit(string $subject)
    {
        $this->getSmtp()->setSubject($subject);
        $body = $this->getTheme()->addData('subject', $subject)->header(200)->render();
        $this->getSmtp()->setBody($body)->send();
    }

}
