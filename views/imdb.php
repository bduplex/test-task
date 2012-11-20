<?php

class imdb extends base{

    /**
     * Parses IMD page from given url.
     * @param String url The URL to parse
     * @return parsed data
     */

    public function startParcing( $url = null ) {
        if (!$url )
            throw new Exception('There was no URL given');
        try {

            libxml_use_internal_errors(TRUE);
            $dom = new DOMDocument;
            $dom->loadHTMLFile($url);
            libxml_clear_errors();
            // use XPath to find all nodes with a class attribute of header
            $xp = new DOMXpath($dom);
            $query = '//table/tr';
            $elements = $xp->query($query);

        } catch (Exception $e) {
            throw $e;
        }
        if (is_null($elements)) {
            throw new Exception('Nothing was parsed from '. $url);
        } else {
            $i = 0;
            $data = array();
            foreach ($elements as $element) {
                if($i>10) break; // we need plain 10 records
                if($i>0) {

                    $nodes = $element->childNodes;

                    $j = 0;
                    $list = array();
                    foreach ($nodes as $node) {
                        switch($j) {
                            case 0:	// rank
                                $list['rank'] = str_replace(".","",$node->nodeValue);
                                break;
                            case 1:	// rating
                                $list['rating'] = $node->nodeValue;
                                break;
                            case 2:	// title + year
                                $pieces = explode("(", $node->nodeValue);
                                $list['title'] = $pieces[0];
                                $list['year'] = str_replace(")","",$pieces[1]);
                                break;
                            case 3:	// votes
                                $list['votes'] = $node->nodeValue;
                                break;
                        }
                        $j++;
                    }
                    $data[] = $list;
                }
                $i++;
            }
        }
        return $data;
    }

    /**
     * Storing parsed data, if it is not empty.
     * @param parsed data of IMDB movies
     */
    private function updateArchiveData($data = null)
    {
        if (!$data ){
            throw new Exception('There is nothing to write to database');
        }
        $this->dbConnect();

        foreach ( $data as $item ){
            $votes = str_replace(",","",$item[votes]);
            $date = date('Y-m-d');
            $unixdate = strtotime($date);
            mysql_query("INSERT INTO imdb_archive VALUES (DEFAULT, '$item[title]', '$item[year]', '$item[rank]', '$item[rating]', '$votes', '$unixdate')");
        }
        return 'Done!';
    }

    /**
     * Main function for the IMDB top movies list update to database
     * @param string $url
     */

    public function updateArchive($url = null)
    {
        $errors = array();
        $messages = array();
        $data = array();

        $this->prepareUpdateForToday();

        try {
            $messages[] = "Parsing given url: " . $url . ".";
            $data = $this->startParcing($url);
            $messages[] = "Parsed data is going to be updated in the database";
            $messages[] = $this->updateArchiveData($data);
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        $this->render('update', compact('errors', 'messages'));
    }

    /**
     * Function to show collected archive by given date
     * @param $date unix date stamp
     */

    public function showArchiveByDate($date = null)
    {

        $errors = array();
        $messages = array();
        $data = array();

        $result = $this->dbQuery("
                  SELECT *
                  FROM imdb_archive
                  WHERE datestamp = $date
                  ORDER BY rank asc
                  ");

        while($row = mysql_fetch_array($result))
           $data[] = $row;

        $this->render('show-archive', compact('errors', 'messages', 'data'));
    }

    /**
     * Function to show collected archive by given date for AJAX request
     * @param $date unix date stamp
     */
    public function showArchiveByDate_ajax($date)
    {
        $errors = array();
        $messages = array();
        $data = array();

        $result = $this->dbQuery("
                  SELECT *
                  FROM imdb_archive
                  WHERE datestamp = $date
                  ORDER BY rank asc
                  ");

        while($row = mysql_fetch_array($result))
           $data[] = $row;

        $this->render('show-archive-plain', compact('errors', 'messages', 'data'));
    }
}