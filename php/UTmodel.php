<?php
    require_once("connection.php");
    class UTModel {
        $DB = DbConnection::getInstance();
        public static function displayUT(){
            $conn=$this->DB->getdbconnect();
            $Q = "SELECT usertype.userTypeName,features.feature FROM usertype , features , previliges WHERE previliges.userTypeId=usertype.id AND previliges.featureId = features.id ORDER BY `usertype`.`userTypeName` ASC ";
            $result = mysqli_query( $conn, $Q);
            $array=array();
            $minia=array();
            $last="";
            $f=0;
            while($row = mysqli_fetch_array($result))
            {
                if($last ==""||$last==$row['userTypeName'])
                {
                    if($f==0){
                        array_push($minia,$row['userTypeName']);
                        $f=1;
                    }
                    array_push($minia,$row['feature']);
                }else
                {
                    array_push($array,$minia);
                    $f=0;
                    
                }
                
            }
            return $array;
        }
    
    }
?>