<?php

/**
 * CM Invitation Codes model
 * @package CMInvitationCodes/Library
 */
include_once CMIC_PATH . '/lib/CMInvitationCodes.php';

/**
 * CM Invitation Codes model
 *
 * @author CreativeMinds
 * @version 1.0
 * @copyright Copyright (c) 2012, CreativeMinds
 * @package CMInvitationCodes/Library
 */
class CMInvitationCode {

    /**
     * @var int Invitation Code ID 
     */
    protected $_id;

    /**
     * @var datetime Date of creation 
     */
    protected $_time;

    /**
     * @var string Invitation Code
     */
    protected $_invitationCode;

    /**
     * @var int Registrations limit 
     */
    protected $_registrationLimit;

    /**
     * @var bool Is activation needed? 
     */
    protected $_activationNeeded;

    /**
     * @var string Group name
     */
    protected $_group;

    /**
     * @var boolean Is deleted?
     */
    protected $_deleted = false;

    /**
     * @var array List of user logins 
     */
    protected $_users = array();

    protected $_wlm = null;
    /**
     * No registration limit
     */
    const NO_LIMIT = 0;

    /**
     * Singleton method instantiating code record
     * @global type $wpdb
     * @param string $code Invitation Code string
     * @return CMInvitationCode|null 
     */
    public static function getInstance($code) {
        global $wpdb;
        $sql = $wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . CMInvitationCodes::DB_INVITATION_CODES . ' WHERE invitationCode=%s', $code);
        $result = $wpdb->get_row($sql);
        if (empty($result))
            return null;
        else {
            $codeObj = new self($result);
            return $codeObj;
        }
    }

    /**
     * Get code by group name
     * @global type $wpdb
     * @param string $group
     * @return CMInvitationCode|null 
     */
    public static function getInstanceByGroup($group) {
        global $wpdb;
        $sql = $wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . CMInvitationCodes::DB_INVITATION_CODES . ' WHERE `group`=%s', $group);
        $result = $wpdb->get_row($sql);
        if (empty($result))
            return null;
        else {
            $codeObj = new self($result);
            return $codeObj;
        }
    }

    /**
     * Constructor
     * @param stdClass $row 
     */
    public function __construct($row) {
        if ($row instanceof stdClass) {
            $this->_id = $row->id;
            $this->_time = $row->time;
            $this->_invitationCode = $row->invitationCode;
            $this->_registrationLimit = $row->registrationsLimit;
            $this->_activationNeeded = $row->activationNeeded;
            $this->_group = $row->group;
            $this->_deleted = ($row->deleted==1);
            $this->_wlm = $row->wlm;
            $users = $row->users;
            if (!empty($users)) {
                $users = unserialize($users);
                $this->_users = $users;
            }
        } elseif (is_array($row)) {
            $this->setCode($row['invitationCode'])
                    ->setLimit($row['registrationsLimit'])
                    ->setActivationNeeded($row['activationNeeded'])
                    ->setGroup($row['group'])
                    ->setWLM($row['wlm']);
        }
    }

    /**
     * Get time of creation
     * @return datetime 
     */
    public function getTime() {
        return $this->_time;
    }

    /**
     * Get code string
     * @return string 
     */
    public function getCode() {
        return $this->_invitationCode;
    }

    /**
     * Sets new code string
     * @param string $code
     * @return CMInvitationCode 
     */
    public function setCode($code) {
        $this->_invitationCode = $code;
        return $this;
    }

    /**
     * Gets registrations limit
     * @return int|string 'No limit' if 0 
     */
    public function getLimit() {
        if ($this->_registrationLimit == self::NO_LIMIT)
            return 'No limit';
        return $this->_registrationLimit;
    }

    /**
     * Sets new registration limit
     * @param int $limit
     * @return CMInvitationCode 
     */
    public function setLimit($limit) {
        $this->_registrationLimit = $limit;
        return $this;
    }

    /**
     * Is activation needed
     * @return bool 
     */
    public function isActivationNeeded() {
        return $this->_activationNeeded;
    }

    /**
     * Sets if activation is needed
     * @param bool $activation
     * @return CMInvitationCode 
     */
    public function setActivationNeeded($activation) {
        $this->_activationNeeded = $activation;
        return $this;
    }

    /**
     * Is deleted?
     * @return bool 
     */
    public function isDeleted() {
        return $this->_deleted;
    }

    /**
     * Mark as deleted
     * @param bool $deleted
     * @return CMInvitationCode 
     */
    public function setDeleted($deleted = true) {
        $this->_deleted = $deleted;
        return $this;
    }
        /**
     * Get WLM Settings for group
     * @return string
     */
    public function getWLM() {
        return $this->_wlm;
    }

    /**
     * Set WLM Settings for group
     * @param string $wlm
     * @return CMInvitationCode 
     */
    public function setWLM($wlm = null) {
        $this->_wlm = $wlm;
        return $this;
    }

    /**
     * Get group name
     * @return string 
     */
    public function getGroup() {
        return $this->_group;
    }

    /**
     * Set group name
     * @param string $group
     * @return CMInvitationCode 
     */
    public function setGroup($group) {
        $this->_group = $group;
        return $this;
    }

    /**
     * Get list of user logins
     * @return array 
     */
    public function getUsers() {
        return $this->_users;
    }

    /**
     * Sets current time
     * @return CMInvitationCode 
     */
    public function setCurrentTime() {
        $this->_time = current_time('mysql');
        return $this;
    }

    /**
     * Save record in the DB
     * @global type $wpdb 
     */
    public function save() {
        global $wpdb;
        $data = array(
            'time' => $this->getTime(),
            'invitationCode' => $this->getCode(),
            'registrationsLimit' => $this->getLimit(),
            'activationNeeded' => $this->isActivationNeeded(),
            'group' => $this->getGroup(),
            'deleted' => $this->isDeleted() ? 1 : 0,
            'users' => serialize($this->getUsers()),
            'wlm' => $this->getWLM()
        );
        if (!empty($this->_id))
            $wpdb->update($wpdb->prefix . CMInvitationCodes::DB_INVITATION_CODES, $data, array(
                'id' => $this->_id
            ));
        else
            $wpdb->insert($wpdb->prefix . CMInvitationCodes::DB_INVITATION_CODES, $data);
    }

    /**
     * Create new code based on data
     * @param array $data
     * @return CMInvitationCode 
     */
    public static function newCode(array $data) {
        $instance = new self($data);
        $instance->setCurrentTime();
        $instance->save();
        return $instance;
    }

    /**
     * Add user who used this invitation code
     * @param string $login 
     */
    public function addUser($login) {
        $this->_users[] = $login;
        $this->_users = array_unique($this->_users);
        $this->save();
    }

    /**
     * Remove user from list of users who used this invitation code
     * @param string $login 
     */
    public function removeUser($login) {
        foreach ($this->_users as $key => $user) {
            if ($login == $user)
                unset($this->_users[$key]);
        }
        $this->save();
    }

    /**
     * Check if code is available (registration limit not exceeded)
     * @return bool 
     */
    public function isAvailable() {
        return (!$this->isDeleted() && ($this->_registrationLimit == self::NO_LIMIT) || (count($this->getUsers()) < $this->getLimit()));
    }

}

?>
