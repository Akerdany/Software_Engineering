<?php
    require_once("connection.php");
    class CourtModel {
        public $id;
        public $courtNumber;
        public $pricePerHour;
        public $specs;
        public $sports;
        public static function getAllCourts(){
            $DB = new DBConnection();
            $sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId
            WHERE court.isDeleted = "0"';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            $courtObjects;
            $i = 0;
            while($row = mysqli_fetch_array($result))
            {
                $courtObjects[$i]= $row;
                $i++;
            }
            return $courtObjects;
        }
        public static function getAllSports()
        {
            $DB = new DBConnection();
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
        public static function deleteCourt($id)
        {
            $DB = new DbConnection();
            $sql = 'UPDATE court SET isDeleted = "1" WHERE id = "'.$id.'"';
            mysqli_query($DB->getdbconnect(), $sql);
        }
        public static function getCourtSpecs()
        {
            $DB = new DBConnection();
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
        public static function addCourt($court){
            $DB = new DbConnection();
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
            mysqli_close($DB->getdbconnect());
        }

        public static function editCourt($court){
            $DB = new DbConnection();
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
        public static function getCourtDetails($id)
        {
            $DB = new DbConnection();
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