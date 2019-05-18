<?php
    require_once("connection.php");
    require_once('Icrud.php');
    class CourtModel implements Icrud {
        public $id;
        public $courtNumber;
        public $pricePerHour;
        public $specs;
        public $sports;
        public static function display($this_page_first_result, $results_per_page){
            $DB = DbConnection::getInstance();
            $sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId
            WHERE court.isDeleted = "0"
            LIMIT '. $this_page_first_result . ',' . $results_per_page;
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $courtObjects;
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $courtObjects[$i]= $row;
                $i++;
            }
            if(empty($courtObjects))
            {
                return 0;
            }
            return $courtObjects;
        }
        public static function getAllSports()
        {
            $DB = DbConnection::getInstance();
            $sql = 'SELECT * from sports';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $sports;
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $sports[$i] = $row;
                $i++;
            }
            return $sports;
        }

        public static function getNumberOfResults()
        {
            $DB = DbConnection::getInstance();
            $sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId
            WHERE court.isDeleted = "0"';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $number_of_results = mysqli_num_rows($result);
            return $number_of_results;
        }

        public static function delete($id)
        {
            $DB = DbConnection::getInstance();
            $sql = 'UPDATE court SET isDeleted = "1" WHERE id = "'.$id.'"';
            mysqli_query($DB->getdbconnect(), $sql);
        }
        public static function getCourtSpecs()
        {
            $DB = DbConnection::getInstance();
            $sql = 'SELECT * from courtdetails';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $specs;
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $specs[$i] = $row;
                $i++;
            }
            return $specs;
        }
        public static function add($court){
            $DB = DbConnection::getInstance();

            $validateSQL = 'SELECT * from court WHERE courtNumber = "'.$court->courtNumber.'" AND sportId = "'.$court->sportid.'" AND isDeleted = "0"';
            $validateResult = mysqli_query($DB->getdbconnect(), $validateSQL);
            if(mysqli_num_rows($validateResult) != 0)
            {
                echo '<meta http-equiv="refresh" content="0">';
                echo '<script>alert("A court with the same number exists");</script>';
            }
            else {
                $sql = 'INSERT INTO court (courtNumber, sportId, price, isDeleted) VALUES ( "'.$court->courtNumber.'","'.$court->sportid.'","'.$court->pricePerHour.'", 0)';
                mysqli_query($DB->getdbconnect(), $sql);
                $lastIdSQL = 'SELECT MAX(id) from court';
                $lastIdResult = mysqli_query($DB->getdbconnect(), $lastIdSQL);
                while($lastIdRow = mysqli_fetch_array($lastIdResult))
                {
                    $court->id = $lastIdRow['MAX(id)'];
                }

                $ccdSQL = 'INSERT INTO ccd (courtId, courtDetailsId) VALUES ("'.$court->id.'","'.$court->specsid.'")';
                mysqli_query($DB->getdbconnect(), $ccdSQL);
            }
            //mysqli_close($DB->getdbconnect());
        }

        public static function edit($court){
            $DB = DbConnection::getInstance();
            $validateSQL = 'SELECT * from court WHERE courtNumber = "'.$court->courtNumber.'" AND sportId = "'.$court->sportid.'" AND isDeleted = "0"';
            $validateResult = mysqli_query($DB->getdbconnect(), $validateSQL);
            if(mysqli_num_rows($validateResult) != 0)
            {
                echo '<meta http-equiv="refresh" content="0">';
                echo '<script>alert("A court with the same number exists");</script>';
            }
            else{
                $sql = 'UPDATE court 
                        SET courtNumber = "'.$court->courtNumber.'", 
                        sportId = "'.$court->sportid.'",
                        price = "'.$court->pricePerHour.'"
                        WHERE id = "'.$court->id.'"';
                $ccdSQL = 'UPDATE ccd
                        SET courtDetailsId = "'.$court->specsid.'"
                        WHERE courtId = "'.$court->id.'"';

                mysqli_query($DB->getdbconnect(), $ccdSQL);
                mysqli_query($DB->getdbconnect(), $sql);
                mysqli_close($DB->getdbconnect());
            }
        }
        public static function getCourtDetails($id)
        {
            $DB = DbConnection::getInstance();
            $sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId
            WHERE court.id = "'.$id.'"';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $r = mysqli_fetch_array($result);
            $court = new CourtModel();
            $court->sports = $r['name'];
            $court->courtNumber = $r['courtNumber'];
            $court->pricePerHour = $r['price'];
            $court->specs = $r['specs'];
            $court->id = $id;
            return $court;
        }
    }
?>