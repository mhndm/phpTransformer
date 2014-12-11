<?php

/*
 * Created on May 04, 2010
 * Objective - 
  YouTube API implementation of Client Login Authentication and managing user's data.

 * Author: Sandip Karande (sandip.karande@gmail.com)

 *
 *
 */
?>
<?php

class ClassYouTubeAPI {

    /**
     *  developerKey
     */
    public $developerKey = "AIzaSyCj_FczAzkNCcnwI0Yua5C2xRej5qoKcLQ";

    /**
     *  accessToken - authorization access taken 
     */
    public $accessToken;

    /**
     *  next_index - used to track short results
     */
    public $next_index;

    /**
     *  authType - authentication type GoogleLogin or  AuthSub
     */
    public $authType;

    /**
     *  initializes the token and API key information for API methods which requires authentication information
     *  @param developerKey - String 
     *  @param accessToken - array
     *  @return void
     *  @access public
     *  Modified: Sandip
     */
    public function __construct($developerKey = "AIzaSyCj_FczAzkNCcnwI0Yua5C2xRej5qoKcLQ", $accessToken = '', $authType = 'AuthSub') {
        $this->accessToken = $accessToken;
        $this->authType = $authType;
        $this->developerKey = $developerKey;
    }

    /**
     *  client login authentication
     *  @param username - String 
     *  @param pass - String
     *  @return array
     *  @access public
     *  Modified: Sandip
     */
    public function clientLoginAuth($username, $pass) {
        $this->authType = 'GoogleLogin';
        $url = 'https://www.google.com/youtube/accounts/ClientLogin';
        $data = 'Email=' . urlencode($username) . '&Passwd=' . urlencode($pass) . '&service=youtube&source=Test';
        $result = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlheader[0] = "Content-Type:application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
        $result['output'] = curl_exec($ch);
        $result['err'] = curl_errno($ch);
        $result['errmsg'] = curl_error($ch);
        $result['header'] = curl_getinfo($ch);
        $temp = explode("YouTubeUser=", $result['output']);
        $result['username'] = $username;
        $temp2 = explode("=", trim($temp[0]));
        if (isset($temp2[1])) {
            $result['token'] = trim($temp2[1]);
        }
        $this->accessToken = $result['token'];
        curl_close($ch);
        return $result;
    }

    /**
     *  send HTTP GET request useful for api calls which require authentication information
     *
     *  @param url - String 
     *  @return result - array
     *  @access public
     *  Modified: Sandip
     */
    public function make_api_call($url) {
        //echo "<br>".$url;
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token == '' || $developerKey == '')
            return "Authorization required";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($this->authType == 'GoogleLogin')
            $curlheader[0] = "Authorization: " . $this->authType . " auth=\"$token\"";
        else
            $curlheader[0] = "Authorization: " . $this->authType . " token=\"$token\"";
        $curlheader[1] = "X-GData-Key: key=\"$developerKey\"";
        $curlheader[2] = "Content-Type:application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
        $output = curl_exec($ch);

        $result['output'] = $output;
        $result['err'] = curl_errno($ch);
        $result['errmsg'] = curl_error($ch);
        $result['header'] = curl_getinfo($ch);
        curl_close($ch);
        return $output;
    }

    /**
     *  send HTTP GET request useful for api calls which does not require authentication information
     *
     *  @param url - String 
     *  @return result - array
     *  @access public
     *  Modified: Sandip
     */
    public function make_get_call($url) {

        $result = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result['output'] = curl_exec($ch);
        $result['err'] = curl_errno($ch);
        $result['errmsg'] = curl_error($ch);
        $result['header'] = curl_getinfo($ch);
        curl_close($ch);
        return $result;
    }

    /**
     *  get list of playlist for user
     *
     *  @param username - String 
     *  @param startindex - int records start number e.g. 1, 26,51 etc. according to page number
     *  @param maxresults - int results per page  default 25
     *  @return res - array
     *  @access public
     *  Modified: Sandip
     */
    public function getPlaylists($username = 'default', $startindex = 1, $maxresults = 25) {
        $url = 'http://gdata.youtube.com/feeds/api/users/' . $username . '/playlists?v=2&start-index=' . $startindex . '&max-results=' . $maxresults;

        $url .= '&strict=true';

        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token != '' && $developerKey != '') {
            $output = $this->make_api_call($url);
        } else {
            $response = $this->make_get_call($url);
            $output = $response['output'];
        }

        $result = array();

        $validresult = $this->checkErrors($output);

        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];

            $tmp = $xml->xpath("openSearch:totalResults");
            $result['totalresults'] = (string) $tmp[0];
            $tmp = $xml->xpath("openSearch:startIndex");
            $result['startindex'] = (string) $tmp[0];
            $tmp = $xml->xpath("openSearch:itemsPerPage");
            $result['itemsPerPage'] = (string) $tmp[0];

            $res = array();
            foreach ($xml->entry as $key => $node) {
                $temp = array();

                $ytMedia = $node->children('http://gdata.youtube.com/schemas/2007');
                $gdMedia = $node->children('http://schemas.google.com/g/2005');
                $media = $node->children('http://search.yahoo.com/mrss/');

                $temp['id'] = (string) $ytMedia->playlistId;
                $temp['thumbnail'] = $this->getPlayListThumbnail($temp['id']);
                $temp['published'] = (string) $node->published;
                $temp['updated'] = (string) $node->updated;
                $temp['title'] = (string) $node->title;
                $temp['description'] = (string) $node->summary;
                $temp['contentUrl'] = (string) $node->content->attributes()->src;
                $temp['totalVideos'] = (string) $ytMedia->countHint;
                $res[] = $temp;
            }
            $result['result'] = $res;
            unset($ytMedia);
            unset($gdMedia);
            unset($media);
            unset($res);
            unset($temp);
            unset($xml);
        } else {
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
        }
        unset($validresult);
        return $result;
    }

    /**
     *  get thumbnail image for the playlist
     *
     *  @param playlistId - String 		
     *  @return res - String
     *  @access public
     *  Modified: Sandip
     */
    public function getPlayListThumbnail($playlistId = '84FF75583310004D') {

        $url = 'http://www.youtube.com/view_play_list?p=' . $playlistId;
        $response = $this->make_get_call($url);
        $output = $response['output'];
        $img_reg_ex = '/src=\"(.*)\"[\s]+class=\"vimgCluster180 yt-uix-hovercard-target\"/';
        $res = preg_match_all($img_reg_ex, $output, $matches, PREG_PATTERN_ORDER);
        $images = @$matches[1];
        return @$images[0];
    }

    /**
     *  get video list for a playlist
     *
     *  @param playlistId - String 
     *  @param startindex - int records start number e.g. 1, 26,51 etc. according to page number
     *  @param maxresults - int results per page  default 25
     *  @param strict - String defaulr 'true'
     *  @param safeSearch - String default strict
     *  @return res - array
     *  @access public
     *  Modified: Sandip
     */
    public function getVideosbyPlayListId($playlistId, $startindex = 1, $maxresults = 25, $strict = 'true', $safeSearch = 'strict') {

        $url = 'http://gdata.youtube.com/feeds/api/playlists/' . $playlistId . '?v=2&start-index=' . $startindex . '&max-results=' . $maxresults;

        $url .= '&strict=' . $strict;
        $url .= '&safeSearch=' . $safeSearch;

        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token != '' && $developerKey != '') {
            $output = $this->make_api_call($url);
        } else {
            $response = $this->make_get_call($url);
            $output = $response['output'];
        }

        $result = array();
        $criteria = '';

        $validresult = $this->checkErrors($output);

        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];

            $tmp = $xml->xpath("openSearch:totalResults");
            $tmp_totalresults = (string) $tmp[0];

            $tmp = $xml->xpath("openSearch:startIndex");
            $result['startindex'] = (string) $tmp[0];

            $result['itemsPerPage'] = $maxresults;

            $result['title'] = (string) $xml->title;
            $result['subtitle'] = (string) $xml->subtitle;

            $res = $this->getFormatedVideoresult($xml, $criteria);

            //Pagination logic
            $shortCnt = $this->getShortCount($maxresults);

            if ($shortCnt > 0 && $tmp_totalresults > $maxresults) {
                $newStartIndex = $startindex + $maxresults;
                $newmaxresults = $shortCnt;

                $iteration = 1;
                while ($shortCnt > 0 && $tmp_totalresults >= $newStartIndex) {
                    if ($iteration != 1) {
                        $newStartIndex = $newStartIndex + $newmaxresults;
                        $newmaxresults = $shortCnt;
                    }
                    $iteration++;

                    $url = 'http://gdata.youtube.com/feeds/api/playlists/' . $playlistId . '?v=2&start-index=' . $newStartIndex . '&max-results=' . $newmaxresults;

                    $url .= '&strict=' . $strict;
                    $url .= '&safeSearch=' . $safeSearch;

                    $shortResult = $this->getShortResult($url, $criteria);

                    if (@$shortResult['is_error'] == 'No') {
                        if (!empty($shortResult['result'])) {
                            foreach ($shortResult['result'] as $shortkey => $shortItem)
                                $res[] = $shortItem;
                            $shortCnt = $this->getShortCount();
                        } else {
                            continue;
                        }
                    } else {
                        break;
                    }
                }//while

                $result['nextPageIndex'] = @(isset($shortResult['nextPageIndex']) ? $shortResult['nextPageIndex'] : 0);
            } else {

                $result['nextPageIndex'] = $result['startindex'] + count($this->next_index);
            }

            if ($tmp_totalresults < $result['nextPageIndex']) {
                $result['nextPageIndex'] = 0;
            }


            //pagination logic

            $result['totalresults'] = count($res);
            $result['result'] = $res;
            unset($res);

            unset($res);
            unset($xml);
        } else {
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
        }
        unset($validresult);

        return $result;
    }

    /**
     *  format output
     *
     *  @param xml - String xml response recived from searver which contains video information
     *  @param criteria - String - e.g. uploads, favorite etc. 
     *  @return res - array
     *  @access public
     *  Modified: Sandip
     */
    public function getFormatedVideoresult($xml, $criteria) {

        $res = array();
        $webSite = 'http://www.youtube.com/';
        $videoCategory = 'streaming';
        $index_arry = array();
        $this->next_index = array();
        $i = 0;
        foreach ($xml->entry as $entry) {
            $i++;
            $mediaInfo = array();
            $gdMedia = $entry->children('http://schemas.google.com/g/2005');
            $media = $entry->children('http://search.yahoo.com/mrss/');
            $ytMedia = $entry->children('http://gdata.youtube.com/schemas/2007');
            $georssMedia = $entry->children('http://www.georss.org/georss');
            if ($gdMedia->rating) {
                $rating = (string) $gdMedia->rating->attributes();
                $mediaInfo['rating'] = $rating['average'];
            } else {
                $mediaInfo['rating'] = 0;
            };
            if ($media->group->thumbnail) {
                $mediaInfo['iconImage'] = sprintf("%s", $media->group->thumbnail[0]->attributes()->url);
            } else {
                $mediaInfo['iconImage'] = '';
            }
            if ($media->group->title) {
                $mediaInfo['title'] = sprintf("%s", $media->group->title[0]);
            } else {
                $mediaInfo['title'] = '';
            }
            if ($media->group->description) {
                $mediaInfo['description'] = sprintf("%s", $media->group->description[0]);
            } else {
                $mediaInfo['description'] = '';
            }
            if ($media->group->player) {

                $video = $media->group->player[0]->attributes()->url;
                $vLink = preg_replace('/=/', "/", $video);
                $videoLink = preg_replace('/\?/', "/", $vLink);
                $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                $test_str = preg_split('/\/v\//', $videoLink, 2);
                $video_id_array = preg_split('/&/', @$test_str[1], 2);
                $mediaInfo['videoId'] = $video_id_array[0];
            } else {
                $tmp = @$entry->xpath("app:control");
                $tmp2 = @$tmp[0]->xpath("yt:state");
                if (@$tmp2[0]->attributes()->name == 'restricted') {
                    $this->next_index[$i] = 'n';
                    continue;
                }

                if ($entry->link[0]->attributes()->href) {
                    $video = $entry->link[0]->attributes()->href;
                    $vLink = preg_replace('/=/', "/", $video);
                    $videoLink = preg_replace('/\?/', "/", $vLink);
                    $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                    $test_str = preg_split('/\/v\//', $videoLink, 2);
                    $video_id_array = preg_split('/&/', $test_str[1], 2);
                    $mediaInfo['videoId'] = $video_id_array[0];
                    if (!$mediaInfo['videoId']) {
                        $this->next_index[$i] = 'n';
                        continue;
                    }
                } else {
                    //echo "video Skipped.";
                    $this->next_index[$i] = 'n';
                    continue;
                }
            }

            $this->next_index[$i] = 'y';
            //Check if the video is availalbe to embed. If not then set streaming type to 100
            if ($ytMedia->noembed)
                $mediaInfo['streaming_type'] = 100;
            else
                $mediaInfo['streaming_type'] = '';

            $mediaInfo['path_url'] = $mediaInfo['contentUrl'];

            $mediaInfo['owner'] = sprintf("%s", $entry->author->name);

            $yt = $media->children('http://gdata.youtube.com/schemas/2007');
            if ($yt->duration) {
                $mediaInfo['duration'] = sprintf("%s", $yt->duration->attributes()->seconds);
            } else {
                $mediaInfo['duration'] = '';
            }
            if ($yt->private) {
                $mediaInfo['access'] = 'private';
            } else {
                $mediaInfo['access'] = 'public';
            }
            if ($ytMedia->statistics) {
                $mediaInfo['numberOfViews'] = (int) $ytMedia->statistics->attributes()->viewCount;
            } else {
                $mediaInfo['numberOfViews'] = '';
            }
            $mediaInfo['datePosted'] = sprintf("%s", $entry->published);
            $mediaInfo['author'] = sprintf("%s", $entry->author->name);
            $mediaInfo['dateExpires'] = '';
            $mediaInfo['download'] = '';
            $mediaInfo['streaming'] = '';

            $mediaInfo['author'] = sprintf("%s", $entry->author->name);

            $mediaInfo['webSite'] = $webSite;
            $mediaInfo['dateUpdated'] = sprintf("%s", $entry->updated);
            $mediaInfo['genre'] = sprintf("%s", $media->group->category[0]);
            $mediaInfo['criteria'] = $criteria;


            $res[] = $mediaInfo;
        }
        unset($ytMedia);
        unset($gdMedia);
        unset($media);

        unset($mediaInfo);
        unset($xml);

        return $res;
    }

    public function getShortCount($maxresults = '') {
        $shortCnt = 0;
        foreach (@$this->next_index as $item) {
            if ($item == 'n') {
                $shortCnt++;
            }
        }
        if ($maxresults != '') {
            if ($shortCnt == 0 && $maxresults > count($this->next_index)) {
                $shortCnt = $maxresults - count($this->next_index);
            }
        }
        return $shortCnt;
    }

    public function getShortResult($url, $criteria) {
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token != '' && $developerKey != '')
            $output = $this->make_api_call($url);
        else {
            $response = $this->make_get_call($url);
            $output = $response['output'];
        }
        $result = array();
        $validresult = $this->checkErrors($output);
        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];

            $tmp = $xml->xpath("openSearch:totalResults");
            $tmp_totalresults = (string) $tmp[0];

            $tmp = $xml->xpath("openSearch:startIndex");
            $result['startindex'] = (string) $tmp[0];

            $tmp = $xml->xpath("openSearch:itemsPerPage");
            $result['itemsPerPage'] = (string) $tmp[0];

            if ($tmp_totalresults > $result['startindex']) {
                $res = $this->getFormatedVideoresult($xml, $criteria);
                $result['nextPageIndex'] = $result['startindex'] + count($this->next_index);
            } else
                $result['nextPageIndex'] = 0;
            $result['result'] = $res;
        }
        else {

            $result['error'] = $validresult['error'];
        }
        $result['is_error'] = $validresult['is_error'];
        unset($validresult);
        unset($output);
        unset($response);
        return $result;
    }

    /**
     *  send HTTP POST Request with AuthSub token and API Key 
     *
     *  @param url - String  - Request URL
     *  @param data - String  - data to post
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function make_add_request($url, $data) {

        $token = $this->accessToken;
        $developerKey = $this->developerKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->authType == 'GoogleLogin')
            $curlheader[0] = "Authorization: " . $this->authType . " auth=\"$token\"";
        else
            $curlheader[0] = "Authorization: " . $this->authType . " token=\"$token\"";

        $curlheader[1] = "X-GData-Key: key=\"$developerKey\"";
        $curlheader[2] = "Host: gdata.youtube.com";
        $curlheader[3] = "Content-Type: application/atom+xml";
        $curlheader[4] = "Content-Length: " . strlen($data);
        $curlheader[5] = "GData-Version: 2";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        curl_close($ch);

        $validresult = $this->checkErrors($output);
        if ($validresult['is_error'] == 'No') {
            unset($validresult);
            return "Success";
        } else {
            $result = array();
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
            unset($validresult);
            return $result;
        }
    }

    /**
     *  add video into a playlist for logged in user
     *
     *  @param playlistId - String 
     *  @param videoId - String 
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function addVideoToPlayList($playlistId, $videoId) {
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token == '' || $developerKey == '')
            return "Authorization required";

        $url = 'http://gdata.youtube.com/feeds/api/playlists/' . $playlistId;
        $data = '<?xml version="1.0" encoding="UTF-8"?>
			<entry xmlns="http://www.w3.org/2005/Atom"
			xmlns:yt="http://gdata.youtube.com/schemas/2007">
			<id>' . $videoId . '</id>
			</entry>
			';
        return $this->make_add_request($url, $data);
    }

    /**
     *  send HTTP Delete Request 
     *
     *  @param url - String  
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function make_delete_request($url) {

        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token == '' || $developerKey == '')
            return "Authorization required";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->authType == 'GoogleLogin')
            $curlheader[0] = "Authorization: " . $this->authType . " auth=\"$token\"";
        else
            $curlheader[0] = "Authorization: " . $this->authType . " token=\"$token\"";
        $curlheader[1] = "X-GData-Key: key=\"$developerKey\"";
        $curlheader[2] = "Host: gdata.youtube.com";
        $curlheader[3] = "Content-Type: application/atom+xml";
        $curlheader[4] = "GData-Version: 2";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $output = curl_exec($ch);

        $result['err'] = curl_errno($ch);
        $result['errmsg'] = curl_error($ch);
        $result['header'] = curl_getinfo($ch);

        curl_close($ch);

        $validresult = $this->checkErrors($output);

        if ($validresult['is_error'] == 'No') {
            unset($validresult);
            return "Success";
        } else {
            $result = array();
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
            unset($validresult);
            return $result;
        }
    }

    /**
     *  delete video from playlist for logged in user
     *
     *  @param title - String  
     *  @param description - String  
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function deleteVideoFromPlayList($playlist_id, $playlist_entry_list) {
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token == '' || $developerKey == '')
            return "Authorization required";

        $url = 'http://gdata.youtube.com/feeds/api/playlists/' . $playlist_id . "/" . $playlist_entry_list;

        return $this->make_delete_request($url);
    }

    /**
     *  create playlist for logged in user
     *
     *  @param title - String  
     *  @param description - String  
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function createPlayList($title, $description) {
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token == '' || $developerKey == '')
            return "Authorization required";

        $url = 'http://gdata.youtube.com/feeds/api/users/default/playlists';
        $data = '<?xml version="1.0" encoding="UTF-8"?>
			<entry xmlns="http://www.w3.org/2005/Atom"
			xmlns:yt="http://gdata.youtube.com/schemas/2007">
			<title type="text">' . $title . '</title>
			<summary>' . $description . '</summary>
			</entry>';

        return $this->make_add_request($url, $data);
    }

    /**
     *  delete playlist by playlist id for logged in user
     *
     *  @param username - String  
     *  @param playlist_id - String  
     *  @return string 
     *  @access public
     *  Modified: Sandip
     */
    public function deletePlayList($username = 'default', $playlist_id) {
        $url = 'http://gdata.youtube.com/feeds/api/users/' . $username . "/playlists/" . $playlist_id;
        return $this->make_delete_request($url);
    }

    /**
     *  Upload Videos for logged in user
     *
     *  @param filename - String  
     *  @param fullFilePath - String  (local machine file path)
     *  @param title - String
     *  @param description - String
     *  @return result - array
     *  @access public
     *  Modified: Sandip
     * privacy :    private
                    public
                    unlisted

     */
    public function uploadVideo($filename, $fullFilePath, $title, $description,$privacy="public") {


        $fdata = file_get_contents($fullFilePath);
        $tmpdata = '<?xml version="1.0"?>
	<entry xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:yt="http://gdata.youtube.com/schemas/2007">
	<media:group>
	<media:title type="plain">' . $title . '</media:title>
	<media:description type="plain">' . $description . '</media:description> 
	<media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">People</media:category>    <media:keywords>codnloc</media:keywords>
	 <yt:'.$privacy.'/>
        </media:group>
	</entry> 
	';
        $url = 'http://gdata.youtube.com/feeds/api/users/default/uploads';
        $data = '--f93dcbA3
Content-Type: application/atom+xml; charset=UTF-8

' . $tmpdata . '
--f93dcbA3
Content-Type: video/quicktime
Content-Transfer-Encoding: binary

' . $fdata . '
--f93dcbA3--';

        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlheader[0] = "Host: uploads.gdata.youtube.com";
        if ($this->authType == 'GoogleLogin')
            $curlheader[1] = "Authorization: " . $this->authType . " auth=\"$token\"";
        else
            $curlheader[1] = "Authorization: " . $this->authType . " token=\"$token\"";
        $curlheader[2] = "GData-Version: 2";
        $curlheader[3] = "X-GData-Key: key=\"$developerKey\"";
        $curlheader[4] = "Slug: " . $filename;
        $curlheader[5] = "Content-Type: multipart/related; boundary=\"f93dcbA3\"";
        $curlheader[6] = "Content-Length: " . strlen($data);
        $curlheader[7] = "Connection: close";


        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        //print_r($info);

        curl_close($ch);

        unset($fdata);
        $validresult = $this->checkErrors($output);

        if ($validresult['is_error'] == 'No') {

            $xml = $validresult['xml'];

            $webSite = 'http://www.youtube.com/';
            $criteria = 'uploads';
            $mediaInfo = array();
            $gdMedia = $xml->children('http://schemas.google.com/g/2005');
            $media = $xml->children('http://search.yahoo.com/mrss/');
            $ytMedia = $xml->children('http://gdata.youtube.com/schemas/2007');
            $georssMedia = $xml->children('http://www.georss.org/georss');

            if ($media->group->title) {
                $mediaInfo['title'] = sprintf("%s", $media->group->title[0]);
            } else {
                $mediaInfo['title'] = '';
            }
            if ($media->group->description) {
                $mediaInfo['description'] = sprintf("%s", $media->group->description[0]);
            } else {
                $mediaInfo['description'] = '';
            }
            if ($media->group->player) {

                $video = $media->group->player[0]->attributes()->url;
                $vLink = preg_replace('/=/', "/", $video);
                $videoLink = preg_replace('/\?/', "/", $vLink);
                $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                $test_str = preg_split('/\/v\//', $videoLink, 2);
                $video_id_array = preg_split('/&/', $test_str[1], 2);
                $mediaInfo['videoId'] = $video_id_array[0];
            } else {
                if ($entry->link[0]->attributes()->href) {
                    $video = $entry->link[0]->attributes()->href;
                    $vLink = preg_replace('/=/', "/", $video);
                    $videoLink = preg_replace('/\?/', "/", $vLink);
                    $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                    $test_str = preg_split('/\/v\//', $videoLink, 2);
                    $video_id_array = preg_split('/&/', $test_str[1], 2);
                    $mediaInfo['videoId'] = $video_id_array[0];
                } else {
                    return "video not found.";
                }
            }
            $mediaInfo['path_url'] = $mediaInfo['contentUrl'];
            $mediaInfo['webSite'] = $webSite;
            $mediaInfo['genre'] = sprintf("%s", @$media->group->category[0]);
            $mediaInfo['criteria'] = $criteria;

            unset($xml);
            unset($gdMedia);
            unset($media);
            unset($ytMedia);
            unset($georssMedia);

            return $mediaInfo;
        } else {
            $result = array();
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
            unset($validresult);
            return $result;
        }
    }

    /**
     *  get uploaded Videos for user
     *
     *  @param username - String  (youtube account username for logged in user value should be 'default')
     *  @param startindex - int 
     *  @param limit - int results per page
     * @param location - String
      The location parameter restricts the search to videos that have a geographical location specified in their metadata.The parameter value can specify geographic coordinates (latitude,longitude) that identify a particular location.e.g. location=37.42307,-122.08427
     * @param location_radius - String 
      The location-radius parameter value must be a floating point number followed by a measurement unit. Valid measurement units are m, km, ft and mi. For example, valid parameter values include "1500m", "5km", "10000ft" and "0.75mi". The API will return an error if the radius is greater than 1000 kilometers.

     * @param safeSearch - String
      none  	- YouTube will not perform any filtering on the search result set.
      moderate 	- YouTube will filter some content from search results and, at the least, will filter              content that is restricted in your locale. Based on their content, search results                could be removed from search results or demoted in search results. Note: The default             value for the safeSearch parameter is moderate.
      strict 	- YouTube will try to exclude all restricted content from the search result set. Based             on their content, search results could be removed from search results or demoted in              search results.

     * @param strict - String default value 'true'
      The strict parameter can be used to instruct YouTube to reject an API request if the request contains invalid request parameters. The default API behavior is to ignore invalid request parameters. If you want YouTube to reject API requests that contain invalid parameters, set the strict parameter value to true.

     *  @return result - array
     *  @access public
     *  Modified: Sandip
     */
    public function getUploadedVideos($username = 'default', $startIndex = 1, $limit = 10, $location = '', $location_radius = '', $safeSearch = 'strict', $strict = 'true') {



        $url = 'http://gdata.youtube.com/feeds/api/users/' . $username . '/uploads?start-index=' . $startIndex . '&max-results=' . $limit . '&strict=' . $strict;
        if ($location != '') {
            $url .= '&location=' . $location;
            $url .= '&location-radius=' . $location_radius;
        }
        //echo "<br>".$url;
        $criteria = 'uploads';
        if ($username == 'default')
            $output = $this->make_api_call($url);
        else {
            $response = $this->make_get_call($url);
            $output = $response['output'];
        }

        $result = array();

        $validresult = $this->checkErrors($output);

        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];

            $tmp = $xml->xpath("openSearch:totalResults");
            $tmp_totalresults = (string) $tmp[0];

            $tmp = $xml->xpath("openSearch:startIndex");
            $result['startindex'] = (string) $tmp[0];

            //$tmp = $xml->xpath("openSearch:itemsPerPage");
            //$result['itemsPerPage'] = (string)$tmp[0];

            $res = $this->getFormatedVideoresult($xml, $criteria);

            //Pagination logic
            $shortCnt = $this->getShortCount();
            //


            if ($shortCnt > 0 && $tmp_totalresults > $limit) {
                $newStartIndex = $startIndex + $limit;
                $newmaxresults = $shortCnt;

                $iteration = 1;
                while ($shortCnt > 0 && $tmp_totalresults >= $newStartIndex) {
                    if ($iteration != 1) {
                        $newStartIndex = $newStartIndex + $newmaxresults;
                        $newmaxresults = $shortCnt;
                    }
                    $iteration++;

                    $url = 'http://gdata.youtube.com/feeds/api/users/' . $username . '/uploads?start-index=' . $newStartIndex . '&max-results=' . $newmaxresults . '&strict=' . $strict;
                    if ($location != '') {
                        $url .= '&location=' . $location;
                        $url .= '&location-radius=' . $location_radius;
                    }

                    $shortResult = $this->getShortResult($url, $criteria);

                    if (@$shortResult['is_error'] == 'No') {
                        if (!empty($shortResult['result'])) {
                            ////echo "<br>INSIDE";	
                            foreach ($shortResult['result'] as $shortkey => $shortItem)
                                $res[] = $shortItem;
                            $shortCnt = $this->getShortCount();
                        } else {
                            continue;
                        }
                    } else {
                        break;
                    }
                }//while

                $result['nextPageIndex'] = @(isset($shortResult['nextPageIndex']) ? $shortResult['nextPageIndex'] : 0);
            } else {
                $result['nextPageIndex'] = $result['startindex'] + count($this->next_index);
            }
            if ($tmp_totalresults < $result['nextPageIndex']) {
                $result['nextPageIndex'] = 0;
            }


            //pagination logic


            $result['itemsPerPage'] = $limit;
            $result['totalresults'] = count($res);

            $result['result'] = $res;

            unset($res);
            unset($xml);
        } else {
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
        }
        unset($validresult);

        return $result;
    }

    /**
     *  validate Response recived from HTTP requests
     *
     * @return array
     *  @access public
     *  Modified: Sandip
     */
    public function checkErrors($response) {

        $result = array();
        $result['is_error'] = 'No';
        $reg_ex = '/<H1>Bad Request<\/H1>/';
        $res = preg_match_all($reg_ex, $response, $matches);

        if (!empty($matches[0])) {
            $result['is_error'] = 'Yes';
            $result['error'] = "Bad Request";
        } else {

            $xml = @simplexml_load_string($response);
            if ($xml === FALSE && $response != '') {
                $result['error'] = $response;
                $result['is_error'] = 'Yes';
            } else {

                if (@$xml->error) {

                    $msg = @(string) $xml->error->code . ':' . @(string) $xml->error->internalReason;
                    unset($xml);
                    $result['error'] = $msg;
                    $result['is_error'] = 'Yes';
                } else {
                    $result['xml'] = $xml;
                }
            }
        }
        unset($xml);
        unset($response);
        return $result;
    }

    /**
     *  get content URL for the subscription
     *  @param url - String 
     *  @return array
     *  @access public
     *  Modified: Sandip
     */
    public function getContentURL($url) {
        $output = $this->make_api_call($url);
        $result = array();
        $validresult = $this->checkErrors($output);
        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];
            $ytMedia = $xml->children('http://gdata.youtube.com/schemas/2007');
            $result['term'] = $xml->category[1]->attributes()->term;
            $result['title'] = (string) $xml->title;
            $result['username'] = (string) $ytMedia->username;
            $result['contentURL'] = (string) $xml->content->attributes()->src;
            if (stristr($result['title'], 'Activity of')) {
                $result['contentURL'] = 'http://gdata.youtube.com/feeds/api/users/' . $result['username'] . '/uploads?v=2';
            }
        } else {
            $result['is_error'] = $validresult['is_error'];
            $result['error'] = $validresult['error'];
        }
        unset($validresult);
        return $result;
    }

    /**
     *  get recent uploaded videos for the subscribed user
     *  @param xml - Object 
     *  @return array
     *  @access public
     *  Modified: Sandip
     */
    public function getRecentUploadedVideos($xml) {
        $i = 0;
        $res = array();
        foreach ($xml->entry as $fentry) {
            $i++;
            $term = $fentry->category[1]->attributes()->term;
            if ($term == 'video_uploaded') {
                $mediaInfo = array();
                $entry = $fentry->link[1]->entry;
                $gdMedia = $entry->children('http://schemas.google.com/g/2005');
                $media = $entry->children('http://search.yahoo.com/mrss/');
                $ytMedia = $entry->children('http://gdata.youtube.com/schemas/2007');
                $georssMedia = $entry->children('http://www.georss.org/georss');
                if ($gdMedia->rating) {
                    $rating = (string) $gdMedia->rating->attributes();
                    $mediaInfo['rating'] = $rating['average'];
                } else {
                    $mediaInfo['rating'] = 0;
                }
                if ($media->group->thumbnail) {
                    $mediaInfo['iconImage'] = sprintf("%s", $media->group->thumbnail[0]->attributes()->url);
                } else {
                    $mediaInfo['iconImage'] = '';
                }
                if ($media->group->title) {
                    $mediaInfo['title'] = sprintf("%s", $media->group->title[0]);
                } else {
                    $mediaInfo['title'] = '';
                }
                if ($media->group->description) {
                    $mediaInfo['description'] = sprintf("%s", $media->group->description[0]);
                } else {
                    $mediaInfo['description'] = '';
                }
                if ($media->group->player) {
                    $video = $media->group->player[0]->attributes()->url;
                    $vLink = preg_replace('/=/', "/", $video);
                    $videoLink = preg_replace('/\?/', "/", $vLink);
                    $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                    $test_str = preg_split('/\/v\//', $videoLink, 2);
                    $video_id_array = preg_split('/&/', @$test_str[1], 2);
                    $mediaInfo['videoId'] = $video_id_array[0];
                } else {
                    $tmp = @$entry->xpath("app:control");
                    $tmp2 = @$tmp[0]->xpath("yt:state");

                    if (@$tmp2[0]->attributes()->name == 'restricted') {
                        //echo "<br>INSIDE ".$mediaInfo['title'];
                        $this->next_index[$i] = 'n';
                        continue;
                    }
                    if (isset($entry->link) && $entry->link[0]->attributes()->href != '') {
                        $video = $entry->link[0]->attributes()->href;
                        $vLink = preg_replace('/=/', "/", $video);
                        $videoLink = preg_replace('/\?/', "/", $vLink);
                        $mediaInfo['contentUrl'] = $videoLink . "&hl=en&fs=1";
                        $test_str = preg_split('/\/v\//', $videoLink, 2);
                        $video_id_array = preg_split('/&/', $test_str[1], 2);
                        $mediaInfo['videoId'] = $video_id_array[0];
                        if (!$mediaInfo['videoId']) {
                            $this->next_index[$i] = 'n';
                            //echo "video Skipped.";
                            continue;
                        }
                    } else {

                        $this->next_index[$i] = 'n';
                        continue;
                    }
                }
                $this->next_index[$i] = 'y';
                $res[] = $mediaInfo;
            } else {
                $this->next_index[$i] = 'n';
            }
        } // foreach
        return $res;
    }

    /**
     *  get results from the url
     *  @param url - String 
     *  @return array
     *  @access public
     *  Modified: Sandip
     */
    public function getRecentShortResult($url) {
        $token = $this->accessToken;
        $developerKey = $this->developerKey;
        if ($token != '' && $developerKey != '')
            $output = $this->make_api_call($url);
        else {
            $response = $this->make_get_call($url);
            $output = $response['output'];
        }
        $result = array();
        $validresult = $this->checkErrors($output);
        if ($validresult['is_error'] == 'No') {
            $xml = $validresult['xml'];
            $tmp = $xml->xpath("openSearch:totalResults");
            $tmp_totalresults = (string) $tmp[0];
            $tmp = $xml->xpath("openSearch:startIndex");
            $result['startindex'] = (string) $tmp[0];
            $tmp = $xml->xpath("openSearch:itemsPerPage");
            $result['itemsPerPage'] = (string) $tmp[0];
            //$result['itemsPerPage'] = $maxresults;
            if ($tmp_totalresults > $result['startindex']) {
                $res = $this->getRecentUploadedVideos($xml);
                $result['nextPageIndex'] = $result['startindex'] + count($this->next_index);
            } else
                $result['nextPageIndex'] = 0;
            $result['result'] = @$res;
        }
        else {
            $result['error'] = $validresult['error'];
        }
        $result['is_error'] = $validresult['is_error'];
        unset($validresult);
        unset($output);
        unset($response);
        return $result;
    }

    /**
     *  get direct videos entries for the Subscription
     *  @param subscriptionID - String subscriptionID
     *  @param startindex - int start number
     *  @param limit - int Search Result Per Page 
     *  @param safeSearch = String
     *  @param strict = strict {true / false}
     *  @return array
     *  @access public
     *  Modified: Sandip
     */
    public function getVideosBysubscriptionID($subscriptionID, $startIndex = 1, $limit = 10, $safeSearch = 'strict', $strict = 'true') {
        $url = 'http://gdata.youtube.com/feeds/api/users/default/subscriptions/' . $subscriptionID . '?v=2';
        $feedResponse = $this->getContentURL($url);
        $contentURL = @$feedResponse['contentURL'];
        $tempcontentURL = $contentURL;
        $contentURL .= '&start-index=' . $startIndex . '&max-results=' . $limit . '&strict=' . $strict;
        $result = array();
        if ($contentURL != '') {
            $output = $this->make_api_call($contentURL);
            $validresult = $this->checkErrors($output);
            if ($validresult['is_error'] == 'No') {
                $xml = $validresult['xml'];
                $tmp = $xml->xpath("openSearch:totalResults");
                $tmp_totalresults = (string) $tmp[0];
                $tmp = $xml->xpath("openSearch:startIndex");
                $result['startindex'] = (string) $tmp[0];
                if (@$feedResponse['recentUpload'] == 1) {
                    $res = $this->getRecentUploadedVideos($validresult['xml']);

                    $shortCnt = $this->getShortCount();
                    if ($shortCnt > 0 && $tmp_totalresults > $limit) {
                        $newStartIndex = $startIndex + $limit;
                        $newmaxresults = $shortCnt;
                        $iteration = 1;
                        while ($shortCnt > 0 && $tmp_totalresults >= $newStartIndex) {
                            if ($iteration != 1) {
                                $newStartIndex = $newStartIndex + $newmaxresults;
                                $newmaxresults = $shortCnt;
                            }
                            $iteration++;
                            $url = $tempcontentURL . '&start-index=' . $newStartIndex . '&max-results=' . $newmaxresults . '&strict=' . $strict;
                            $shortResult = $this->getRecentShortResult($url);
                            if (@$shortResult['is_error'] == 'No') {
                                if (!empty($shortResult['result']) && count($res) <= $limit) {
                                    foreach ($shortResult['result'] as $shortkey => $shortItem)
                                        $res[] = $shortItem;
                                    $shortCnt = $this->getShortCount();
                                } else {
                                    continue;
                                }
                            } else {
                                break;
                            }
                        }//WHILE
                        $result['nextPageIndex'] = @(isset($shortResult['nextPageIndex']) ? $shortResult['nextPageIndex'] : 0);
                    } else {
                        $result['nextPageIndex'] = @$result['startindex'] + count($this->next_index);
                    }
                    if ($tmp_totalresults < $result['nextPageIndex']) {
                        $result['nextPageIndex'] = 0;
                    }
                    $result['itemsPerPage'] = $limit;
                    $result['totalresults'] = count($res);
                    $result['result'] = $res;
                    unset($res);
                    unset($xml);
                } else {
                    $criteria = $feedResponse['title'];

                    $xml = $validresult['xml'];
                    $res = $this->getFormatedVideoresult($xml, $criteria);
                    //Pagination logic
                    $shortCnt = $this->getShortCount();
                    if ($shortCnt > 0 && $tmp_totalresults > $limit) {
                        $newStartIndex = $startIndex + $limit;
                        $newmaxresults = $shortCnt;
                        $iteration = 1;
                        while ($shortCnt > 0 && $tmp_totalresults >= $newStartIndex) {
                            if ($iteration != 1) {
                                $newStartIndex = $newStartIndex + $newmaxresults;
                                $newmaxresults = $shortCnt;
                            }
                            $iteration++;
                            $url = $tempcontentURL . '&start-index=' . $newStartIndex . '&max-results=' . $newmaxresults . '&strict=' . $strict;
                            $shortResult = $this->getShortResult($url, $criteria);
                            if (@$shortResult['is_error'] == 'No') {
                                if (!empty($shortResult['result'])) {

                                    foreach ($shortResult['result'] as $shortkey => $shortItem)
                                        $res[] = $shortItem;
                                    $shortCnt = $this->getShortCount();
                                } else {
                                    continue;
                                }
                            } else {
                                break;
                            }
                        }//while
                        $result['nextPageIndex'] = @(isset($shortResult['nextPageIndex']) ? $shortResult['nextPageIndex'] : 0);
                    } else {
                        $result['nextPageIndex'] = $result['startindex'] + count($this->next_index);
                    }
                    if ($tmp_totalresults < $result['nextPageIndex']) {
                        $result['nextPageIndex'] = 0;
                    }
                    //pagination logic
                    $result['itemsPerPage'] = $limit;
                    $result['totalresults'] = count($res);
                    $result['result'] = $res;
                    unset($res);
                    unset($xml);
                }
            }// NO
            else {
                $result['is_error'] = $validresult['is_error'];
                $result['error'] = $validresult['error'];
            }
        } else {
            $result['is_error'] = $feedResponse['is_error'];
            $result['error'] = $feedResponse['error'];
        }
        unset($validresult);
        unset($feedResponse);
        return $result;
    }

}
?>