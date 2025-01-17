<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="./views/public/css/style.css">
    <?php include 'partials/Elinks.php'; ?>
    <style>
        #profileImg:hover{
            opacity: 80%;
        }

        .modal{
            max-height:500px !important;
        }

        .avatarBtn{
            border:none;
            background: none;
            padding:0;
        }

        .avatarBtn:focus{
            background-color: white;
            outline: none;
        }
    </style>
</head>
<body class="grey lighten-4">
    <!-- navbar for the cart -->
    <nav class="nav-wrapper grey darken-4">
            <!-- logo -->
            <a href="/project5/TechMart" class="brand-logo hide-on-med-and-down"><img src="./views/public/img/logo-techmart.png" alt="logo" class="responsive-img logo"></a>
            <div class="container">         
                <ul class="right">
                    <!-- logo for mobile -->
                    <li>
                        <a href="/project5/TechMart" class="brand-logo left hide-on-large-only"><img src="./views/public/img/logo-techmart.png" alt="logo" class="responsive-img" style="height:50px;width:150px;"></a>
                    </li>
                    <!-- searchbar -->
                    <li class="search-icon" id="search-icon">
                        <nav class="z-depth-0 grey transparent">
                            <div class="nav-wrapper">
                                <form action="/project5/TechMart/list_products" method="get">
                                <input type="hidden" name="categories" value="0">
                                <input type="hidden" name="min_price" value="0" id="">
                                <input type="hidden" name="max_price" value="4000000" id="">
                                    <div class="input-field " id="searchbar">
                                        <input class="white-text transparent" id="search" name="searchKeyword" autocomplete="off" type="search" placeholder="Search" required>
                                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                    </div>
                                </form>
                            </div>
                        </nav>
                    </li>
                </ul>
            </div>
        </nav>
        <form action="" method="post">
            <div class="row teal darken-4 z-depth-4">
                <div class="col s12 m12 l12">
                    <p class="grey-text text-lighten-2 right"><b>Edit Your Profile</b><i class="material-icons left">edit</i></p>
                </div>
                <div class="col s12 m12 l12 center">
                        <a href="#" data-target="avatarWindow" class="modal-trigger"><img src="./views/public/img/avatars/<?php echo ($avatars[0]['avatar_image']); ?>" alt="" class="responsive-img circle" id="profileImg" style="margin-left:20px;width:100px;height:100px;"><i class="tiny material-icons grey-text text-lighten-2">edit</i></a>
                </div>
                <div class="col s12 m12 l12 center">
                    <h4 class="white-text"><?php echo ucfirst($user['username']); ?></h4>
                </div>
            </div>
            <div class="row container" style="padding-top: 1vw;
                padding-bottom: 1vw;">
                <div class="col s12 m6 l3">
                    <input id="first_name" type="text" name="first_name" value= "<?php echo $user['first_name'] ?>">
                    <label for="first_name">First Name</label>
                </div>
                <div class="col s12 m6 l3 offset-l2">
                    <input id="last_name" type="text" name="last_name" value= "<?php echo $user['last_name'] ?>">
                    <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="row container">
                <div class="col s12 m6 l3">
                    <input id="phone_number" type="text" name="phone_number" value="<?php echo $user['phone_number'];?>">
                    <label for="phone_number">Phone Number</label>
                </div>
                <div class="col s12 m6 l3 offset-l2">
                    <input id="email" type="text" name="email" value= "<?php echo $user['email'];?>">
                    <label for="email">Email Address</label>
                </div>
            </div>
            <div class="row container">
                <div class="col s12 m6 l5">
                    <input id="address" type="text" name="address" value= "<?php echo $user['address']?>">
                    <label for="address">Address</label>
                </div>
                <div class="col s12 m6 l3" style="padding-top: 1vw;">
                    <input type="submit" class="btn teal darken-4" onclick="M.toast({html: 'Updated Successfully'})" name="updateUser" value="Update">
                </div>
            </div>
        </form>
        <div class="footer-copyright" style="margin-top:50px;margin-bottom:5px;">
            <div class="container center-align">&copy; 2020 TechMart</div>
        </div>

        <!-- avatar selection window -->
        <form action="" method="post" id="thisform">
            <div id="avatarWindow" class="modal bottom-sheet">
                <div class="modal-content">
                    <?php 
                        foreach($avatarSets as $myAvatars){ ?>
                            <input type="hidden" value="<?php echo $myAvatars['avatar_id']; ?>">
                            <button name="updateAvatar" class="avatarBtn" onclick="submitForm('updateAvatar',<?php echo $myAvatars['avatar_id'];?>)">
                                <img src="./views/public/img/avatars/<?php echo ($myAvatars['avatar_image']); ?>" alt="" class="responsive-img circle" id="profileImg" style="margin-left:20px;width:100px;height:100px;margin-top:30px;">
                            </button>
                    <?php    }
                    ?>
                </div>
            </div>
        </form>
    <script>
         function submitForm(action, id){
            var form = document.getElementById('thisform');
            form.action = "?action=" + action + "&id=" + id;
            form.submit();
        }

        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
</body>
</html>
