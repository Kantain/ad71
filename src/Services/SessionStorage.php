<?php

namespace pw\Services;

session_start();

/**
 * @class SessionStorage
 * Create a collection stores into PHP session
 */
class SessionStorage
{
    public function __construct()
    {
        if (!isset($_SESSION['collection'])) {
            $_SESSION['collection'] = [];
        }
    }

    /**
     * Add an element into collection
     * @param mixed $element
     * @return SessionStorage
     */
    public function addElement($element)
    {
        $_SESSION['collection'][] = $element;

        return $this;
    }

    /**
     * Get all elements of collection
     * @return array
     */
    public function getElements()
    {
        return $_SESSION['collection'];
    }

    /**
     * Remove an element
     * @param int $index
     * @return array
     */
    public function removeElement($index)
    {
        if (isset($_SESSION['collection'][$index])) {
            unset($_SESSION['collection'][$index]);
        }

        return $_SESSION['collection'];
    }

    public function setConnected($_bool){
        $_SESSION['connected'] = $_bool;
        return $this;
    }

    public function isConnected(){
        if(isset($_SESSION['connected']))
            return $_SESSION['connected'];
        else
            return false;
    }

    public function setConnectedAdmin($_bool){
        $_SESSION['admin'] = $_bool;
        return $this;
    }

    public function isConnectedAdmin(){
        if(isset($_SESSION['admin']))
            return $_SESSION['admin'];
        else
            return false;
    }

    public function setPresidentNom($_login){
        $_SESSION['president']['nom'] = $_login;
        return $this;
    }

    public function unsetPresident(){
        unset($_SESSION['president']);
        return $this;
    }

    public function getPresidentNom(){
        return $_SESSION['president']['nom'];
    }

}
