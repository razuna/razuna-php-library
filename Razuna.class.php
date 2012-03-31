<?php

/*
 *
 * Copyright (C) 2005-2008 Razuna Ltd.
 *
 * This file is part of Razuna - Enterprise Digital Asset Management.
 *
 * Razuna is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Razuna is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero Public License for more details.
 *
 * You should have received a copy of the GNU Affero Public License
 * along with Razuna. If not, see <http://www.gnu.org/licenses/>.
 *
 * You may restribute this Program with a special exception to the terms
 * and conditions of version 3.0 of the AGPL as described in Razuna's
 * FLOSS exception. You should have received a copy of the FLOSS exception
 * along with Razuna. If not, see <http://www.razuna.com/licenses/>.
 *
 *
 * HISTORY:
 * Date US Format		User					Note
 * 2012/03/31			Tapan Kumar Thapa		Initial Library
 */

class Razuna {

    const FOLDER_URI = '/razuna/global/api2/folder.cfc?';
    const COLLECTION_URI = '/razuna/global/api2/collection.cfc?';
    const HOSTS_URI = '/razuna/global/api2/hosts.cfc?';
    const SEARCH_URI = '/razuna/global/api2/search.cfc?';
    const USER_URI = '/razuna/global/api2/user.cfc?';
    const ASSET_URI = '/razuna/global/api2/asset.cfc?';
    const ASSET_TYPE_ALL = 'all';
    const ASSET_TYPE_IMAGE = 'img';
    const ASSET_TYPE_VIDEO = 'vid';
    const ASSET_TYPE_DOCUMENT = 'doc';
    const ASSET_TYPE_AUDIO = 'aud';
    const DOC_TYPE_EMPTY = 'empty';
    const DOC_TYPE_PDF = 'pdf';
    const DOC_TYPE_EXCEL = 'xls';
    const DOC_TYPE_WORD = 'doc';
    const DOC_TYPE_OTHER = 'other';
    const FOLDER_ID = 0;
    const COLLECTION_FOLDER = 'false';

    private $curl;
    private $config_host;
    private $config_api_key;

    public function connect($host, $api_key) {
        $this->config_host = $host;
        $this->config_api_key = $api_key;
    }

    /*     * ***********************
     *          ASSET         *
     * ************************* */

    private function initasset() {
        $this->curl = $this->buildCurlClient(self::ASSET_URI);
    }

    // Tested working fine
    public function getasset($assetid, $assettype) {
        $this->initasset();

        $fields = array(
            'method' => 'getasset',
            'api_key' => $this->config_api_key,
            'assetid' => $assetid,
            'assettype' => $assettype
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getrenditions($assetid, $assettype) {
        $this->initasset();

        $fields = array(
            'method' => 'getrenditions',
            'api_key' => $this->config_api_key,
            'assetid' => $assetid,
            'assettype' => $assettype
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getmetadata($assetid, $assettype, $assetmetadata) {
        $this->initasset();

        $fields = array(
            'method' => 'getmetadata',
            'api_key' => $this->config_api_key,
            'assetid' => $assetid,
            'assettype' => $assettype,
            'assetmetadata' => $assetmetadata
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function setmetadata($assetid, $assettype, $assetmetadata) {
        $this->initasset();

        $fields = array(
            'method' => 'setmetadata',
            'api_key' => $this->config_api_key,
            'assetid' => $assetid,
            'assettype' => $assettype,
            'assetmetadata' => $assetmetadata
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function remove($assetid) {
        $this->initasset();

        $fields = array(
            'method' => 'remove',
            'api_key' => $this->config_api_key,
            'assetid' => $assetid
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *         SEARCH         *
     * ************************* */

    private function initsearch() {
        $this->curl = $this->buildCurlClient(self::SEARCH_URI);
    }

    // Tested working fine
    public function searchassets($searchfor, $show = self::ASSET_TYPE_ALL, $doctype = self::DOC_TYPE_EMPTY) {
        $this->initsearch();

        $fields = array(
            'method' => 'searchassets',
            'api_key' => $this->config_api_key,
            'searchfor' => $searchfor,
            'show' => $show,
            'doctype' => $doctype
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *          FOLDER        *
     * ************************* */

    private function initfolder() {
        $this->curl = $this->buildCurlClient(self::FOLDER_URI);
    }

    // Tested working fine
    public function getfolders($folderid, $collectionfolder = self::COLLECTION_FOLDER) {
        $this->initfolder();
        $fields = array(
            'method' => 'getfolders',
            'api_key' => $this->config_api_key,
            'folderid' => $folderid,
            'collectionfolder' => $collectionfolder
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getassets($folderid, $showsubfolders = self::COLLECTION_FOLDER, $show = self::ASSET_TYPE_ALL) {
        $this->initfolder();

        $fields = array(
            'method' => 'getassets',
            'api_key' => $this->config_api_key,
            'folderid' => $folderid,
            'showsubfolders' => $showsubfolders,
            'show' => $show
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getfolder($folderid) {
        $this->initfolder();

        $fields = array(
            'method' => 'getfolder',
            'api_key' => $this->config_api_key,
            'folderid' => $folderid
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function setfolder($folder_name, $folder_owner = 0, $folder_related = 0, $folder_collection = 0, $folder_description = 0) {
        $this->initfolder();

        $fields = array(
            'method' => 'setfolder',
            'api_key' => $this->config_api_key,
            'folder_name' => $folder_name,
            'folder_owner' => $folder_owner,
            'folder_related' => $folder_related,
            'folder_collection' => $folder_collection,
            'folder_description' => $folder_description
        );
        if ($folder_owner == 0) {
            unset($fields['folder_owner']);
        }
        if ($folder_related == 0) {
            unset($fields['folder_related']);
        }
        if ($folder_collection == 0) {
            unset($fields['folder_collection']);
        }
        if ($folder_description == 0) {
            unset($fields['folder_description']);
        }
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function removefolder($folder_id) {
        $this->initfolder();

        $fields = array(
            'method' => 'removefolder',
            'api_key' => $this->config_api_key,
            'folder_id' => $folder_id
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *       COLLECTION               *
     * ************************* */

    private function initcollection() {
        $this->curl = $this->buildCurlClient(self::COLLECTION_URI);
    }

    // Tested working fine
    public function getcollections($folderid) {
        $this->initcollection();
        $fields = array(
            'method' => 'getcollections',
            'api_key' => $this->config_api_key,
            'folderid' => $folderid
        );

        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getcollectionassets($collectionid) {
        $this->initcollection();
        $fields = array(
            'method' => 'getassets',
            'api_key' => $this->config_api_key,
            'collectionid' => $collectionid
        );

        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *       USER               *
     * ************************* */

    private function initUser() {
        $this->curl = $this->buildCurlClient(self::USER_URI);
    }

    // Tested working fine
    public function add($user_first_name, $user_last_name, $user_email, $user_name, $user_pass, $user_active = 'F', $groupid = 0) {
        $this->initUser();
        $fields = array(
            'method' => 'add',
            'api_key' => $this->config_api_key,
            'user_first_name' => $user_first_name,
            'user_last_name' => $user_last_name,
            'user_email' => $user_email,
            'user_name' => $user_name,
            'user_pass' => $user_pass,
            'user_active' => $user_active,
            'groupid' => $groupid
        );

        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function updatebyuserid($userid, $userdata) {
        $this->initUser();
        $fields = array(
            'method' => 'update',
            'api_key' => $this->config_api_key,
            'userid' => $userid,
            'userdata' => $userdata
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function updatebyuserloginname($userloginname, $userdata) {
        $this->initUser();
        $fields = array(
            'method' => 'update',
            'api_key' => $this->config_api_key,
            'userloginname' => $userloginname,
            'userdata' => $userdata
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function updatebyuseremail($useremail, $userdata) {
        $this->initUser();
        $fields = array(
            'method' => 'update',
            'api_key' => $this->config_api_key,
            'useremail' => $useremail,
            'userdata' => $userdata
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function getuser() {
        $this->initUser();
        $fields = array(
            'method' => 'getuser',
            'api_key' => $this->config_api_key
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function deletebyuserid($userid) {
        $this->initUser();
        $fields = array(
            'method' => 'delete',
            'api_key' => $this->config_api_key,
            'userid' => $userid
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function deletebyuserloginname($userloginname) {
        $this->initUser();
        $fields = array(
            'method' => 'delete',
            'api_key' => $this->config_api_key,
            'userloginname' => $userloginname
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    // Tested working fine
    public function deletebyuseremail($useremail) {
        $this->initUser();
        $fields = array(
            'method' => 'delete',
            'api_key' => $this->config_api_key,
            'useremail' => $useremail
        );
        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *       HOSTS               *
     * ************************* */

    private function inithosts() {
        $this->curl = $this->buildCurlClient(self::HOSTS_URI);
    }

    // Tested working fine
    public function gethosts() {
        $this->inithosts();
        $fields = array(
            'method' => 'gethosts',
            'api_key' => $this->config_api_key
        );

        return $this->curl->RazunaCurlCall($fields);
    }

    /*     * ***********************
     *     MISCELLANEOUS      *
     * ************************* */

    private function buildCurlClient($uri) {
        try {
            $host = '';
            if (strpos($this->config_host, "http://") == false || strpos($this->config_host, "https://") == false)
                $host .= 'http://';
            $host .= $this->config_host;
            return new RazunaCurl($host . $uri);
        } catch (Exception $e) {
            throw new RazunaNotAvailableException($e->getMessage());
        }
    }

}

class RazunaCurl {

    private $uri;

    public function __construct() {
        $argv = func_get_args();
        if (!empty($argv)) {
            $this->setUri($argv[0]);
        }
    }

    private function setUri($uri) {
        $this->uri = $uri;
    }

    public function RazunaCurlCall($fields) {
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); // Socket Timeout value in milii second.
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 7); // Total time to fetch the response in seconds after socket is opened.
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
        $responsecode = curl_getinfo($ch);
        curl_close($ch);
        if ($responsecode['http_code'] == '200') {
            return $response;
        } else {
            return 'Razuna API Calling Failed.';
        }
    }

}

?>