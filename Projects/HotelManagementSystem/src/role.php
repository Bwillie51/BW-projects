
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <link rel="stylesheet" href="../config/styles/style.css">
    
</head>
<body>
    
    <div class="nav-container">
        <div class="nav-bar">
        <ul>
            <li><a href="../index.php">Home</a></li>
            
        </ul>
        </div>
    </div>
    <div class="header-container">
    <div class="header">
        <h1>Welcome to Our Hotel Management System</h1>
        <p>Your one-stop solution for managing hotel operations efficiently.</p>
    </div>

    </div>
</div> 

    
    
    <main>
        <h2>Select Your Role</h2>
        <div class="home-page-menu">
            <ul>
            <li><a class="home-page-menu-item" href="../src/customer/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/customer.png" alt="" class="menu-item-img">
                </div>Customer Login</a>
            </li>
            <li><a class="home-page-menu-item" href="../src/reception/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/reception.jpg" alt="" class="menu-item-img">
                </div>Receptionist Login</a>
            </li>
            <li><a class="home-page-menu-item" href="../src/admin/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/admin.png" alt="" class="menu-item-img">
                </div>Admin Login</a>
            </li>

            <!-- Other roles not yet programmed-->
            <li><a class="home-page-menu-item" href="../src/storage/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/housekeeping.png" alt="" class="menu-item-img">
                </div>House Keeping</a>
            </li>
            <li><a class="home-page-menu-item" href="../src/restaurant/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/restaurant.jpg" alt="" class="menu-item-img">
                </div>Restaurant</a>
            </li>
            <li><a class="home-page-menu-item" href="../src/admin/login.php" target="">
                <div class= "menu-item-img-div">
                    <img src ="../config/images/restaurant.jpg" alt="" class="menu-item-img">
                </div>No Assigned</a>
            </li>
            


            </ul>
        </div>


        
    </main>

    

    <footer>
        <div class ="footer">
            <h2>Hotel Information</h2>
            <p>Welcome to our hotel management system. Please select your role to proceed.</p>
            <div class="cont-tec">
                <a href="src/about.php">About Us</a>
                <a href="src/contact.php">Contact Us</a>
            </div>
            <p>&copy; 2025 Hotel Management System. All rights reserved.</p>
        </div>
        <aside>
            <h2>Connect with Us</h2>
            <a href="https://www.facebook.com" target="_blank">Facebook</a>
            <a href="https://www.twitter.com" target="_blank">Twitter</a>
            <a href="https://www.instagram.com" target="_blank">Instagram</a>
    </aside>

    </footer>
</body>
</html>