<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 19.02.19
 * Time: 16:45
 */

namespace Core;

use Core\HTTP\Session;

class MessageBag
{
    /**
     * @var Session
     */
    private $session;

    /**
     * MessageBag constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    private function add(string $key, string $message)
    {
        $messages = $this->session->get($key, []);
        $messages[] = $message;
        $this->session->set($key, $messages);
    }

    private function pull($key)
    {
        $messages = $this->session->get($key);
        $this->session->remove($key);

        return $messages;
    }

    public function addMessage(string $message)
    {
        $this->add('message', $message);
    }

    public function addError(string $message)
    {
        $this->add('errors', $message);
    }

    public function pullMessages()
    {
        return $this->pull('message');
    }

    public function pullErrors()
    {
        return $this->pull('errors');
    }
}