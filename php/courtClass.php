<?php
    require_once("connection.php");
//COURT CLASS START
    class Court {
        public $id;
        public $courtNumber;
        public $pricePerHour;
        public $sportid;
        public $specsid;
        public static function displayCourts(){
            $DB = new DBConnection();
            $sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId';
            $result = mysqli_query($DB->getdbconnect(), $sql);
            echo '<table class = "displaytables">';
            echo '<tr>'
                .'<th>Sport</th>'
                .'<th>Court No.</th>'
                .'<th>Hourly Price</th>'
                .'<th>Court Specs</th>'
                .'<th>Edit Court</th>'
                .'</tr>';
            while($row = mysqli_fetch_array($result))
            {
                echo '<tr>'
                    .'<td>'.$row['name'].'</td>'
                    .'<td>'.$row['courtNumber'].'</td>'
                    .'<td>'.$row['price'].'</td>'
                    .'<td>'.$row['specs'].'</td>'
                    .'<td> <form action = "editCourt.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$row['id'].'">Edit</button>'
                    .'</form>'
                    .'</tr>';
            }
            echo '</table>';
            echo '<a href= "addCourt.php" class="button">Add Court</a><br><br>';
            echo '<a href= "deleteCourt.php" class="button">Delete Court</a>';
        }

        public static function addCourt($court){
            $DB = new DbConnection();
            $sql = 'INSERT INTO court (courtNumber, sportId, price) VALUES ( "'.$court->courtNumber.'","'.$court->sportid.'","'.$court->pricePerHour.'")';
            mysqli_query($DB->getdbconnect(), $sql);
            $lastIdSQL = 'SELECT MAX(id) from court';
            $lastIdResult = mysqli_query($DB->getdbconnect(), $lastIdSQL);
            while($lastIdRow = mysqli_fetch_array($lastIdResult))
            {
                $court->id = $lastIdRow['MAX(id)'];
            }

            $ccdSQL = 'INSERT INTO ccd (courtId, courtDetailsId) VALUES ("'.$court->id.'","'.$court->specsid.'")';
            mysqli_query($DB->getdbconnect(), $ccdSQL);
            header('Location: displayCourts.php');
            mysqli_close($DB->getdbconnect());
        }


        public static function deleteCourt($id){
            $DB = new DbConnection();
            $sql = 'DELETE FROM court WHERE id = "'.$id.'"';
            $sql2 = 'DELETE FROM ccd WHERE courtId = "'.$id.'"';
            mysqli_query($DB->getdbconnect(), $sql2);
            mysqli_query($DB->getdbconnect(), $sql);
            header('Location: displayCourts.php');
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
            header('Location: displayCourts.php');
            mysqli_close($DB->getdbconnect());
        }
    }
    // COURT CLASS END
?>