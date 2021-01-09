<?php
    class VendorModel extends BaseModel
    {
        public static function listVendors()
        {
            $st = self::$pdo->prepare("select * from vendors");
            $st->execute();
            $vendors = $st->fetchall();
            return $vendors;
        }

        public static function checkVendor($vendor_name)
        {
            $st = self::$pdo->prepare("select * from vendors where vendor_name:vendor");
            $st->bindParam(":vendor",$vendor_name);
            $st->execute();
            $vendors = $st->fetchall();
            if($vendors)
            {
                return 0;
            }
            else
            {
                return 1;
            }
        }

        public static function vendorLogin($vendor_name,$password)
        {
            $st = self::$pdo->prepare("select * from vendors where vendor_name=:vendor and password=:pass");
            $st->bindParam(":vendor",$vendor_name);
            $st->bindParam(":pass",$password);
            $st->execute();
            $vendor_Detail = $st->fetch();
            if($vendor_Detail){
                 return $vendor_Detail;
            }
           
        }

        public static function addVendor($data)
        {
            $st = self::$pdo->prepare("insert into vendors (vendor_name,email,phone_number,status,password,address) values(:vendor_name,:email,:number,1,:password,:address)");
           
           $st->bindParam(":vendor_name",$data['vendor_name']);
           $st->bindParam(":email",$data['email']);
           $st->bindParam(":number",$data['phone_number']);
           $st->bindParam(":password",$data['password']);
           $st->bindParam(":address",$data['address']);
           $st->execute();
           return 1;
        }

        public static function addVendorAvatar($data){
            $vendor_id = VendorModel::GetId();
            $_SESSION['vendor_id']=$vendor_id['vendor_id'];
            $vid = $_SESSION['vendor_id'];
            $avatarId = $data['vendor_avatar_id'];  
            $st2 = self::$pdo->prepare("insert into vendor_avatars values($vid, $avatarId)");
            $st2->execute();
        }

        public static function GetId()
        {
            $st = self::$pdo->prepare("select vendor_id from vendors where vendor_name= :vendor_name");
            $st->bindParam(":vendor_name",$_SESSION["logged_vendor"]);
            $st->execute();
            $vendor_id = $st->fetch();
            return $vendor_id;
        }

        public static function getVendorData()
        {
            $st = self::$pdo->prepare("select vendor_name,email,phone_number,address from vendors where vendor_name =:vendorname");
            $st->bindParam(":vendorname",$_SESSION['logged_vendor']);
            $st->execute();
            $detail = $st->fetch();
            return $detail;
        }

        public static function getVendorAvatar()
        {
            $vendorname = $_SESSION['logged_vendor'];
                $st_uid = self::$pdo->prepare("select vendor_id from vendors where vendor_name = :vendorname");
                $st_uid->bindParam(':vendorname',$vendorname);
                $st_uid->execute();
                $vendorId = $st_uid->fetch();
                $_SESSION['vendor_id']=$vendorId['vendor_id'];
            $avatarStatement = self::$pdo->prepare("SELECT * FROM vendor_avatars INNER JOIN avatars ON vendor_avatars.avatar_id = avatars.avatar_id AND vendor_avatars.vendor_id = :vendorId");
            $avatarStatement->bindParam(':vendorId',$_SESSION['vendor_id']);
            $avatarStatement->execute();
            $avatars = $avatarStatement->fetchall();
            return $avatars;
        }

        public static function updateVendor($data)
        {
            $st = self::$pdo->prepare("update vendors set email =:email,phone_number =:number,address =:address where vendor_name =:vendor_name");
            $st->bindParam(":vendor_name",$_SESSION['logged_vendor']);
            $st->bindParam(":email",$data['email']);
            $st->bindParam(":number",$data['phone_number']);
            $st->bindParam(":address",$data['address']);
            $st->execute();
            header("Location: http://localhost/project5/TechMart/vendorProfile", TRUE, 301);
            exit();
        }

        public static function updateVendorAvatar($avatar_id){
            $vendorname = $_SESSION['logged_vendor'];
                $st_uid = self::$pdo->prepare("select vendor_id from vendors where vendor_name = :vendorname");
                $st_uid->bindParam(':vendorname',$vendorname);
                $st_uid->execute();
                $vendorId = $st_uid->fetch();
                $_SESSION['vendor_id']=$vendorId['vendor_id'];
            $st = self::$pdo->prepare("update vendor_avatars set avatar_id = :avatar_id where vendor_id = :vendor_id");
            $st->bindParam(':avatar_id',$avatar_id);
            $st->bindParam(':vendor_id',$_SESSION['vendor_id']);
            $st->execute();
        }
    }   
?>