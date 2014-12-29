<?php

/*
 * This file is part of the WorkflowyPHP package.
 *
 * (c) Johan Satgé
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace WorkflowyPHP;

class WorkflowyList
{

    private $id;
    private $name;
    private $complete;
    private $description;
    private $sublists;

    private $transport;

    /**
     * Builds a recursive list
     * @param array                $data
     * @param array                $sublists
     * @param   WorkflowyTransport $transport
     * @internal param string $client_id
     */
    public function __construct($data, $sublists, $transport)
    {
        $this->id          = !empty($data['id']) ? $data['id'] : '';
        $this->name        = !empty($data['name']) ? $data['name'] : '';
        $this->description = !empty($data['description']) ? $data['description'] : '';
        $this->complete    = !empty($data['complete']) && $data['complete'];
        $this->sublists    = $sublists; // @todo check type
        $this->transport   = $transport; // @todo check type
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getParent()
    {
        // @todo
    }

    public function isComplete()
    {
        // @todo
    }

    public function getOPML()
    {
        // @todo
    }

    /**
     * Search recursively if the list has the requested name
     * @todo allow regexps ?
     * @todo return multiple results ?
     * @param string $name
     * @return bool|WorkflowyList
     */
    public function search($name)
    {
        if (preg_match('/' . preg_quote($name, '/') . '/i', $this->name))
        {
            return $this;
        }
        foreach ($this->sublists as $child)
        {
            $match = $child->search($name);
            if ($match !== false)
            {
                return $match;
            }
        }
        return false;
    }

    public function setName($name)
    {
        // @todo
    }

    public function setDescription($description)
    {
        // @todo
    }

    public function setParent($parent, $priority)
    {
        // @todo
    }

    public function setComplete($complete)
    {
        // @todo
    }


    /*

    public function createList($name, $description, $priority)
    {
        // @todo
        /*
         (object)array(
            'type' => 'create',
            'data' => (object)array(
                'projectid' => $generated_test_id,
                'parentid'  => 'None',
                'priority'  => 6
            )
        )
        /!\ after created, launch edit()
         *
    }

    /*
     * Moves the list by setting a new parent and display priority
     * @param WorkflowyList $parent_list
     * @param int $priority
     * @throws WorkflowyError
     * @todo check answer
     *
    public function setPosition($parent_list, $priority)
    {
        if (empty($parent_list) || get_class($parent_list) !== __CLASS__)
        {
            throw new WorkflowyError('The method requires a ' . __CLASS__ . ' object');
        }
        $this->session->performListRequest('move', array(
            'projectid' => $this->id,
            'parentid'  => $parent_list->id(),
            'priority'  => intval($priority)
        ), $this->clientID);
    }

    /*
     * Sets the list status (TRUE when its complete, FALSE otherwise)
     * @param bool $complete
     * @todo check answer
     *
    public function setComplete($complete = true)
    {
        $this->session->performListRequest($complete ? 'complete' : 'uncomplete', array(
            'projectid' => $this->id
        ), $this->clientID);
    }

    public function deleteList()
    {
        // @todo
    }

    /*
     * Sets the list name
     * @param string $name
     * @todo check answer
     *
    public function setName($name)
    {
        $this->session->performListRequest('edit', array(
            'projectid' => $this->id,
            'name'      => $name
        ), $this->clientID);
    }

    /*
     * Sets the list description
     * @param string $description
     * @todo check answer
     *
    public function setDescription($description)
    {
        $this->session->performListRequest('edit', array(
            'projectid'   => $this->id,
            'description' => $description
        ), $this->clientID);
    }

    public function getOPML()
    {
        // @todo
    }

    private function generateID()
    {
        //return((1+Math.random())*65536|0).toString(16).substring(1)
        // k()+k()+" - "+k()+" - "+k()+" - "+k()+" - "+k()+k()+k()
        return preg_replace_callback('#r#', function ()
        {
            return substr(base_convert((1 + ((float)rand() / (float)getrandmax())) * 65536 | 0, 10, 16), 1);
        }, 'rr-r-r-r-rrr');
    }*/

}